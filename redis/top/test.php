<?php

$redis = new Redis();
$redis->connect('localhost', 6379, 10);

$key = 'top_book';

for ($i = 1; $i <= 100; ++ $i) {
    $redis->zAdd($key, mt_rand(0, 100), "book{$i}");
}

$top10 = $redis->zRevRange($key, 0, 9, true);

var_dump($top10);

