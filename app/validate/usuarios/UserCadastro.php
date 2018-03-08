<?php

    namespace app\validate\usuarios;

    use app\validate\Validate;
    use app\models\usuarios\Usuario;

    class UserCadastro extends Validate {

        public function validate() {
            $this->required(['nome', 'login', 'senha']);
            $this->unique(['login' => (new Usuario)]);
        }
    }