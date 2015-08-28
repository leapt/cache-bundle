<?php

namespace Leapt\CacheBundle\Tests\Manager;

use Leapt\CacheBundle\DependencyInjection\LeaptCacheExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CacheManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $extension = new LeaptCacheExtension();

        $config = array(
            'namespace' => 'LeaptCacheBundle',
            'caches'    => array(
                'default' => array(
                    'type'    => 'memcached',
                    'options' => array('server' => 'localhost', 'port' => 11211)
                )
            )
        );

        $extension->load(array($config), $this->container);
    }

    public function testManagerInstantiation()
    {
        $defaultCache = $this->container->get('leapt_cache.manager')->getCache('default');

        $this->assertInstanceOf('Leapt\CacheBundle\Cache\MemcachedCache', $defaultCache);
    }
}