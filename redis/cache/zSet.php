<?php
/**
 * redis 有序集合【zSet / Sorted set】
 * key【唯一】  score【重复】   value【唯一】
 * key无序，value按score的值排序有序
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 10);

$redis->delete('zSet_users');

$redis->zAdd('zSet_users', 95, 'u1', 90, 'u2', 88, 'u3', 98, 'u4');
$redis->zAdd('zSet_users', 78, 'u5', 80, 'u6');

$users = $redis->zRangeByScore('zSet_users', 80, 100, ['withscores' => 1, 'limit'=> [0,10]]); // score[80-100] 正序
$rev_users = $redis->zRevRangeByScore('zSet_users', 100, 80, ['withscores' => 1, 'limit'=> [0,10]]); // score[100-80] 倒序

$count = $redis->zCount('zSet_users', 80, 100);
$card = $redis->zCard('zSet_users'); // all count zSize(key)
$value = $redis->zScore('zSet_users', 'u1');
$rank = $redis->zRank('zSet_users', 'u1'); // 从小到大排序index(0开始)
$rev_rank = $redis->zRevRank('zSet_users', 'u1'); // 从大到小排序index(0开始)

$new_score = $redis->zIncrBy('zSet_users', 5, 'u1'); // u1:score + 5

$delete_count = $redis->zRemRangeByScore('zSet_users', 80, 85); // delete score[80-85]  zDeleteRangeByScore
$delete_rank_count = $redis->zRemRangeByRank('zSet_users', 0, 2); // 删除分数最低前两位  zDeleteRangeByRank

//$redis->zInter();
//$redis->zUnion();

var_dump($users, $rev_users, $count, $card, $value);
var_dump($rank, $rev_rank);
var_dump($delete_count, $delete_rank_count);