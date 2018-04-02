<?php

    /**
     * Classe responsável por modelar o bairro
     * @author Alanfagner
     */

    namespace app\models\contatos;

    use app\models\database\DefaultModel;

    class Email extends DefaultModel {
        private $id;
        private $endereco;
        private $descricao;

        /**
         * GET and SET methods
         */ 
        
        public function getId(){
            return $this->id;
        }

        public function getEndereco(){
            return $this->endereco;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    }
