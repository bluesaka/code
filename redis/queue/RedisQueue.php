<?php

require '../RedisClient.php';

class RedisQueue
{
    private $redis;

    public function __construct()
    {
        $this->redis = RedisClient::getRedis();
    }

    // 入列
    public function enqueue($key, $value)
    {
        $this->redis->rPush($key, $value);
    }

    // 出列
    public function dequeue($key)
    {
        return $this->redis->lPop($key);
    }
}