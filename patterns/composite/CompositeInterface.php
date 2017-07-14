<?php

namespace composite;

interface CompositeInterface
{
    public function getName();
    public function add(CompositeInterface $composite);
    public function delete(CompositeInterface $composite);
    public function operate();
    public function printSubset($counter = 0);
}