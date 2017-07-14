<?php

namespace chain;

abstract class Handler
{
    private $nextHandler;

    abstract function check(Request $request);

    public function setNext(Handler $handler)
    {
        return $this->nextHandler = $handler;
    }

    public function start(Request $request)
    {
        $this->check($request);
        if ($this->nextHandler)
            $this->nextHandler->start($request);
    }
}