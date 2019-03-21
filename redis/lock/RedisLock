<?php

function getRedisInstance()
{
    $redis = new Redis();
    $redis->connect('localhost', 6379);
    return $redis;
}

/**
 * 防止重复提交
 * @param string $key
 * @param int $ttl
 * @return bool
 * @throws Exception
 */
function no_repeat_submit($key, $ttl)
{
    $redis = getRedisInstance();

    if ($redis->setnx($key, 1)) {
        $redis->expire($key, $ttl);
        return true;
    } else {
        throw new Exception("请勿重复提交");
    }
}

/**
 * redis分布式锁
 * @param string $key
 * @param int $ttl
 * @return bool
 */
function redisLock($key, $ttl = 10)
{
    $redis = getRedisInstance();
    $now = floor(microtime(true) * 1000);
    $expireTime = $now + $ttl * 1000;

    if ($redis->setnx($key, $expireTime)) {
        $redis->expire($key, $ttl);
        return true;
    } else {
        if ($redis->get($key) < $now) { //处理过期的key
            $redis->set($key, $expireTime);
            return true;
        }
        return false;
    }
}

/**
 * redis分布式锁2
 * @param string $key
 * @param int $timeout
 * @return bool
 */
function redisLock2($key, $timeout = 10)
{
    $redis = getRedisInstance();
    $now = floor(microtime(true) * 1000);
    $expireTime = $now + $timeout * 1000;

    if ($redis->setnx($key, $expireTime)) {
        return true;
    } else {
        $oldExpireTime = $redis->get($key);
        if ($oldExpireTime < $now && $oldExpireTime == $redis->getSet($key, $expireTime)) {
            return true;
        }
        return false;
    }
}

/**
 * 抢锁
 * @param string $key
 * @param int $ttl
 * @param int $timeout
 * @throws Exception
 */
function getRedisLock($key, $ttl = 10, $timeout = 10)
{
    $total = 50; //最大尝试次数
    $n = 0;
    $sleepTime = $timeout * 1000000 / 50; //休眠时间

    while (!$this->redisLock($key, $ttl)) {
        $n ++;
        if ($n >= $total) {
            throw new Exception("请求超时，请稍后重试");
        }

        usleep($sleepTime);
    }
}
