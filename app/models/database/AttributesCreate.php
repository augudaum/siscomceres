<?php
    namespace app\models\database;

    class AttributesCreate {

        // Método que trabalha os atributos do create
        public function createFields($attributes) {
            return implode(",",array_keys($attributes));
        }

        public function createValues($attributes) {
            return ':'.implode(",:", array_keys($attributes));
        }

        public function bindCreateParameters($attributes) {
            $values = ':'.implode(",:", array_keys($attributes));
            $bindParameters = array_combine(explode(',',$values), array_values($attributes));
            return $bindParameters;
        }
    }
?>