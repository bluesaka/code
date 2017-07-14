<?php

namespace iterator;

class UserStar implements UserInterface
{
    private $users = [];

    public function addUser($user)
    {
        $this->users[] = $user;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getUserIterator()
    {
        return new UserIterator($this);
    }

}