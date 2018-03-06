<?php

    namespace app\classes;

    class Flash {

        /**
         * Método responsável por adicionar mensagens
         * @param $messages = Array de valores associativos ['key' => 'mensagem']
         */
        public static function add(array $messages) {
            foreach ($messages as $key => $message) {
                if (!isset($_SESSION['flash'][$key])) {
                    $_SESSION['flash'][$key] = $message;
                }
            }
        }

        public static function get($index, $type) {
            if (isset($_SESSION['flash'][$index])) {
                $messages = $_SESSION['flash'][$index];

                unset($_SESSION['flash'][$index]);

                return isset($messages) ? static::getMessage($messages, $type) : '';
            }

            return '';
        }

        private static function getMessage($messages, $type = 'negative') {
            if (!is_array($messages)) {
                return static::singleMessage($messages, $type);
            }
            return static::multipleMessages($messages, $type);
        }

        private static function singleMessage($message, $type) {
            return '<div class="ui floating '.$type.' message">
                        <p>'.$message.'</p>
                    </div>';
        }

        private static function multipleMessages($messages, $type) {
            $list = '';

            foreach ($messages as $message) {
                $list .= '<li>'.$message.'</li>';
            }

            $div = '<div class="ui '.$type.' message">';
            $div.= '  <i class="close icon"></i>';
            $div.= '  <div class="header" style="text-align: left;">';
            $div.= '    Preencha os campos corretamente';
            $div.= '  </div>';
            $div.= '  <ul class="list">';
            $div.= $list;
            $div.= '  </ul>';
            $div.= '</div>';

            echo $div;
        }
    }