<?php
/**
 * 空对象模式
 *      当程序运行过程中出现操作空对象时，程序依然能够通过操作提供的空对象继续执行
 */

include '../../autoload.php';

use nullObject\Teacher;
use nullObject\Student;

$teacher = new Teacher('TT');

$student1 = new Student('s1');
$student2 = new Student('s2');

$teacher->call($student1);
$teacher->call($student2);
$teacher->call('nobody');