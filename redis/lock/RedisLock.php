<?php

class RedisLock
{
    private static $redis;

    public function __construct()
    {
        if (!self::$redis) {
            self::$redis = new Redis();
            self::$redis->connect('127.0.0.1', 6379, 10);
            if (!self::$redis)
                throw new Exception("redis server connect error!", 500);
        }
    }

    // 抢锁
    public function getLock($key = '', $expire = 5)
    {
        if (empty($key) || !is_numeric($expire))
            return false;

        // 抢锁
        $lock = self::$redis->setnx($key, time() + $expire);

        // 抢锁不成功
        if (!$lock) {
            $lockTime = self::$redis->get($key);
            // 若锁已过期（前一个操作超时），则重新获取锁
            if ($lockTime < time()) {
                $lock = self::$redis->set($key, time() + $expire);
                echo "lock已超时，重新生成，当前时间：" . date('i:s') . PHP_EOL;
            } else {
                echo "lock正在使用，当前时间：" . date('i:s') . ", lock值：" . date('i:s', $lockTime) . PHP_EOL;
            }
        } else {
            echo "抢锁成功，当前时间：" . date('i:s') . PHP_EOL;
        }

        return $lock ? true : false;
    }

    // 释放锁
    public function deleteLock($key = '')
    {
        self::$redis->delete($key);
    }


}