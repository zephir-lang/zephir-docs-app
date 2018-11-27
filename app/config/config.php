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

use Docs\Controllers\DocsController;
use function Docs\Functions\app_path;
use function Docs\Functions\env;

/**
 * Get the versions and languages
 */
$version     = '0.1';
$languages   = [];
$versions    = [];
$crowdinFile = app_path('/storage/crowdin/crowdin.json');
if (true === file_exists($crowdinFile)) {
    $crowdin = file_get_contents($crowdinFile);
    $crowdin = json_decode($crowdin, true);

    $languages = $crowdin['languages'];
    $versions  = $crowdin['versions'];
    $version   = current($versions);
}

return [
    'app'       => [
        'version'          => $version,
        'versions'         => $versions,
        'languages'        => $languages,
        'timezone'         => env('APP_TIMEZONE', 'UTC'),
        'debug'            => env('APP_DEBUG'),
        'env'              => env('APP_ENV'),
        'url'              => env('APP_URL'),
        'name'             => env('APP_NAME'),
        'project'          => env('APP_PROJECT'),
        'description'      => env('APP_DESCRIPTION'),
        'descriptionLong'  => env('APP_DESCRIPTION_LONG', 'Official Zephir Documentation'),
        'keywords'         => env('APP_KEYWORDS'),
        'repo'             => env('APP_REPO'),
        'docs'             => env('APP_DOCS'),
        'baseUri'          => env('APP_BASE_URI'),
        'staticUrl'        => env('APP_STATIC_URL'),
        'lang'             => env('APP_LANG'),
        'supportEmail'     => env('APP_SUPPORT_EMAIL'),
        'assetTag'         => 'development' !== env('APP_ENV') ? env('ASSET_TAG') : time(),
        'googleAnalytics'  => env('GOOGLE_ANALYTICS'),
        'algoliaSearchKey' => env('ALGOLIA_SEARCH_KEY'),
    ],
    'error'     => [
        'controller' => 'error',
        'action'     => 'show500',
    ],
    'highlight' => [
        'version' => '9.11.0',
        'js'      => [
            'cpp',
            'css',
            'json',
            'php',
            'shell',
            'twig',
            'yaml',
            'zephir',
        ],
    ],
    'providers' => [
        // Application Service Providers
        Docs\Providers\Config\ServiceProvider::class,
        Docs\Providers\FileSystem\ServiceProvider::class,
        Docs\Providers\UrlResolver\ServiceProvider::class,
        Docs\Providers\Routing\ServiceProvider::class,
        Docs\Providers\Logger\ServiceProvider::class,
        Docs\Providers\ViewCache\ServiceProvider::class,
        Docs\Providers\VoltTemplate\ServiceProvider::class,
        Docs\Providers\View\ServiceProvider::class,
        Docs\Providers\CacheData\ServiceProvider::class,
        Docs\Providers\Markdown\ServiceProvider::class,
        Docs\Providers\Assets\ServiceProvider::class,
        Docs\Providers\Dispatcher\ServiceProvider::class,
        Docs\Providers\Tags\ServiceProvider::class,
    ],
    'routes'    => [
        DocsController::class => [
            'methods' => [
                'get'  => [
                    '/'            => 'redirectAction',
                    '/{l}'         => 'mainAction',
                    '/{l}/{v}'     => 'mainAction',
                    '/{l}/{v}/{p}' => 'mainAction',
                ],

                // This is exactly the same execution as GET, but the Response has no body
                'head' => [
                    '/'            => 'redirectAction',
                    '/{l}'         => 'mainAction',
                    '/{l}/{v}'     => 'mainAction',
                    '/{l}/{v}/{p}' => 'mainAction',
                ],
            ],
        ],
    ],
];
