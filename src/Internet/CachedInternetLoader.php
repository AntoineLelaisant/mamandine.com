<?php

namespace App\Internet;

use App\Cache\CacheManager;

class CachedInternetLoader implements LoaderInterface
{
    const CACHE_KEY = 'app.cache.key';

    private $loader;
    private $cache;

    public function __construct(InternetLoader $loader, CacheManager $cache)
    {
        $this->loader = $loader;
        $this->cache = $cache;
    }

    public function load()
    {
        if ($this->cache->has(self::CACHE_KEY)) {
            return $this->cache->get(self::CACHE_KEY);
        }

        $loadedContent = $this->loader->load();
        $this->cache->set(self::CACHE_KEY, $loadedContent);

        return $loadedContent;
    }
}
