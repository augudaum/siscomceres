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
        private $table = 'tb_paises';
        const SEQUENCE = 'tb_paises_seq';

        // public function __construct($codigo) {
        //     $pais = $this->findBy('codigo', $codigo);
        //     $this->codigo = $codigo;
        //     $this->nome = $pais->nome;
        //     return $this;
        // }

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
