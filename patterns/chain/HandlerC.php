<?php

namespace chain;

class HandlerC extends Handler
{
    function check(Request $request)
    {
        echo "请求{$request->getRequestId()}检查C" . PHP_EOL;
    }

}