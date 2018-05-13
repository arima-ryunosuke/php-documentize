<?php

/**
 * namespace vendor comment
 */
namespace vendor {

    trait Ttrait
    {
    }

    class Single
    {
    }

    class Hoge
    {
    }

    class Fuga
    {
    }

    class Piyo
    {
    }
}

/**
 * namespace vendor\Inner comment
 */
namespace vendor\Inner {

    class Foo
    {
    }

    class Bar
    {
    }
}

namespace vendor\subspace {

    /** const doc */
    const FOO = 0;
    function bar() { }

    class SubClass
    {
    }
}

/**
 * namespace global comment
 */
namespace {

    use ArrayObject as AO;
    use vendor\{
        Single
    };
    use vendor\{
        Fuga, Hoge, Inner\Bar as InnerBar, Inner\Foo, Piyo
    };
    use vendor\subspace as Sub;
    use vendor\Ttrait;
    use const vendor\subspace\FOO;
    use function vendor\subspace\bar;

    /**
     * @return callable|AO|Single|Hoge|Fuga|Piyo|Foo|InnerBar|Sub\SubClass 使用しないとコードフォーマッターで吹き飛んでしまうので無理やり使用
     */
    function f()
    {
        $a = 0;
        return function () use ($a) {
            echo FOO;
            bar();
        };
    }

    class C
    {
        use Ttrait;

        public function method()
        {
            $a = 0;
            return function () use ($a) { };
        }
    }

    interface I
    {
        const INTERFACE_CONST = [
            'k1' => 'v1',
            'k2' => 'v2',
        ];

        public function method();
    }

    trait T
    {
        public function method1()
        {
            $t = 1;
            return $t;
        }

        private static $staticProperty;
        private        $traitProperty = [
            'dummy',
        ];

        public function method2()
        {
            $t = 1;
            return $t;
        }
    }
}

namespace NS {

    class P
    {
        const EXTERNAL    = \SORT_ASC;
        const CLASS_CONST = \I::INTERFACE_CONST;
    }

    class C extends P implements \I
    {
        use \T;

        public function method1()
        {
            $t = 1;
            return $t;
        }

        private const PRIVATE_CONST = 123;
        const         PUBLIC_CONST  = 123;

        static private $staticProperty;
        protected      $classProperty = [
            'dummy',
            'dummy',
        ];

        public function method2()
        {
            $t = 1;
            return $t;
        }

        public function method()
        {
            $t = 1;
            return $t;
        }

        function func() { }

        function &refunc() { }
    }
}
