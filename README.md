Note: this bundle is not maintained anymore, consider using [symfony/cache](https://symfony.com/doc/current/cache.html) directly.

Introduction
============

This bundle is used to provide access to cache drivers.

This is a work in progress with two drivers: Memcached and APC.

Installation
------------

1. Add this bundle to your ``vendor/`` dir:

    Add the following line in your ``composer.json`` file:

        "leapt/cache-bundle": "~1.0",

    Run composer:

        composer update leapt/cache-bundle

2. Add this bundle to your application's kernel:

        // app/ApplicationKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new Leapt\CacheBundle\LeaptCacheBundle(),
                // ...
            );
        }

3. Add the configuration in your config.yml file

        leapt_cache:
            namespace: yournamespace
            caches:
                tweets:
                    type: memcached
                    options:
                        server: localhost
                        port: 11211
                        ttl: 86400
                flickr:
                    type: memcached
                    options:
                        server: localhost
                        port: 11211
                        ttl: 45632

Usage
-----

        $cacheManager = $this->get('leapt_cache.manager');

        $cache = $cacheManager->getCache('tweets');

        if ($cache->isEnabled()) {
            if (false === $tweets = $cache->get('tweets')) {
                $tweets = $this->getTweets();
                $cache->set('tweets', $tweets);
            }
        } else {
            $tweets = $this->getTweets();
        }

Running the tests
-----------------

Before running the tests, you will need to install the bundle dependencies. Do it using composer :

    curl -s http://getcomposer.org/installer | php
    php composer.phar --dev install

Then you can simply launch phpunit

    phpunit
