<?php

require 'vendor/autoload.php';

/** @var \Cache\Prefixed\PrefixedCachePool $pool */
$originalPool = new \Cache\Adapter\PHPArray\ArrayCachePool();
$prefixedPool = new \Cache\Prefixed\PrefixedCachePool($originalPool, 'acme');

$item = $originalPool->getItem('foo');

$item->set('bar');
$item->expiresAfter(3600);

$originalPool->save($item);

$item = $prefixedPool->getItem('foo');

$item->set('baz');
$item->expiresAfter(3600);

$prefixedPool->save($item);

printCacheValue($originalPool, 'foo');
echo $originalPool->getItem('foo')->getKey()."\n";
printCacheValue($prefixedPool, 'foo');
echo $prefixedPool->getItem('foo')->getKey()."\n";

echo "Clearing acme prefixed cache\n";
$prefixedPool->clear();

printCacheValue($originalPool, 'foo');
printCacheValue($prefixedPool, 'foo');
