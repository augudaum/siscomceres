<?php

    /**
     * Classe responsável por modelar o forma pagamento
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class FormaPagamento extends DefaultModel {
        private $id;
        private $descricao;
        private $parcelas;
        private $prazo;
        private $desconto;

        /**
         * GET and SET methods
         */ 
        
        public function getId(){
            return $this->id;
        }
    
        public function getDescricao(){
            return $this->descricao;
        }
    
        public function getParcelas(){
            return $this->parcelas;
        }
    
        public function getPrazo(){
            return $this->prazo;
        }
    
        public function getDesconto(){
            return $this->desconto;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    
        public function setParcelas($parcelas){
            $this->parcelas = $parcelas;
        }
    
        public function setPrazo($prazo){
            $this->prazo = $prazo;
        }
    
        public function setDesconto($desconto){
            $this->desconto = $desconto;
        }
    }
