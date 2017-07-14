<?php

namespace iterator;

interface Iterator
{
    public function hasNext();
    public function next();
    public function current();
    public function index();
}
