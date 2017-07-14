<?php

namespace chain;

class HandlerA extends Handler
{
    function check(Request $request)
    {
        echo "请求{$request->getRequestId()}检查A" . PHP_EOL;
    }

}