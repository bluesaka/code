<?php
/**
 * 解析器模式
 *      一个上下文的连接器
 *      使用场景：构建一个编译器，SQL解析器
 */

include '../../autoload.php';

use interpreter\SqlInterpreter;

SqlInterpreter::table('user')->insert([
    'name' => 'adam',
    'age' => 22,
]);

SqlInterpreter::table('user')->delete([
    'name' => 'adam',
    'age' => 22,
]);

SqlInterpreter::table('user')->update([
    'name' => 'adam',
    'age' => 22,
]);

SqlInterpreter::table('user')->find([
    'name' => 'adam',
    'age' => 22,
]);