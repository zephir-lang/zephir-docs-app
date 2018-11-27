<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Docs\Cli\Tasks;

use AlgoliaSearch\Client;
use FilesystemIterator;
use Phalcon\CLI\Task;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use function Docs\Functions\app_path;
use function Docs\Functions\env;
use function sprintf;


/**
 * ClearCacheTask
 */
class UpdateSearchTask extends Task
{
    /**
     * This provides the main menu of commands if an command is not entered
     *
     * @throws \AlgoliaSearch\AlgoliaException
     */
    public function mainAction()
    {
        echo 'Discovering documents...' . PHP_EOL;
        $applicationId  = env('ALGOLIA_APPLICATION_ID', '');
        $applicationKey = env('ALGOLIA_APPLICATION_KEY', '');

        $client      = new Client($applicationId, $applicationKey);
        $index       = $client->initIndex('docs-index');
        $elements    = [];
        $path        = app_path('docs/');
        $dirIterator = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
        $iterator    = new RecursiveIteratorIterator(
            $dirIterator,
            RecursiveIteratorIterator::CHILD_FIRST
        );

        /** @var SplFileInfo $file */
        foreach ($iterator as $file) {
            if ('md' === $file->getExtension() || 'html' === $file->getExtension()) {
                $docsPath = $file->getPath();
                $temp     = str_replace($path, '', $file->getPath());
                $parts    = explode('/', $temp);
                $language = $parts[1];
                $version  = $parts[0];
                if ('old' !== $language) {
                    $pageName = $docsPath . '/' . $file->getFilename();

                    if (true === file_exists($pageName)) {
                        $data = file_get_contents($pageName);

                        /**
                         * Language and version
                         */
                        $data = str_replace(
                            [
                                '[[language]]',
                                '[[version]]',
                            ],
                            [
                                $language,
                                $version,
                            ],
                            $data
                        );

                        $data       = $this->parsedown->text($data);
                        $elements[] = [
                            'version'  => $version,
                            'language' => $language,
                            'filename' => str_replace('.md', '', $file->getFilename()),
                            'contents' => $data,
                        ];
                    }
                }
            }
        }

        echo 'Found ' . count($elements) . ' documents.' . PHP_EOL;
        echo 'Updating Algolia index...' . PHP_EOL;
        foreach ($elements as $element) {
            echo sprintf('Updating %s %s %s %s',
                $element['version'],
                $element['language'],
                $element['filename'],
                PHP_EOL
            );
            $index->addObject($element);
        }
        echo 'Updated index.' . PHP_EOL;
    }
}
