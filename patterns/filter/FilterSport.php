<?php

namespace filter;

class FilterSport implements FilterInterface
{
    private $sport = '';

    public function __construct($sport = '')
    {
        $this->sport = $sport;
    }

    public function filter($persons = [])
    {
        $personFilter = [];
        foreach ($persons as $person) {
            if ($person->sport == $this->sport)
                $personFilter[] = $person;
        }
        return $personFilter;
    }

}