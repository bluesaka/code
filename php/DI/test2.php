<?php

include '../../autoload.php';

use DI\Person;
use DI\Ioc;
use DI\IQ;
use DI\EQ;

$ioc = new Ioc();

// binds
$ioc->bind('person', function(Ioc $container, $attr) {
    return new Person($container->make($attr)); // new Person(new IQ())
});

// instances
$ioc->bind('IQ', new IQ());
$ioc->bind('EQ', new EQ());

$p1 = $ioc->make('person', ['IQ']);
$p2 = $ioc->make('person', ['EQ']);