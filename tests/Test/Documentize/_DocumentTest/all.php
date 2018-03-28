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
         * class method comment
         *
         * {@inheritdoc}
         *
         * @param int $arg classMethod arg comment
         * @return self classMethod return comment
         */
        public function classMethod(int $arg) { }

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
