<?php

require 'vendor/autoload.php';

/** @var \Psr\Cache\CacheItemPoolInterface $original */
$original = new \Cache\Adapter\PHPArray\ArrayCachePool();

/** @var \Psr\Cache\CacheItemPoolInterface $pool */
// Create an ecrypted pool:
$key = \Defuse\Crypto\Key::createNewRandomKey();
$pool = new \Cache\Encryption\EncryptedCachePool($original, $key);

$item = $pool->getItem('foo');

$item->set('bar');
$item->expiresAfter(3600);

$pool->save($item);

printCacheValue($original, 'foo');
printCacheValue($pool, 'foo');
