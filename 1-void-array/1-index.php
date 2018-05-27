<?php

require 'vendor/autoload.php';

/** @var \Psr\Cache\CacheItemPoolInterface $pool */
$pool = new \Cache\Adapter\Void\VoidCachePool();

$item = $pool->getItem('foo');

$item->set('bar');
$item->expiresAfter(3600);

$pool->save($item);

printCacheValue($pool, 'foo');
