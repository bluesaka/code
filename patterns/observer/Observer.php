<?php

namespace observer;

abstract class Observer
{
    public function action($action, $param)
    {
        $func = 'actionFor' . $action;
        return $this->$func($param);
    }
}