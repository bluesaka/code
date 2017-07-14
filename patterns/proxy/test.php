<?php
/**
 * 代理器模式
 *      对对象加以控制
 *      和适配器的区别：适配器是连接两个接口（改变了接口）
 *      和装饰器的区别：装饰器是对对象进行包装（功能扩展）
 */

include '../../autoload.php';

use proxy\ShoeNike;
use proxy\Proxy;

$nike = new ShoeNike();
$nike->produce();

$proxy = new Proxy('nike');
$proxy->produce();

$proxy = new Proxy('adidas');
$proxy->produce();