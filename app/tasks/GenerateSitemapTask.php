<?php

namespace Docs\Cli\Tasks;

use FilesystemIterator;
use Phalcon\CLI\Task;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use function Docs\Functions\app_path;
use function file_put_contents;
use function implode;
use function substr;

/**
 * GenerateSitemapTask
 */
class GenerateSitemapTask extends Task
{
    public function mainAction()
    {
        $output = app_path('public/sitemap.xml');

        $elements    = [];
        $path        = app_path('docs/');
        $dirIterator = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
        $iterator    = new RecursiveIteratorIterator(
            $dirIterator,
            RecursiveIteratorIterator::CHILD_FIRST
        );

        /** @var SplFileInfo $file */
        foreach ($iterator as $file) {
            $temp     = str_replace($path, '', $file->getPath());
            $parts    = explode('/', $temp);
            $version  = $parts[0] ?? '';
            $language = $parts[1] ?? '';

            if ('md' === $file->getExtension() &&
                true !== empty($version) &&
                '-menu.md' !== substr($file->getFilename(), -8) &&
                'old' !== $version
            ) {
                $fullFile = sprintf(
                    '%s/%s/%s',
                    $language,
                    $version,
                    $file->getFilename()
                );

                $elements[] = str_replace(
                    [
                        app_path('docs/'),
                        '.md',
                    ],
                    [
                        '',
                        '',
                    ],
                    $fullFile
                );
            }
        }

        sort($elements);

        $contents = $this->viewSimple->render(
            'index/sitemap',
            [
                'elements' => $elements,
            ]
        );

        file_put_contents($output, $contents);
    }
}
