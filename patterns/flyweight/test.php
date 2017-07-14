<?php
/**
 * 享元模式
 *      缓存了创建的对象
 *      简单理解为，工厂模式加了个缓存池
 */

include '../../autoload.php';

$factory = new \flyweight\Factory();

$factory->create('pig')->getName();
$factory->create('pig')->getName();
$factory->create('dog')->getName();
$factory->create('dog')->getName();
