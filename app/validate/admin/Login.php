<?php

    /**
     * Classe responsável por fazer as validações dos campos conforme requisitadas.
     */
    namespace app\validate\admin;

    use app\validate\Validate;
    use app\models\usuarios\Usuario;

    class Login extends Validate {
        
        public function validate() {
            $this->required(['login', 'senha']); // Checa se os campos estão preenchidos
        }
    }