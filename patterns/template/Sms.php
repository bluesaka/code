<?php

namespace template;

abstract class Sms
{
    protected $text = '[宇宙最强公司]您好，您的验证码是';
    protected $config = [];

    final function __construct()
    {
        $this->initialize();
    }

    abstract function initialize();

    abstract function sendSms($mobile = 0);

    final function getText()
    {
        $this->text .= mt_rand(100000, 999999);
    }

    final function send($mobile = 0)
    {
        $this->getText();
        $this->sendSms($mobile);
    }
}