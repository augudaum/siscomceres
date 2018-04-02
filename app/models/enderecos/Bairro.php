<?php

    /**
     * Classe responsável por modelar o bairro
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Cidade;

    class Bairro extends DefaultModel {
        private $codigo;
        private $cidade;
        private $nome;

        /**
         * GET and SET methods
         */ 

        public function getCodigo(){
            return $this->codigo;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function setCidade(Cidade $cidade)
        {
            $this->cidade = $cidade;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
        }
    }
