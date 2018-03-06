<?php

    namespace app\validate;

    use app\classes\Password;

    class Sanitize {

        // Array contendo os atributos sanitizados;
        protected $sanitized = [];

        public function sanitized() {
            $post = $_POST;

            foreach ($post as $name => $value) {
                $this->sanitized[$name] = filter_var($value, FILTER_SANITIZE_STRING);
            }

            return $this;
        }

        public function get() {
            return (object) $this->sanitized;
        }

        public function hash() {
            if (array_key_exists('senha', $this->sanitized)) {
                $this->sanitized['senha'] = filter_var(Password::hash($this->sanitized['senha']), FILTER_SANITIZE_STRING);
            }
            return (object) $this->sanitized;
        }
    }