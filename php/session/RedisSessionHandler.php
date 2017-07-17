<?php

/**
 * method:
 *      open
 *      close
 *      read
 *      write
 *      destroy
 *      gc
 */
class RedisSessionHandler
{
    private $redis;  // redis instance
    private $prefix = 'PHPREDIS_SESSION:'; // 前缀
    private $expire = 3600; // 有效期
    private $db = 0; // redis db

    public function __construct(Redis $redis, $prefix = 'PHPREDIS_SESSION:', $expire = 3600, $db = 0)
    {
        $this->redis = $redis;
        $this->prefix = $prefix;
        $this->expire = $expire;
        $this->db = $db;
    }

    public function open() {}

    public function close()
    {
        unset($this->redis);
    }

    public function read($id)
    {
        $this->redis->select($this->db);
        $data = $this->redis->get($this->prefix . $id);
        $this->redis->expire($id, $this->expire); // 每次读取后重新设置有效期
        return $data;
    }

    public function write($id, $data)
    {
        $id = $this->prefix . $id;
        $this->redis->setex($id, $this->expire, $data);
    }

    public function destroy($id)
    {
        $this->redis->delete($this->prefix . $id);
    }

    public function gc() {}
}