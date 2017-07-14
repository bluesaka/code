<?php

namespace visitor;

interface PersonInterface
{
    public function eat(VisitorInterface $visitor);
}