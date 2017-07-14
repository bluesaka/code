<?php

namespace template;

class SmsB extends Sms
{
    public function initialize($config = [])
    {
        $this->config = $config;
    }

    public function sendSms($mobile = 0)
    {
        echo "B公司给手机号{$mobile}发送短信，内容为：" . $this->text . PHP_EOL;
    }

}