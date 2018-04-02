<?php

    /**
     * Classe responsável por modelar o endereço
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Logradouro;

    class Endereco extends DefaultModel {
        private $id;
        private $numero;
        private $logradouro;
        private $complemento;
        private $referencia;
     
        /**
         * GET and SET methods
         */ 

        public function getId(){
            return $this->id;
        }
        
        public function getNumero(){
            return $this->numero;
        }

        public function getLogradouro(){
            return $this->logradouro;
        }

        public function getComplemento(){
            return $this->complemento;
        }

        public function getReferencia(){
            return $this->referencia;
        }
        
        public function setId($id){
            $this->id = $id;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function setLogradouro(Logradouro $logradouro){
            $this->logradouro = $logradouro;
        }

        public function setComplemento($complemento){
            $this->complemento = $complemento;
        }

        public function setReferencia($referencia){
            $this->referencia = $referencia;
        }
    }