<?php

namespace chain;

class HandlerB extends Handler
{
    function check(Request $request)
    {
        echo "请求{$request->getRequestId()}检查B" . PHP_EOL;
    }

}