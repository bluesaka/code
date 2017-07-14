<?php

require 'Counter.php';

$counter = new Counter();

$key = 'user_adam';

$counter->up($key);
$counter->up($key);
$counter->down($key);

echo $counter->getCounter($key);

$key2 = 'users';
$hashKey = 'felix';

$counter->upHash($key2, $hashKey);
$counter->upHash($key2, $hashKey);
$counter->upHash($key2, $hashKey);
$counter->downHash($key2, $hashKey);

echo $counter->getHashCounter($key2, $hashKey);