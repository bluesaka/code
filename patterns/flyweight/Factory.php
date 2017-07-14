<?php

namespace flyweight;

class Factory
{
    private $animalMap = [];

    public function create($animal)
    {
        if (isset($this->animalMap[$animal])) {
            echo "来自缓存：";
            return $this->animalMap[$animal];
        }

        switch ($animal) {
            case 'dog':
                return $this->animalMap[$animal] = new Dog();
            case 'pig':
                return $this->animalMap[$animal] = new Pig();
            default:
                return '';
        }
    }
}