<?php

namespace observer;

class ObserverB extends Observer
{
    public function actionForAdd($param)
    {
        echo "观察者B对Add操作做出动作，参数为：" . json_encode($param) . PHP_EOL;
    }

    public function actionForUpdate($param)
    {
        echo "观察者B对Update操作做出动作，参数为：" . json_encode($param) . PHP_EOL;
    }
}