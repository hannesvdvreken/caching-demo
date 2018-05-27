<?php

require 'vendor/autoload.php';

/** @var \Psr\Cache\CacheItemPoolInterface $local */
/** @var \Psr\Cache\CacheItemPoolInterface $remote */
$local = new \Cache\Adapter\PHPArray\ArrayCachePool();
$remote = new \Cache\Adapter\PHPArray\ArrayCachePool();

/** @var \Psr\Cache\CacheItemPoolInterface $pool */
$pool = new \Cache\Adapter\Chain\CachePoolChain([$local, $remote]);

$item = $pool->getItem('foo');

$item->set('bar');
$item->expiresAfter(3600);

$pool->save($item);

printCacheValue($local, 'foo');
printCacheValue($remote, 'foo');

echo "Removing item from the local pool.\n";
$local->delete('foo');

printCacheValue($local, 'foo');
printCacheValue($pool, 'foo');
printCacheValue($local, 'foo');
