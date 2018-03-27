<?php

    namespace app\models\participante\pessoa;

    use app\models\participante\pessoa\IE;

    class PessoaJuridica {

        private $razaoSocial;
        private $nomeFantasia;
        private $cnpj;
        private $ie;
        private $im;
        private $cnae;
        private $crt;
        private $dataFundacao;


        /****************************************
        ********** GET and SET methods **********
        ****************************************/

        public function setIE(IE $ie) {
            $this->ie = ie;
        }
    }
?>