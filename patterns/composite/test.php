<?php
/**
 * 组合模式
 *      把对象以树形结构组合起来，以达成“部分 —— 整体”的层次结构
 */

include '../../autoload.php';

use composite\Folder;
use composite\File;

$root = new Folder('根目录');
$home = new Folder('home');
$bin = new Folder('bin');
$log = new Folder('log');
$dev = new Folder('dev');
$file1 = new File('file1');
$file2 = new File('file2');

$root->add($home);
$home->add($file1);
$bin->add($file2);
$root->add($bin);
$root->add($log);
$root->add($file1);
$file1->add($file2);

$root->delete($log);
$root->delete($dev);
$root->delete($file2);
$file1->delete($file2);

$root->operate();
$file1->operate('write', 'file content');
$file1->operate('read');
$file2->operate('read');

$root->printSubset();
$file1->printSubset();