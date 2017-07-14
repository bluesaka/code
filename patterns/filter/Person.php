<?php

namespace filter;

class Person
{
    private $name = '';
    private $gender = '';
    private $sport = '';

    public function __construct($name = '', $gender = '', $sport = '')
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->sport = $sport;
    }

    public function __get($key)
    {
        return $this->$key;
    }
}