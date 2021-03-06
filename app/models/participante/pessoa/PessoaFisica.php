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

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setApelido($apelido) {
            $this->apelido = $apelido;
        }

        public function setCPF($cpf) {
            $this->cpf = $cpf;
        }

        public function setRG (RG $rg) {
            $this->rg = $rg;
        }

        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getApelido() {
            return $this->apelido;
        }

        public function getCPF() {
            return $this->cpf;
        }
    }