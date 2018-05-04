<?php

namespace GlobalSpace {

    eval('const EvalConst = null;');
    eval('function EvalFunction(){}');
    eval('class EvalClass{}');

    const globalConstant = 1;

    /**
     * function comment
     *
     * @param int $arg globalFunction arg comment
     * @return int globalFunction return comment
     * @see GlobalInterface::interfaceMethod()
     */
    function globalFunction(int $arg): int { }

    /**
     * interface comment
     */
    interface GlobalInterface extends \IteratorAggregate
    {
        /**
         * interface const comment
         */
        const interfaceConstant = 1;

        /**
         * interface method comment
         *
         * @param int $arg interfaceMethod arg comment
         * @return int interfaceMethod return comment
         */
        function interfaceMethod(int $arg): int;
    }

    trait GlobalUsing
    {
    }

    /**
     * trait comment
     */
    trait GlobalTrait
    {
        use GlobalUsing;

        /**
         * trait property comment
         */
        protected $traitProperty = 1;

        /**
         * trait method comment
         *
         * @param int $arg traitMethod arg comment
         * @return int traitMethod return comment
         */
        public function traitMethod(int $arg): int { }
    }

    /**
     * {@inheritdoc \Invalid}
     */
    class GlobalParent
    {
        /**
         * class method1 comment
         *
         * @param int $arg classMethod1 arg comment
         * @return self classMethod1 return comment
         */
        public function classMethod1(int $arg) { }

        /**
         * class method2 comment
         *
         * @param int $arg classMethod2 arg comment
         * @return self classMethod2 return comment
         */
        public function classMethod2(int $arg) { }
    }

    /**
     * class comment
     *
     * {@inheritdoc}
     *
     * @property string $magicProperty
     * @method string magicMethod(int | string $args)
     */
    class GlobalClass extends GlobalParent implements GlobalInterface
    {
        use GlobalTrait;

        /**
         * class property comment
         */
        protected $globalProperty = 1;

        /**
         * self method comment
         *
         * {@inheritdoc}
         *
         * @param int $arg selfMethod arg comment
         * @return self selfMethod return comment
         */
        public function selfMethod(int $arg) { }

        /**
         * class method1 comment
         *
         * @inheritdoc
         *
         * @param int $arg override classMethod1 arg comment
         * @return self override classMethod1 return comment
         */
        public function classMethod1(int $arg) { }

        /**
         * class method2 comment
         *
         * @inheritdoc
         */
        public function classMethod2(int $arg) { }

        /**
         * {@inheritdoc}
         */
        function interfaceMethod(int $arg): int { }

        /**
         * @inheritdoc
         */
        public function noprototypeMethod() { }

        /**
         * @inheritdoc GlobalTrait::traitMethod
         */
        public function getIterator() { }
    }
}

namespace A\B\C {

    function abc_function() { }
}
