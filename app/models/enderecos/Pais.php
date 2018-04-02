<?php

    /**
     * Classe responsável por modelar o país
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;

    class Pais extends DefaultModel {
        private $codigo;
        private $nome;
        private $sigla;

        /**
         * GET and SET methods
         */ 
        public function getCodigo(){
            return $this->codigo;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getSigla(){
            return $this->sigla;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setSigla($sigla){
            $this->sigla = $sigla;
        }
    }
