<?php

namespace visitor;

class VisitorJapan implements VisitorInterface
{
    public function eat()
    {
        echo "来日本旅游，吃三文鱼~ " . PHP_EOL;
    }
}