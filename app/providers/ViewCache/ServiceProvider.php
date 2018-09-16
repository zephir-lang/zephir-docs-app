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

namespace Docs\Providers\ViewCache;

use Phalcon\Cache\Frontend\Output;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use function Docs\Functions\app_path;
use function Docs\Functions\config;

/**
 * Docs\Providers\ViewCache\ServiceProvider
 *
 * @package Docs\Providers\ViewCache
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * Note: The frontend must always be Phalcon\Cache\Frontend\Output and the
     * service 'viewCache' must be registered as always open (not shared) in
     * the services container (DI).
     *
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        $container->set(
            'viewCache',
            function () {
                $lifetime = env('CACHE_LIFETIME', 3600);
                $driver   = env('VIEW_CACHE_DRIVER', 'file');
                $adapter = '\Phalcon\Cache\Backend\\' . ucfirst($driver);

                return new $adapter(
                    new Output(['lifetime' => $lifetime]),
                    [
                        'cacheDir' => app_path('storage/cache/view/'),
                    ]
                );
            }
        );
    }
}
