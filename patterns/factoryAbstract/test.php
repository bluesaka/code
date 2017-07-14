<?php
/**
 * 抽象工厂模式
 *      工厂，负责生产对象
 *      抽象工厂，负责生产工厂
 */

include '../../autoload.php';

$nike = new \factoryAbstract\nike\NikeFactory();
$adidas = new \factoryAbstract\adidas\AdidasFactory();

$nike->createShoe()->produce();
$nike->createShoe()->sale();
$nike->createClothes()->sale();
$adidas->createShoe()->sale();
$adidas->createClothes()->sale();

