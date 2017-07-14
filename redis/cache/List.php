<?php
/**
 * redis 列表【List】
 * key【唯一】  index【唯一】  value【可重复】
 * key无序，index按先后进入顺序有序
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 10);

$redis->delete('list_name');

$redis->lPush('list_name', 'v1'); // 左插入，加入列表头部
$redis->lPush('list_name', 'v2');
// $redis->lPush('list_name', 'v1', 'v2'); // 2.4版本之后，支持push多个值
$redis->rPush('list_name', 'v3'); // 右插入，加入列表尾部

$redis->lSet('list_name', 0, 'new v1');
$redis->lIndex('list_name', 0); // value of index 0

$list = $redis->lRange('list_name', 0, -1); //0.the first, 1.the second, -1.the last, -2.the penultimate
$redis->lTrim('list_name', 0, 10); // list_name保留前11条数据
$head = $redis->lPop('list_name'); // 左弹出，获取头部
$tail = $redis->rPop('list_name'); // 右弹出，获取尾部

$redis->rPush('list_name', 'v5');
$redis->rPush('list_name', 'v5');
$redis->rPush('list_name', 'v5');
$redis->lRem('list_name', 'v5', -2); // 移除前count次出现的value值，负数-2表示从尾部开始删除，正数从头开始，=0删除全部

var_dump($list, $head, $tail);