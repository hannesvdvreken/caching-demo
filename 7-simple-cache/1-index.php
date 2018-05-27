<?php

require 'vendor/autoload.php';

/** @var \Psr\Cache\CacheItemPoolInterface $pool */
$pool = new \Cache\Adapter\PHPArray\ArrayCachePool();

/** @var \Psr\SimpleCache\CacheInterface $cache */
$cache = new \Cache\Bridge\SimpleCache\SimpleCacheBridge($pool);

$cache->set('foo', 'bar');

printCacheValue($pool, 'foo');
