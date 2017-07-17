<?php

include '../../autoload.php';

use DI\Person;
use DI\IQ;
use DI\EQ;

$IQ = new IQ();
$EQ = new EQ();

/**
 * 这就是DI依赖注入的雏形
 * 没有内部依赖（比如初始化、构造函数等方法中直接去new另外一个对象）
 * 由外部以参数或者其他形式注入，都属于依赖注入
 */
$person = new Person($IQ);
$person->addAttr($EQ);

$person->printAttrs();