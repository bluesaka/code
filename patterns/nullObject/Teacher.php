<?php

namespace nullObject;

class Teacher extends Person
{
    function call($person)
    {
        if (!$person instanceof Student) { // instanceof运算符优先级高于!
            $person = new NullPerson('');
        }

        $person->call($this);
    }

}