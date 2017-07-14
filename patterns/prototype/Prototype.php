<?php

namespace prototype;

class Prototype extends PrototypeAbstract
{
    public function __construct($name = '')
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        echo 'name is: ' . $this->name . PHP_EOL;
    }

    public function getPrototype()
    {
        // clone 克隆对象，浅复制对象和属性
        return clone $this;
    }
}