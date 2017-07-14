<?php
/**
 * curl高并发模拟抢锁
 * multi开始时间：13:13  multi结束时间：13:21
 * 第1次请求：抢锁成功，当前时间：13:21
 * 第2次请求：lock已超时，重新生成，当前时间：13:21
 * 第3次请求：抢锁成功，当前时间：13:13
 * 第4次请求：lock已超时，重新生成，当前时间：13:13
 * 第5次请求：lock正在使用，当前时间：13:13, lock值：13:18
 * .....
 * 第100次请求：抢锁成功，当前时间：13:21
 *
 * 测试结果：成功：49， 超时：32， 正在使用：19
 */

$url = 'http://localhost/code/redis/lock/test.php';
$mh = curl_multi_init();
$chs = [];

for ($i = 1; $i <= 100; ++ $i) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_multi_add_handle($mh, $ch);
    $chs[$i] = $ch;
}

echo "multi开始时间：" . date('i:s') . PHP_EOL;
do {
    curl_multi_exec($mh, $running);
} while ($running > 0);
echo "multi结束时间：" . date('i:s') . PHP_EOL;

foreach ($chs as $k => $ch) {
    $d = curl_multi_getcontent($ch);
    echo "第{$k}次请求：";
    var_dump($d);
    echo "----------------------------------------" . PHP_EOL;
}

curl_multi_close($mh);