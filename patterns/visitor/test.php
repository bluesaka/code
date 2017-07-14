<?php
/**
 * 访问者模式
 *      和策略模式相似，都是实体类依赖外部的算法
 *      策略模式：有一堆算法，然后在不同逻辑中使用
 *      访问者模式：实体结构是稳定的， 但结构中的元素算法是多多变的，比如人吃饭这个动作是稳定的，不过具体吃的行为是多变的
 */

include '../../autoload.php';

use visitor\Person;
use visitor\VisitorChina;
use visitor\VisitorJapan;

$person = new Person();
$person->eat(new VisitorChina);
$person->eat(new VisitorJapan);