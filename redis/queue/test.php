<?php

require 'RedisQueue.php';

$queue = new RedisQueue();

$key = 'user_list';

$queue->enqueue($key, 'user_1');
$queue->enqueue($key, 'user_2');
$queue->enqueue($key, 'user_3');

echo $queue->dequeue($key);
echo $queue->dequeue($key);