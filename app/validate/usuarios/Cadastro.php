<?php

    namespace app\validate\usuarios;

    use app\validate\Validate;
    use app\models\admin\Admin;

    class Cadastro extends Validate {

        public function validate() {
            $this->required([]);
            $this->unique(['login' => (new Admin)]);
        }
    }