<?php

    /**
     * Classe responsável por modelar o produto
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class Produto extends DefaultModel {
        private $codigo;
        private $marca;
        private $fabricante;
        private $cEAN;
        private $descricao;
        private $ncm;
        private $extipi;
        private $unidade;
        private $pcCompra;
        private $pcCusto;
        private $pcVenda;

        /**
         * GET and SET methods
         */ 
        
        public function getCodigo(){
            return $this->codigo;
        }

        public function getMarca(){
            return $this->marca;
        }
        
        public function getFabricante(){
            return $this->fabricante;
        }
    
        public function getCEAN(){
            return $this->cEAN;
        }
    
        public function getDescricao(){
            return $this->descricao;
        }
    
        public function getNcm(){
            return $this->ncm;
        }
    
        public function getExtipi(){
            return $this->extipi;
        }
    
        public function getUnidade(){
            return $this->unidade;
        }
    
        public function getPcCompra(){
            return $this->pcCompra;
        }
    
        public function getPcCusto(){
            return $this->pcCusto;
        }
    
        public function getPcVenda(){
            return $this->pcVenda;
        }
    
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
    
        public function setMarca($marca){
            $this->marca = $marca;
        }
    
        public function setFabricante($fabricante){
            $this->fabricante = $fabricante;
        }
    
        public function setCEAN($cEAN){
            $this->cEAN = $cEAN;
        }
    
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    
        public function setNcm($ncm){
            $this->ncm = $ncm;
        }
    
        public function setExtipi($extipi){
            $this->extipi = $extipi;
        }
    
        public function setUnidade($unidade){
            $this->unidade = $unidade;
        }
    
        public function setPcCompra($pcCompra){
            $this->pcCompra = $pcCompra;
        }
    
        public function setPcCusto($pcCusto){
            $this->pcCusto = $pcCusto;
        }
    
        public function setPcVenda($pcVenda){
            $this->pcVenda = $pcVenda;
        }
    }