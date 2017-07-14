<?php

namespace observer;

class Observed
{
    // 观察者集合
    private $observers = [];

    // 注册观察者
    public function register(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    // 触发观察者做出相应动作
    public function trigger($action, $param)
    {
        foreach ($this->observers as $observer) {
            /**@var Observer $observer*/
            $observer->action($action, $param);
        }
    }
}