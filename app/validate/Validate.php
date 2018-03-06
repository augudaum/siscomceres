<?php
    namespace app\validate;

    abstract class Validate {

        private $errors = [];

        /**
         * Verifica quais campos deverão ser obrigatórios
         * @param $fields = array contendo os campos, ex.: ['nome', 'senha']. Caso seja vazio, todos os campos serão obrigatórios.
         */
        public function required($fields) {
            $this->fieldsIsArray($fields);

            if (empty($fields)) {
                foreach ($_POST as $key => $value) {
                    $this->isEmpty($key);
                }
            }

            foreach ($fields as $key => $field) {
                $this->isEmpty($field);
            }
        }

        public function email($fields) {
            $this->fieldsIsArray($fields);

            foreach ($fields as $key => $field) {
                if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "E-mail inválido!";
                }
            }
        }

        public function max($fields) {
            $this->fieldsIsArray($fields);

            foreach ($fields as $key => $length) {
                if (strlen($_POST[$key]) > $length) {
                    $this->errors[$key][] = "O campo '{$key}' deve ter, no máximo, {$length} caracteres";
                }
            }
        }

        public function unique($fields) {
            $this->fieldsIsArray($fields);

            foreach ($fields as $key => $model) {
                $model = new $model;
                if ($model->findBy($key, $_POST[$key])) {
                    $this->errors[$key][] = "Insira um valor único!";
                }
            }
        }

        public function hasErrors() {
            return !empty($this->errors);
        }

        public function getErrors() {
            return $this->errors;
        }
        
        private function isEmpty($field) {
            if (empty($_POST[$field])) {
                $this->errors[$field][] = "Esse campo não pode ficar vazio!";
            }
        }

        private function fieldsIsArray($fields) {
            if (!is_array($fields)) {
                throw new Exception("Somente arrays serão aceitos para a validação.");
            }
        }

        /**
         * Qualquer classe que herdar esta, deverá implementar esse método, codificando quais validações serão feitas
         */
        abstract protected function validate();
    }