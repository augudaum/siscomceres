<?php

    /**
     * Classe responsável por modelar o unidade comercial
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class UnidadeComercial extends DefaultModel {
        private $id;
        private $descricao;
        private $sigla;
        protected $table = 'tb_unidades';
        const SEQUENCE = 'tb_unidades_seq';

        public function getAll() {
            $unidades = $this->all();
            $arrayUnidades = [];
            foreach ($unidades as $u) {
                $unidade = new UnidadeComercial();
                $unidade->setId($u->id);
                $unidade->setDescricao($u->descricao);
                $unidade->setSigla($u->sigla);
                $arrayUnidades[] = $unidade;
            }
            return $arrayUnidades;
        }

        /**
         * GET and SET methods
         */ 
        
        public function getId(){
            return $this->id;
        }

        public function getDescricao(){
            return $this->descricao;
        }
        
        public function getSigla(){
            return $this->sigla;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    
        public function setSigla($sigla){
            $this->sigla = $sigla;
        }
    }
