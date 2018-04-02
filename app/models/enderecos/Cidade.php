<?php

    /**
     * Classe responsável por modelar a cidade
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Estado;

    class Cidade extends DefaultModel {
        private $codigo;
        private $estado;
        private $nome;

        /**
         * GET and SET methods
         */ 
        public function getCodigo(){
            return $this->codigo;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
    }
