<?php

require 'vendor/autoload.php';

/** @var \Cache\TagInterop\TaggableCacheItemPoolInterface $pool */
$pool = new \Cache\Adapter\PHPArray\ArrayCachePool();

$item = $pool->getItem('foo-1');

$item->set('bar');
$item->expiresAfter(3600);
$item->setTags(['cat-1']);

$pool->saveDeferred($item);

$item = $pool->getItem('foo-2');

$item->set('qux');
$item->expiresAfter(3600);
$item->setTags(['cat-2', 'cat-1']);

$pool->saveDeferred($item);
$pool->commit();

printCacheValue($pool, 'foo-1');
printCacheValue($pool, 'foo-2');

echo "Invalidating tag 'cat-1'\n";
$pool->invalidateTag('cat-1');

printCacheValue($pool, 'foo-1');
printCacheValue($pool, 'foo-2');
