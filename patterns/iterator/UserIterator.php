<?php

namespace iterator;

class UserIterator implements Iterator
{
    private $index = 0;
    private $users = [];

    public function __construct(UserStar $userStar)
    {
        $this->users = $userStar->getUsers();
    }

    public function hasNext()
    {
        if ($this->index < count($this->users) - 1)
            return true;
        return false;
    }

    public function next()
    {
        if (!$this->hasNext()) {
            echo NULL;
            return;
        }
        $this->index ++;
        echo $this->users[$this->index] . PHP_EOL;
    }

    public function current()
    {
        echo $this->users[$this->index] . PHP_EOL;
    }

    public function index()
    {
        echo $this->index . PHP_EOL;
    }

}