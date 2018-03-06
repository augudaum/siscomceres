<?php

    namespace app\classes;

    class Password {

        public static function hash($password) {
            $options = [
                'cost' => 12
            ];

            return password_hash($password, PASSWORD_DEFAULT, $options);
        }

        public static function verify($password, $hash) {
            return password_verify($password, $hash);
        }

    }