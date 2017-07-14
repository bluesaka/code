<?php

namespace filter;

class FilterGender implements FilterInterface
{
    private $gender = '';

    public function __construct($gender = '')
    {
        $this->gender = $gender;
    }

    public function filter($persons = [])
    {
        $personFilter = [];
        foreach ($persons as $person) {
            if ($person->gender == $this->gender)
                $personFilter[] = $person;
        }
        return $personFilter;
    }

}