<?php
/**
 * 命令行模式
 *      在依赖的类中加一个命令类，使类方法的调用通过命令类来完成，达到解耦的目的
 *      其次可以实现撤销、后退等操作，因为命令类保存了调用对象
 */

include '../../autoload.php';

use command\Text;
use command\CommandCreate;
use command\CommandWrite;
use command\CommandSave;
use command\Console;

$text = new Text();

$create = new CommandCreate($text, [
    'filename' => 'hello.txt',
]);

$write = new CommandWrite($text, [
    'filename' => 'hello.txt',
    'content' => 'hello world!',
]);

$save = new CommandSave($text, [
    'filename' => 'hello.txt',
]);

$console = new Console();
$console->add($create);
$console->add($write);
$console->add($save);

$console->run();