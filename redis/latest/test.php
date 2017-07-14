<?php

$redis = new Redis();
$redis->connect('localhost', 6379, 10);

$key = 'latest_comment';

// 最新的20条评论
for ($i = 1; $i <= 100; ++ $i) {
    $redis->lPush($key, "comment - {$i}");
    $redis->lTrim($key, 0, 20);
}

$latest_comment = $redis->lRange($key, 0, 19);

var_dump($latest_comment);

