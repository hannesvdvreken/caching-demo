<?php

function printCacheValue(\Psr\Cache\CacheItemPoolInterface $pool, $key)
{
    echo "Does the pool have item '".$key."'? ";
    echo $pool->hasItem($key) ? 'yes': 'no';
    echo "\n";
    if ($pool->hasItem($key)) {
        $item = $pool->getItem($key);
        echo "What's the value? ";
        echo $item->get();
        echo "\n";

        if ($item instanceof \Cache\TagInterop\TaggableCacheItemInterface) {
            if (! empty($item->getPreviousTags())) {
                echo "The item's tags are: ". join(', ', $item->getPreviousTags());
                echo "\n";
            }
        }
    }
}