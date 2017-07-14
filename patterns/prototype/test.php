<?php
/**
 * 原型模式
 *      用于创建对象成本过高时
 */

include '../../autoload.php';


$prototype = new \prototype\Prototype();

$clone1 = $prototype->getPrototype();
$clone1->setName('aa');
$clone1->getName();

$clone2 = $prototype->getPrototype();
$clone2->setName('bb');
$clone2->getName();

$clone1->getName();