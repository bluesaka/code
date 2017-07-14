<?php
/**
 * 适配器模式
 *      将一个类的接口适配成用户所期待的，使多个不兼容的接口可以在一起工作
 */

include '../../autoload.php';

$db = new \adapter\DBAdapter('pdo');
$db->connect('127.0.0.1', 'user', '', 'test');
var_dump($db->query('select * from t where id = 1'));
$db->close();