<?php

namespace DI;

class Ioc
{
    private $binds;
    private $instances;

    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof \Closure)
            $this->binds[$abstract] = $concrete;
        else
            $this->instances[$abstract] = $concrete;
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract]))
            return $this->instances[$abstract];

        array_unshift($parameters, $this); // [$this, 'param'] -> Closure -> $this->make('param') -> return $concrete

        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}