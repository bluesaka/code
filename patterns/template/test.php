<?php
/**
 * 模板模式
 *      典型的控制反转，子类复写方法，但最终都是调用抽象类中的方法
 *      使用场景：如发送短信，有不同的运营商，但发送短信的动作是一样的，如需增加运营商，只需添加子类即可
 */

include '../../autoload.php';

use template\SmsA;
use template\SmsB;

$sms = new SmsA(['token' => 'aaaaa']);
$sms->send('15866668888');

$sms = new SmsB(['appkey' => 'bbbbb']);
$sms->send('15877779999');