<?php

    namespace app\models\participante;
    
    use app\models\enderecos\Endereco;
    use app\models\contatos\Contato;
    use app\models\participante\Pessoa;

    class Participante {
        private $id;
        private $endereco;
        private $contato;
        private $pessoa;
        private $politicaPagamento;

        public function __constructor() {

        }

        /****************************************
        ********** GET and SET methods **********
        ****************************************/

        public function getEndereco() {
            return $this->endereco;
        }

        public function getContato() {
            return $this->contato;
        }

        public function getPessoa() {
            return $this->pessoa;
        }

        public function getPoliticaPagamento() {
            return $this->politicaPagamento;
        }

        public function setEndereco (Endereco $endereco) {
            $this->endereco = $endereco;
        }

        public function setContato (Contato $contato) {
            $this->contato = $contato;
        }

        public function setPessoa (Pessoa $pessoa) {
            $this->pessoa = $pessoa;
        }

        public function setPoliticaPagamento (PoliticaPagamento $planoPagamento) {
            $this->politicaPagamento = $planoPagamento;
        }
    }
?>