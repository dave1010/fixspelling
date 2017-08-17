<?php

function fixspelling($wrapped) {
    return new class ($wrapped) {
        private $wrapped;
        private $methods;

        public function __construct($wrapped)
        {
            $this->wrapped = $wrapped;
            $this->methods = array_map(function($method) {
                return $method->name;
            }, (new ReflectionClass($wrapped))->getMethods(ReflectionMethod::IS_PUBLIC));
        }

        public function __call(string $name, array $args)
        {
            usort($this->methods, function(string $a, string $b) use ($name) {
                return levenshtein($name, $a) <=> levenshtein($name, $b);
            });
            return call_user_func_array([$this->wrapped, $this->methods[0]], $args);
        }
    };
}

