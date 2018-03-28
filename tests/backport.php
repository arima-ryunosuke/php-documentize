<?php

// phpstorm では ReflectionClassConstant が無いことになってる（未対応？）のでエラーを抑止するためにダミーで定義
// こうやって定義しておけば少なくとも警告は抑止されるし補完にも出る。phpstorm が対応してくれたらまるっと消せば良い

if (false) {
    class ReflectionClass
    {
        /**
         * @param string $name
         * @return \ReflectionClassConstant
         */
        public function getReflectionConstant($name) { }

        /**
         * @return \ReflectionClassConstant[]
         */
        public function getReflectionConstants() { }
    }

    class ReflectionClassConstant
    {
        public $name;
        public $class;

        public static function export($class, $name, $return = false) { }

        public function __construct($class, $name) { }

        /**
         * @return \ReflectionClass
         */
        public function getDeclaringClass() { }

        public function getDocComment() { }

        public function getModifiers() { }

        /**
         * @return string
         */
        public function getName() { }

        public function getValue() { }

        public function isPrivate() { }

        public function isProtected() { }

        public function isPublic() { }

        public function __toString() { return ''; }
    }
}
