<?php

namespace App\Cache;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\CacheItem;

class CacheManager
{
    private $cache;

    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    public function has(string $key)
    {
        return $this->cache->hasItem($key);
    }

    public function get(string $key)
    {
        return $this->cache->getItem($key)->get();
    }

    public function set(string $key, $value)
    {
        $item = $this->cache->getItem($key);

        $item->set($value);

        $this->cache->save($item);
    }
}
