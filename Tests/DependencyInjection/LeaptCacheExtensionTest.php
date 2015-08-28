<?php

namespace Leapt\CacheBundle\Tests\DependencyInjection;

use Leapt\CacheBundle\DependencyInjection\LeaptCacheExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LeaptCacheExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigLoad()
    {
        $extension = new LeaptCacheExtension();

        $config = array('namespace' => 'LeaptCacheBundle');
        $extension->load(array($config), $container = new ContainerBuilder());

        $this->assertEquals(array(), $container->getParameter('leapt_cache.caches'));
    }

    public function testConfigLoadWithOneCache()
    {
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
        $extension->load(array($config), $container = new ContainerBuilder());

        $this->assertEquals($config['caches'], $container->getParameter('leapt_cache.caches'));
    }
}