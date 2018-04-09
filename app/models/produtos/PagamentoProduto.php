<?php

    /**
     * Classe responsável por modelar o pagamento produto
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class PagamentoProduto extends DefaultModel {
        private $codigoProduto;
        private $codigoPlano;
        private $preco;

        /**
         * GET and SET methods
         */ 
        
        public function getCodigoProduto(){
            return $this->codigoProduto;
        }
    
        public function getCodigoPlano(){
            return $this->codigoPlano;
        }
   
        public function getPreco(){
            return $this->preco;
        }
     
        public function setCodigoProduto($codigoProduto){
            $this->codigoProduto = $codigoProduto;
        }
    
        public function setCodigoPlano($codigoPlano){
            $this->codigoPlano = $codigoPlano;
        }
    
        public function setPreco($preco){
            $this->preco = $preco;
        }
    }
