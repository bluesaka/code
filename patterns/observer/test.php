<?php
/**
 * 观察者模式
 *      观察者观察被观察者，被观察者通知观察者，观察者做出相应的动作
 */

include '../../autoload.php';

use observer\Observed;
use observer\ObserverA;
use observer\ObserverB;

$observed = new Observed();

$observed->register(new ObserverA);
$observed->register(new ObserverB);

$observed->trigger('Add', ['name'=>'adam', 'age'=>22]);
$observed->trigger('Update', ['name'=>'felix', 'age'=>21]);