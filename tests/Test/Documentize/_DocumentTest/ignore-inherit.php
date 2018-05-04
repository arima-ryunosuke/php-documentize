<?php

namespace Ignore {

    trait IgnoreInheritT
    {
        /** @ignoreinherit */
        function ignoreM() { }

        /** @ignoreinherit */
        function noignoreM() { }
    }

    class C
    {
        use IgnoreInheritT;

        function noignoreM() { }
    }
}
