<?php

include '../../autoload.php';

use DI\Person;
use DI\IQ;
use DI\EQ;

$IQ = new IQ();
$EQ = new EQ();

$person = new Person($IQ);
$person->addAttr($EQ);

$person->printAttrs();