<?php

/**
 * 获取redis实例
 * @return Redis
 */
function getRedisInstance()
{
    $redis = new Redis();
    $redis->connect('localhost', 6379);
    return $redis;
}

/**
 * 抢锁
 * @param $key
 * @param int $ttl 有效时长
 * @param int $timeout 超时时间
 * @return bool
 */
function lock($key, $ttl = 10, $timeout = 5)
{
    $total = 50; //最大尝试次数
    $sleepTime = $timeout * 1000000 / 50; //休眠时间
    $lock = false;

    while (--$total >= 0) {
        $now = floor(microtime(true) * 1000);
        $expireTime = $now + $ttl * 1000;
        $lock = getLock($key, $expireTime, $ttl);

        if ($lock) {
            break;
        }

        usleep($sleepTime);
    }

    return $lock;
}

/**
 * 获得锁
 * @param $key
 * @param int $expire
 * @param mixed $value
 * @return mixed
 */
function getLock($key, $value, $expire)
{
    $script = <<<LUA
    local key = KEYS[1]
    local value = ARGV[1]
    local ttl = ARGV[2]
    
    if (redis.call('setnx', key ,value) == 1) then
        return redis.call('expire', key, ttl)
    elseif (redis.call('ttl', key) == -1) then
        return redis.call('expire', key, ttl)
    end
    
    return 0
LUA;

    return execLuaScript($script, [$key, $value, $expire]);
}

/**
 * 释放锁
 * @param string $key
 * @param string $value
 * @return mixed
 */
function unlock($key, $value)
{
    $script = <<<LUA
    local key = KEYS[1]
    local value = ARGV[1]
    
    if (redis.call('exist', key) == 1 and redis.call('get', key) == value) then
        return redis.call('delete', key)
    end
    
    return 0
LUA;

    return execLuaScript($script, [$key, $value]);
}

/**
 * 执行lua脚本
 * @param string $script 脚本
 * @param array $params
 * @param int $keyNum
 * @return mixed
 */
function execLuaScript($script, $params, $keyNum = 1)
{
    $redis = getRedisInstance();
    $scriptSha = $redis->script('load', $script);
    return $redis->evalSha($scriptSha, $params, $keyNum);
}

// 业务抢锁
$ok = lock('test');
if ($ok) {
    // do something
    echo 1;
}
