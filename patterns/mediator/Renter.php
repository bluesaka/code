<?php

namespace mediator;

class Renter extends Person
{
    function doSomething()
    {
        echo "房东{$this->getName()}想把房子租出去" . PHP_EOL;
    }

}