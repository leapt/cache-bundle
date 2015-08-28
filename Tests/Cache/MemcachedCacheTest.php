<?php

namespace Leapt\CacheBundle\Tests\Cache;

use Leapt\CacheBundle\DependencyInjection\LeaptCacheExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MemcachedCacheTest extends \PHPUnit_Framework_TestCase
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

    public function testInfo()
    {
        $defaultCache = $this->container->get('leapt_cache.manager')->getCache('default');

        $info = $defaultCache->getInfo();

        $this->assertNotEmpty($info);

    }

    public function testSet()
    {
        $defaultCache = $this->container->get('leapt_cache.manager')->getCache('default');

        $defaultCache->set('foo', 'bar');

        $this->assertEquals('bar', $defaultCache->get('foo'));
    }
}