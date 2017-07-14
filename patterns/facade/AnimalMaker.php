<?php

namespace facade;

class AnimalMaker
{
    public function createPig()
    {
        (new Pig())->create();
    }

    public function createDog()
    {
        (new Dog())->create();
    }
}