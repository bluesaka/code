<?php
/**
 * redis 字符串【String】
 * key【唯一】  value【可重复】
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 10);

$redis->delete('string_name', 'string_name2', 'string_name3');

$redis->set('string_name', json_encode(['name' => 'adam'], JSON_UNESCAPED_UNICODE));
$redis->set('string_name2', 'value2', 5); // ttl = 5s
$redis->setex('string_name3', 5, 'value3'); // ttl = 5s
$redis->setnx('string_name4', 'value4'); // set if not exists
$redis->set('string_name5', 'value5');

$redis->expire('string_name4', 5); // ttl = 5s
$redis->setTimeout('string_name4', 5); // ttl = 5s
$redis->expireAt('string_name5', strtotime('2017-10-01')); // 过期时间

$data = $redis->get('string_name');
$data2 = $redis->get('string_name2');
$data3 = $redis->get('string_name3');
$data4 = $redis->get('string_name4');
$multi = $redis->getMultiple(['string_name1', 'string_name2']);

$redis->incr('incr_key'); // +1  incr_key不存在，则返回1
$incr_key = $redis->get('incr_key');

//var_dump(json_decode($data, true));
//var_dump($data2, $data3, $data4, $multi);

/** ---------------------------------------------------- */

# select db
$redis->select(0); // 默认是db0
$redis->set('db_0_key', 'value');
$redis->move('db_0_key', 1); // 把key从 db0 -> db1

$redis->select(1);
$redis->delete('db_0_key'); // 删除db1中的key，需先select db1
$data = $redis->get('db_0_key');
var_dump($data);


# multi 模式
$ret = $redis->multi()
    ->set('key1', 'val1')
    ->get('key1')
    ->set('key2', 'val2')
    ->get('key2')
    ->exec();