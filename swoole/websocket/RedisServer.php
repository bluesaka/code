<?php

class RedisServer
{
    /**@var Redis $redis */
    private static $redis = null;

    /**@var RedisServer $instance */
    private static $instance = null;

    const DEBUG = false;
    const PREFIX_FD = 'fd_';
    const PREFIX_USER = 'user_';

    private function __construct() {}

    private function __clone() {}

    public static function getRedisInstance()
    {
        if (is_null(self::$redis)) {
            self::$redis = new Redis();
            self::$redis->connect('127.0.0.1', 6379, 10);
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function login($uid, $fd)
    {
        if(self::DEBUG) self::getRedisInstance();

        // 设置fd:user
        self::$redis->set(self::getFdKey($fd), $uid);

        // user:fds中添加fd
        self::$redis->sAdd(self::getUserKey($uid), $fd);
    }

    public static function close($fd)
    {
        if(self::DEBUG) self::getRedisInstance();

        // 获取uid
        $uid = self::$redis->get(self::getFdKey($fd));

        if ($uid) {
            // 清除fd:user
            self::$redis->set(self::getFdKey($fd), null);

            // user:fds中移除fd
            self::$redis->sRem(self::getUserKey($uid), $fd);
        }
    }

    public static function getFdsByUid($uid)
    {
        if(self::DEBUG) self::getRedisInstance();
        return self::$redis->sMembers(self::getUserKey($uid));
    }

    private static function getFdKey($fd)
    {
        return self::PREFIX_FD . $fd;
    }

    private static function getUserKey($uid)
    {
        return self::PREFIX_USER . $uid;
    }
}
