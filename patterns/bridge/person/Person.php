<?php

namespace bridge\person;

use bridge\action\ActionInterface;

abstract class Person
{
    protected $action;
    protected $who;

    public function __construct(ActionInterface $action)
    {
        $this->action = $action;
    }

    abstract function action();
}