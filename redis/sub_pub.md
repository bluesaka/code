# 发布/订阅

# redis-cli
```
redis-cli> subscribe news.*   （订阅通配符频道）

redis-cli> publish news.sports "a sports news"  （发布一条体育新闻）
```

# phpredis监听超时key

## 设置redis.conf
```
notify-keyspace-events Ex
```

## psubscribe.php
```php
ini_set('default_socket_timeout', -1);  //不超时
$redis = new Redis();
$redis->connect('127.0.0.1', 6379); // do not set timeout
$redis->psubscribe(['__keyevent@0__:expired'], 'myCallback');

function myCallback($redis, $pattern, $chan, $msg)
{
    // object(Redis)  "__keyevent@0__:expired"  "__keyevent@0__:expired"  "name"
    var_dump($redis, $pattern, $chan, $msg);
    exec("echo 1 >> /var/log/redis/redis_test.log");
}
```
启动进程：php psubscribe.php &

## client.php
```
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 10);
$redis->setex('name', 10, 'felix');
```
