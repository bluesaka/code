<?php
/**
 * redis 集合【Set】
 * key【唯一】  value【唯一】
 * key无序，value无序
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 10);

$redis->delete('set_users', 'to_users', 'n_users', 'union_users');

$redis->sAdd('set_users', 'u1', 'u2', 'u3', 'u4', 'u5'); // 无序
$redis->sAdd('to_users', 'u1', 'u2', 'u3');
$redis->sAdd('n_users', 'u1', 'u2', 'u6');

$users = $redis->sMembers('set_users');
$redis->sIsMember('set_users', 'u1'); // true sContains(key, value)
$count = $redis->sCard('set_users'); // 总数
$sort_users = $redis->sort('set_users', ['sort' => 'desc']); // 排序后的集合，默认正序

$intersect = $redis->sInter('set_users', 'to_users', 'n_users'); // values交集
$intersect_count = $redis->sInterStore('intersect_users', 'set_users', 'to_users'); // 交集个数,交集存放在intersect_users
$intersect_users = $redis->sMembers('intersect_users');

$union = $redis->sUnion('set_users', 'to_users', 'n_users'); // values并集
$union_count = $redis->sUnionStore('union_users', 'set_users', 'to_users', 'n_users');
$union_users = $redis->sMembers('union_users');

$diff = $redis->sDiff('set_users', 'to_users', 'n_users'); // 在set_users中，不在其他keys中的values集合
$diff_count = $redis->sDiffStore('diff_users', 'set_users', 'to_users', 'n_users');
$diff_users = $redis->sMembers('diff_users');

$redis->sRem('set_users', 'u3'); // 删除
$redis->sRandMember('set_users'); // 随机取一个value
$redis->sPop('set_users'); // 随机弹出一个value


$redis->sMove('set_users', 'to_users', 'u4'); // 把u4从 set_users -> to_users

$redis->auth('password'); // 密码认证

//var_dump($users, $count, $intersect, $intersect_count, $intersect_users);
//var_dump($union, $union_count, $union_users);
var_dump($diff, $diff_count, $diff_users);