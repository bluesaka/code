<?php

namespace mediator;

class HouseMediator
{
    public function rentHouse(Person $renter, Person $tenant)
    {
        echo "中介介入：" . PHP_EOL;
        $tenant->doSomething();
        $renter->doSomething();
        echo "中介帮房东{$renter->getName()}找到租客{$tenant->getName()}" . PHP_EOL;
    }
}