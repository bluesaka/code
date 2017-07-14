<?php
/**
 * 备忘录模式
 *      外部存储对象的状态，已提供恢复、后退上下文等的操作
 *      使用场景：编辑器、数据库事务、存档
 */

include '../../autoload.php';

use memo\Editor;

$editor = new Editor('init text | ');

echo "第1次写入：" . PHP_EOL;
$editor->write('first text | ');
$editor->save();
$editor->read();

echo "----------------------" . PHP_EOL . "第2次写入：" . PHP_EOL;
$editor->write('second text | ');
$editor->read();

echo "----------------------" . PHP_EOL . "第1次撤销：" . PHP_EOL;
$editor->undo();
$editor->read();

echo "----------------------" . PHP_EOL . "第3次写入：" . PHP_EOL;
$editor->write('third text | ');
$editor->save();
$editor->read();

echo "----------------------" . PHP_EOL . "第1次重做：" . PHP_EOL;
$editor->redo();
$editor->read();

echo "----------------------" . PHP_EOL . "第2次重做：" . PHP_EOL;
$editor->redo();
$editor->read();