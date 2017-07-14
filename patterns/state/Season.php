<?php

namespace state;

class Season
{
    private $season = '';
    private $seasons = ['spring', 'summer', 'autumn', 'winter'];
    private $state;

    public function __construct($season = 'spring')
    {
        $this->season = $season;
        $this->setStat();
    }

    public function setStat()
    {
        switch ($this->season) {
            case 'spring':
                $this->state = new Spring();
                break;
            case 'summer':
                $this->state = new Summer();
                break;
            case 'autumn':
                $this->state = new Autumn();
                break;
            case 'winter':
                $this->state = new Winter();
                break;
            default:
                break;
        }
    }

    public function nextStat()
    {
        $index = array_search($this->season, $this->seasons);
        if ($index == count($this->seasons) - 1)
            $this->season = $this->seasons[0];
        else
            $this->season = $this->seasons[$index+1];
        $this->setStat();
    }

    public function come()
    {
        $this->state->come();
    }

    public function go()
    {
        $this->state->go();
        $this->nextStat();
    }
}