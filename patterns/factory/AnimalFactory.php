<?php

namespace factory;

class AnimalFactory implements Factory
{
    public function __construct()
    {
        echo "创建了一个动物工厂" . PHP_EOL;
    }

    public function create($animal = '')
    {
        switch ($animal) {
            case 'dog':
                return new Dog();
            case 'cat':
                return new Cat();
            default:
                echo "error: not found -> $animal" . PHP_EOL;
                break;
        }
    }

}