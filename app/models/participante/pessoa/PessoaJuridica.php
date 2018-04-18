<?php

    /**
     * Classe responsável por modelar uma Pessoa Jurídica
     * @author Marcelo Augusto
     */

    namespace app\models\participante\pessoa;

    use app\models\participante\pessoa\IE;

    class PessoaJuridica extends Pessoa {

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

        public function setRazaoSocial($razaoSocial) {
            $this->razaoSocial = $razaoSocial;
        }

        public function setNomeFantasia($nomeFantasia) {
            $this->nomeFantasia = $nomeFantasia;
        }

        public function setCNPJ($cnpj) {
            $this->cnpj = $cnpj;
        }

        public function setIE(IE $ie) {
            $this->ie = $ie;
        }

        public function setIM($im) {
            $this->im = $im;
        }

        public function setCNAE($cnae) {
            $this->cnae = $cnae;
        }

        public function setCRT($crt) {
            $this->crt = $crt;
        }

        public function setDataFundacao($dataFundacao) {
            $this->dataFundacao = $dataFundacao;
        }

        public function getRazaoSocial() {
            return $this->razaoSocial;
        }

        public function getNomeFantasia() {
            return $this->nomeFantasia;
        }

        public function getCNPJ() {
            return $this->cnpj;
        }
    }
?>