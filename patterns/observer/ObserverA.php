<?php

namespace observer;

class ObserverA extends Observer
{
    public function actionForAdd($param)
    {
        echo "观察者A对Add操作做出动作，参数为：" . json_encode($param) . PHP_EOL;
    }

    public function actionForUpdate($param)
    {
        echo "观察者A对Update操作做出动作，参数为：" . json_encode($param) . PHP_EOL;
    }
}