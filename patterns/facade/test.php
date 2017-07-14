<?php
/**
 * 外观模式
 *      把类的调用委托给一个单独的类，对外隐藏内部的复杂性，类似依赖注入容器
 */

include '../../autoload.php';

$maker = new \facade\AnimalMaker();
$maker->createPig();
$maker->createDog();