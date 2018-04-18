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
        protected $table = 'tb_paises';
        const SEQUENCE = 'tb_paises_seq';

        /**
         * GET and SET methods
         */ 
        public function paises() {
            return $this->all();
        }

        public function getPais($codigo) {
            $pais = $this->findBy('codigo', $codigo);
            $p = new Pais();
            $p->codigo = $codigo;
            $p->nome = $pais->nome;
            $p->sigla = $pais->sigla;
            return $p;
        }
        
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

        public function get($field, $value) {
            $pais = $this->findBy($field, $value);
            $this->codigo = $pais->codigo;
            $this->nome = $pais->nome;
            $this->sigla = $pais->sigla;
            return $pais;
        }
    }
