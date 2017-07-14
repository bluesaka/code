<?php
/**
 * 过滤器模式
 *      使用不同的标准来过滤对象
 */

include '../../autoload.php';

use filter\Person;
use filter\FilterGender;
use filter\FilterSport;

$persons = [];
$persons[] = new Person('a', 'male', 'basketball');
$persons[] = new Person('b', 'male', 'basketball');
$persons[] = new Person('c', 'male', 'football');
$persons[] = new Person('d', 'female', 'football');
$persons[] = new Person('e', 'male', 'volleyball');
$persons[] = new Person('f', 'female', 'volleyball');
$persons[] = new Person('g', 'male', 'tennis');

$filterGender = new FilterGender('male');
$filterSport = new FilterSport('basketball');

$persons = $filterGender->filter($persons);
var_dump($persons);

$persons = $filterSport->filter($persons);
var_dump($persons);