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

namespace Docs\Controllers;

use Phalcon\Cache\BackendInterface;
use Phalcon\Config;
use Phalcon\Mvc\Controller as PhController;
use Phalcon\Mvc\View\Simple;
use function Docs\Functions\app_path;
use function Docs\Functions\config;
use function Docs\Functions\environment;
use function file_exists;

/**
 * Docs\Controllers\BaseController
 *
 * @property Config           $config
 * @property BackendInterface $cacheData
 * @property \ParsedownExtra  $parsedown
 * @property Simple           $viewSimple
 *
 * @package Docs\Controllers
 */
class BaseController extends PhController
{
    /** @var array */
    protected $seoStrings = [];

    /**
     * @param string $language
     * @param string $version
     *
     * @return array
     */
    public function getSidebar($language, $version): array
    {
        $pageName    = app_path(
            sprintf(
                'docs/%s/%s/%s.md',
                $version,
                $language,
                'sidebar'
            )
        );
        $apiFileName = app_path(
            sprintf(
                'docs/%s/%s/api/%s.md',
                $version,
                $language,
                'sidebar'
            )
        );

        if (true === file_exists($pageName)) {
            $data = file_get_contents($pageName);
        } elseif (true === file_exists($apiFileName)) {
            $data = file_get_contents($apiFileName);
        } else {
            // The article does not exist
            return [];
        }

        $namespaces = $this->getNamespaces();
        $search     = array_keys($namespaces);
        $replace    = array_values($namespaces);

        /**
         * API links
         */
        $data = str_replace($search, $replace, $data);

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

        $data              = explode("\n", $data);
        $data              = array_diff($data, ['']);
        $data              = array_diff($data, ['    ']);
        $parseMarkDown     = [];
        $parseMarkDownItem = [];
        $menuItemKey       = 0;

        foreach ($data as $key => $dataItem) {
            if (preg_match('/(- \w+.*)/iu', $dataItem, $matches)) {
                unset($parseMarkDownItem);
                $parseMarkDown[$menuItemKey] = [
                    'name'     => str_replace(["- "], "", $matches[0]),
                    'subItems' => [],
                ];
                $parseMarkDownItem           = &$parseMarkDown[$menuItemKey]['subItems'];
                $menuItemKey++;

                continue;
            } else {
                preg_match('/(- \[\w+.*\])/iu', $dataItem, $subName);
                preg_match('/](\(.*\w+.*)/iu', $dataItem, $subLink);

                $link = '#';
                if (true === isset($subLink[0])) {
                    $link = str_replace(["]", "(", ")"], "", $subLink[0]);
                }

                $name = '';
                if (true === isset($subName[0])) {
                    $name = str_replace(["- [", "]"], "", $subName[0]);
                }

                if (false === empty($name)) {
                    $parseMarkDownItem[$key] = [
                        'subName' => $name,
                        'subLink' => $link,
                    ];
                }
            }
        }

        return $parseMarkDown;
    }

    /**
     * Gets the SEO title
     *
     * @param string $language
     * @param string $version
     * @param string $page
     *
     * @return string
     */
    protected function getSeoTitle(string $language, string $version, string $page): string
    {
        $title = '';
        if (true === empty($this->seoStrings)) {
            $fileName = app_path(
                sprintf(
                    'docs/%s/%s/seo.json',
                    $version,
                    $language
                )
            );

            if (true === file_exists($fileName)) {
                $this->seoStrings = json_decode(
                    file_get_contents($fileName),
                    true
                );
            }
        }

        $title = $this->seoStrings[$page] ?? $title;

        return $title;
    }

    /**
     * @param string $language
     * @param string $version
     * @param string $fileName
     *
     * @return string
     */
    protected function getDocument($language, $version, $fileName): string
    {
        $key = sprintf('%s.%s.%s.cache', $fileName, $version, $language);

        if (environment('production') && true === $this->cacheData->exists($key)) {
            return $this->cacheData->get($key);
        }

        $pageName    = app_path(
            sprintf(
                'docs/%s/%s/%s.md',
                $version,
                $language,
                $fileName
            )
        );
        if (true === file_exists($pageName)) {
            $data = file_get_contents($pageName);
        } else {
            // The article does not exist
            return '';
        }

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
                $this->getVersion(),
            ],
            $data
        );
        $data = $this->parsedown->text($data);
        $this->cacheData->save($key, $data);

        return $data;
    }

    /**
     * @param string $language
     * @param string $version
     * @param string $fileName
     *
     * @return string
     */
    protected function getMenu($language, $version, $fileName): string
    {
        $document = $this->getDocument($language, $version, $fileName);
        $document = str_replace(
            '<li>',
            '<li class="toc-entry toc-h2">',
            $document
        );

        return ltrim(rtrim($document, '</ul>'), '<ul>');
    }

    /**
     * Returns the current version string with its prefix if applicable
     *
     * @param  string $stub
     * @param  string $version
     *
     * @return string
     */
    protected function getVersion(string $stub = '', string $version = ''): string
    {
        if (empty($version) || strtolower($version) === 'latest') {
            $version = config('app.version', '9999');
        } else {
            $version = filter_var($version, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $version = $version ?? config('app.version', '9999');
        }

        return "{$stub}{$version}";
    }

    /**
     * Check the available languages and return either that or 'en'
     *
     * @param string $language
     *
     * @return string
     */
    protected function getLanguage(string $language): string
    {
        $languages = $this->config->path('app.languages', []);

        if (!isset($languages[$language])) {
            return 'en';
        }

        return $language;
    }
}
