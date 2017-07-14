<?php

require '../RedisClient.php';

class Counter
{
    private $redis;

    public function __construct()
    {
        $this->redis = RedisClient::getRedis();
    }

    public function up($key, $counter = 1)
    {
        $this->redis->incrBy($key, $counter); // $this->redis->incr($key)
    }

    public function down($key, $counter = -1)
    {
        $this->redis->incrBy($key, $counter);
    }

    public function upHash($key, $hashKey, $counter = 1)
    {
        $this->redis->hIncrBy($key, $hashKey, $counter);
    }

    public function downHash($key, $hashKey, $counter = -1)
    {
        $this->redis->hIncrBy($key, $hashKey, $counter);
    }

    public function getCounter($key)
    {
        return $this->redis->get($key);
    }

    public function getHashCounter($key, $hashKey)
    {
        return $this->redis->hGet($key, $hashKey);
    }
}