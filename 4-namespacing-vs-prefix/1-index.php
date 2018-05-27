<?php

require 'vendor/autoload.php';

/** @var \Psr\Cache\CacheItemPoolInterface $originalPool */
/** @var \Psr\Cache\CacheItemPoolInterface $geoCodingPool */
$originalPool = new \Cache\Adapter\PHPArray\ArrayCachePool();
$geoCodingPool = new \Cache\Namespaced\NamespacedCachePool($originalPool, 'geocoding');

$item = $originalPool->getItem('foo');

$item->set('bar');
$item->expiresAfter(3600);

$originalPool->save($item);

$item = $geoCodingPool->getItem('foo');

$item->set('baz');
$item->expiresAfter(3600);

$geoCodingPool->save($item);

printCacheValue($originalPool, 'foo');
printCacheValue($geoCodingPool, 'foo');

echo "Clearing geocoding cache\n";
$geoCodingPool->clear();

printCacheValue($originalPool, 'foo');
printCacheValue($geoCodingPool, 'foo');
