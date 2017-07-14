<?php

require 'RedisLock.php';

$redis = new RedisLock();

$lockKey = 'my_key';
$expire = 5;

// 抢锁
$lock = $redis->getLock($lockKey, $expire);

if ($lock) { // 抢锁成功
    // 处理业务逻辑...
    echo "get lock success" . PHP_EOL;

    // 处理完，释放锁
    $redis->deleteLock($lockKey);
} else { // 抢锁未成功
    echo "get lock fail" . PHP_EOL;
}