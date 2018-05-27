<?php

require 'vendor/autoload.php';

/** @var \Cache\Hierarchy\HierarchicalPoolInterface $pool */
$pool = new \Cache\Adapter\PHPArray\ArrayCachePool();

$item = $pool->getItem('|users|foo');

$item->set('bar');
$item->expiresAfter(3600);

$pool->save($item);

$item = $pool->getItem('|products|foo');

$item->set('baz');
$item->expiresAfter(3600);

$pool->save($item);

printCacheValue($pool, '|users|foo');
printCacheValue($pool, '|products|foo');

echo "Purging user items\n";
$pool->deleteItem('|users');

printCacheValue($pool, '|users|foo');
printCacheValue($pool, '|products|foo');
