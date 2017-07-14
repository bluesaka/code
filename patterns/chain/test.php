<?php
/**
 * 责任链模式
 *      把一个对象传递到一个对象链上，直到有对象处理这个对象
 *      使用场景：过滤器、网关等
 */

include '../../autoload.php';

use chain\Request;
use chain\HandlerA;
use chain\HandlerB;
use chain\HandlerC;

$request = new Request();
$request->setRequestId(uniqid());

$handlerA = new HandlerA();
$handlerB = new HandlerB();
$handlerC = new HandlerC();

$handlerA->setNext($handlerB)
         ->setNext($handlerC);

$handlerA->start($request);