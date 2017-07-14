<?php
/**
 * 建造者模式
 *      简单对象组合成复杂对象
 *      组合方式多变
 */

include '../../autoload.php';

$phone = new \builder\PhoneBuilder('iPhone 7',
    [
        'screen' => '4.7',
        'camera' => '1200',
    ],
    [
        'os' => 'ios',
        'version' => '10.0.3'
    ]
);

$phone = new \builder\PhoneBuilder('小米6',
    [
        'screen' => '5.5',
        'camera' => '2000',
    ],
    [
        'os' => 'android',
        'version' => '6'
    ]
);

$computer = new \builder\ComputerBuilder('联想',
    [
        'screen' => '21',
        'camera' => '500',
    ],
    [
        'os' => 'Windows',
        'version' => '10',
    ]
);