<?php

    /**
     * Classe responsável por modelar o bairro
     * @author Alanfagner
     */

    namespace app\models\contatos;

    use app\models\database\DefaultModel;

    class Telefone extends DefaultModel {
        private $id;
        // código do país DDI
        private $ddi;
        // código do estado DDD
        private $ddd;
        private $numero;
        private $descricao;

        /**
         * GET and SET methods
         */ 
        
        public function getId(){
            return $this->id;
        }

        public function getDdi(){
            return $this->ddi;
        }

        public function getDdd(){
            return $this->ddd;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDdi($ddi){
            $this->ddi = $ddi;
        }

        public function setDdd($ddd){
            $this->ddd = $ddd;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    }
