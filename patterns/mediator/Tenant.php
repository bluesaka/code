<?php

namespace mediator;

class Tenant extends Person
{
    function doSomething()
    {
        echo "租客{$this->getName()}想租房子" . PHP_EOL;
    }

}