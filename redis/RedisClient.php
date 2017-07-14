<?php

class RedisClient
{
    private static $redis;

    private function __construct() {}

    private function __clone() {}

    public static function getRedis()
    {
        if (!self::$redis) {
            self::$redis = new Redis();
            self::$redis->connect('localhost', 6379, 10);
            if (!self::$redis)
                throw new Exception("redis server connect error!", 500);
        }

        return self::$redis;
    }
}