<?php
/**
 * redis 哈希【Hash】
 * key【唯一】  hash key【唯一】  value【可重复】
 * name无序，hash key按先后进入顺序有序
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 10);

$redis->hSet('hash_name', 'key1', 'value1');
$redis->hSet('hash_name', 'key2', 'value2');
$redis->hSet('hash_name', 'key2', 'value2'); // 不存在：1, 存在：0
$redis->hSetNx('hash_name', 'key2', 'value2'); // 不存在：true，存在：false
$redis->hSet('hash_name', 'key3', 'value3'); // 不存在：true，存在：false
$redis->hSet('hash_name', 'key4', 'value4'); // 不存在：true，存在：false

$redis->hMset('hash_name', ['key5'=>'value5', 'key6'=>'value6']);
$data = $redis->hGet('hash_name', 'key1');
$keys = $redis->hKeys('hash_name');
$values = $redis->hVals('hash_name');
$hMGet = $redis->hMGet('hash_name', ['key1', 'key2']);
$all = $redis->hGetAll('hash_name');

$redis->hIncrBy('hash_name', 'key8', -5);

$len = $redis->hLen('hash_name');
$is_exist = $redis->hExists('hash_name', 'key1');
$del1 = $redis->hDel('hash_name', 'key1');
$del2 = $redis->hDel('hash_name', 'key2', 'key3');
$redis->delete('hash_name'); // delete all hash keys of hash name

var_dump($data, $keys, $values, $hMGet, $all);
var_dump($is_exist, $len, $del1, $del2);
