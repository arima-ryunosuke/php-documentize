<?php

namespace IgnoreSpace1 {

    require_once __DIR__ . '/../__misc/ignore.php';

    const C = 0;

    function f() { }

    class C
    {

    }
}

namespace IgnoreSpace2 {

    const C = 0;

    function normalF() { }

    function exceptF() { }

    /**
     * @deprecated
     */
    function deprecatedF() { }

    /**
     * @internal
     */
    function internalF() { }

    /**
     * @ignore
     */
    function ignoreF() { }

    class normalC
    {

    }

    class exceptC
    {

    }

    /**
     * @deprecated
     */
    class deprecatedC
    {

    }

    /**
     * @internal
     */
    class internalC
    {

    }

    /**
     * @ignore
     */
    class ignoreC
    {

    }

    /**
     * @property int $magicP
     * @property int failoMagicP
     * @method int magicM()
     * @method int failMagicM
     * @method int deprecatedMagicM() @deprecated
     * @method int internalMagicM() @internal
     */
    class C
    {
        const           exceptC = 0;
        /** @internal */
        const internalC = 0;
        /** @deprecated */
        const           deprecatedC = 0;

        private const   privateC   = 0;
        protected const protectedC = 0;
        public const    publicC    = 0;

        var $exceptP = 0;
        /** @internal */
        var $internalP = 0;
        /** @deprecated */
        var $deprecatedP = 0;

        private   $privateP   = 0;
        protected $protectedP = 0;
        public    $publicP    = 0;

        function exceptM() { }

        /** @internal */
        function internalM() { }

        /** @deprecated */
        function deprecatedM() { }

        private function privateM() { }

        protected function protectedM() { }

        public function publicM() { }
    }

    class C2 extends C
    {
    }
}

namespace IgnoreSpace3 {

    function nocontainF() { }
}
