<?php

    /**
     * Classe responsável por modelar a marca
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class Marca extends DefaultModel {
        private $id;
        private $descricao;

        /**
         * GET and SET methods
         */ 
        
        public function getId(){
            return $this->id;
        }
 
        public function getDescricao(){
            return $this->descricao;
        }
       
        public function setId($id){
            $this->id = $id;
        }
    
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    }
