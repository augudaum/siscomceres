<?php

    /**
     * Classe responsável por modelar o logradouro
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Bairro;

    class Logradouro extends DefaultModel {
        private $id;
        private $nome;
        private $bairro;
        private $cep;

        /**
         * GET and SET methods
         */ 

        public function getId(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getBairro(){
            return $this->bairro;
        }

        public function getCep(){
            return $this->cep;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setBairro(Bairro $bairro){
            $this->bairro = $bairro;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }
    }
