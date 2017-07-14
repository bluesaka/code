<?php

namespace nullObject;

class Student extends Person
{
    function call($person)
    {
        echo "老师{$person->getName()}点名学生{$this->getName()}" . PHP_EOL;
    }

}