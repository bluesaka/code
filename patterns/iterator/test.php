<?php
/**
 * 迭代器模式
 *      遍历对象内部的属性，而对象不对外暴露其内部结构
 */

include '../../autoload.php';

use iterator\UserStar;

$user = new UserStar();
$user->addUser('user 1');
$user->addUser('user 2');
$user->addUser('user 3');

$iterator = $user->getUserIterator();

$iterator->current();
while ($iterator->hasNext()) {
    $iterator->next();
}