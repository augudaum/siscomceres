<?php

    /**
     * Classe responsável por modelar o estado
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Pais;

    class Estado extends DefaultModel {
        private $codigo;
        private $nome;
        private $sigla;
        private $pais;

        public function __construct($codigo) {
            $estado = $this->findBy('codigo', $codigo);
            $this->codigo = $codigo;
            $this->nome = $estado->nome;
            $this->sigla = $estado->sigla;
            $this->pais = new Pais($estado->pais_codigo);
            return $this;
        }

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

        public function getPais(){
            return $this->pais;
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

        public function setPais(Pais $pais){
            $this->pais = $pais;
        }
    }
