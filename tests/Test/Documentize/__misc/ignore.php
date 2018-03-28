<?php

namespace {

    if (!function_exists('extern')) {
        function extern()
        {
            static $count = 0;
            $count++;
            eval("function func_$count(){}");

            return new class()
            {
            };
        }
    }

    extern();
}
