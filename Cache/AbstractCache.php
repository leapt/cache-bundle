<?php

namespace Leapt\CacheBundle\Cache;

use Leapt\CacheBundle\Exception\CacheException;

/**
 * Class AbstractCache
 * @package Leapt\CacheBundle\Cache
 */
abstract class AbstractCache implements CacheInterface
{
    /**
     * @param string $namespace  Namespace shared between all caches
     * @param string $identifier Name of the cache
     * @param array  $options    Array of options
     *
     * @throws CacheException
     */
    public function __construct($namespace, $identifier, array $options)
    {
        if (!$this->isEnabled()) {
            throw new CacheException('Cache driver not available');
        }
    }
}
