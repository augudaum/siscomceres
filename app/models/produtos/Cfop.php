<?php

    /**
     * Classe responsável por modelar o cfop
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class Cfop extends DefaultModel {
        private $codigo;
        private $descricao;
        private $indNFe;
        private $indComunica;
        private $indTransp;
        private $indDevol;

        /**
         * GET and SET methods
         */ 

        public function getCodigo(){
            return $this->codigo;
        }
    
        public function getDescricao(){
            return $this->descricao;
        }
    
        public function getIndNFe(){
            return $this->indNFe;
        }
    
        public function getIndComunica(){
            return $this->indComunica;
        }
    
        public function getIndTransp(){
            return $this->indTransp;
        }
    
        public function getIndDevol(){
            return $this->indDevol;
        }
    
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
    
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    
        public function setIndNFe($indNFe){
            $this->indNFe = $indNFe;
        }
    
        public function setIndComunica($indComunica){
            $this->indComunica = $indComunica;
        }
    
        public function setIndTransp($indTransp){
            $this->indTransp = $indTransp;
        }
    
        public function setIndDevol($indDevol){
            $this->indDevol = $indDevol;
        }
    }
