<?php

namespace nullObject;

abstract class Person
{
    private $name = '';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    abstract function call($person);
}