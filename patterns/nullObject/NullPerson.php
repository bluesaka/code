<?php

namespace nullObject;

class NullPerson extends Person
{
    function call($person)
    {
        echo "空对象" . PHP_EOL;
    }

}