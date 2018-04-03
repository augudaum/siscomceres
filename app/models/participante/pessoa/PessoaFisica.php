<?php

    /**
     * Classe responsável por modelar uma Pessoa Física
     * @author Marcelo Augusto
     */

    namespace app\models\participante\pessoa;

    use app\models\participante\pessoa\Pessoa;
    use app\models\participante\pessoa\RG;
    
    class PessoaFisica extends Pessoa {
        private $nome;
        private $apelido;
        private $cpf;
        private $rg;
        private $dataNascimento;


        /****************************************
        ********** GET and SET methods **********
        ****************************************/

        public function setRG (RG $rg) {
            $this->rg = $rg;
        }
    }