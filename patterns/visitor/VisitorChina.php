<?php

namespace visitor;

class VisitorChina implements VisitorInterface
{
    public function eat()
    {
        echo "来中国旅游，吃火锅~ " . PHP_EOL;
    }
}