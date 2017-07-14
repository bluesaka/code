<?php
/**
 * 中介者模式
 *      不同的对象之间通信，互相之间不能直接调用，而是通过一个中间对象
 *      使用场景：对象之间存在大量的相互依赖
 */

include '../../autoload.php';

use mediator\Tenant;
use mediator\Renter;
use mediator\HouseMediator;

$tenant = new Tenant('Adam');
$tenant->doSomething();

$renter = new Renter('Felix');
$renter->doSomething();

$mediator = new HouseMediator();
$mediator->rentHouse($renter, $tenant);
