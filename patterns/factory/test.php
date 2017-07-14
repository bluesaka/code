<?php
/**
 * 工厂模式
 *      定义一个创建对象的接口，让子类去实例化
 */

include '../../autoload.php';

use factory\AnimalFactory;

$animalFactory = new AnimalFactory();
$animalFactory->create('dog');
$animalFactory->create('cat');
$animalFactory->create('pig');