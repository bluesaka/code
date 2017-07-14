<?php
/**
 * 策略模式
 *      选择不同的策略
 */

include '../../autoload.php';

use strategy\Instance;
use strategy\StrategyA;
use strategy\StrategyB;

$strategy = new Instance(new StrategyA);
$strategy->doSomething();

$strategy = new Instance(new StrategyB);
$strategy->doSomething();