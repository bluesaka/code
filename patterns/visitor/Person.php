<?php

namespace visitor;

class Person implements PersonInterface
{
    public function eat(VisitorInterface $visitor)
    {
        $visitor->eat();
    }
}