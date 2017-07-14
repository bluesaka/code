<?php
/**
 * 状态模式
 *      行为随着状态变化
 *      策略模式的改变由客户端完成，客户端掌握着上下文context
 *      状态模式的改变由本身完成，状态模式本身掌握上下文
 */

include '../../autoload.php';

use state\Season;

$season = new Season();

$season->come(); // 春天来了
$season->go(); // 春天走了

$season->come(); // 夏天来了
$season->go(); // 夏天走了

$season->come(); // 秋天来了
$season->go(); // 秋天走了

$season->come(); // 冬天来了
$season->go(); // 冬天走了

$season->come(); // 春天来了
$season->go(); // 春天走了