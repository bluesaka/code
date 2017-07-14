<?php
/**
 * 装饰器模式
 *      对现有对象增加功能
 *      和适配器的区别：适配器链接两个接口，装饰器是对现有对象进行包装
 */

include '../../autoload.php';

use decorator\ShoeNike;
use decorator\ShoeAdidas;
use decorator\ShoeDecoratorPrice;
use decorator\ShoeDecoratorSize;

$nike = new ShoeNike();
$nike->produce();

$adidas = new ShoeAdidas();
$adidas->produce();

$decoratorPrice = new ShoeDecoratorPrice(new ShoeNike());
$decoratorPrice->setPrice(600);
$decoratorPrice->produce();

$decoratorPrice = new ShoeDecoratorPrice(new ShoeAdidas());
$decoratorPrice->setPrice(800);
$decoratorPrice->produce();

$decoratorSize = new ShoeDecoratorSize(new ShoeNike());
$decoratorSize->setSize(42);
$decoratorSize->produce();