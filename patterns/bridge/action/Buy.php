<?php

namespace bridge\action;

class Buy implements ActionInterface
{
    public function action($food = '')
    {
        echo "买" . $food . PHP_EOL;
    }
}