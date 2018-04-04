<?php

    /**
     * Classe responsável por modelar o Fornecedor
     * @author Alanfagner
     */

    namespace app\models\participante;

    use app\models\participante\Participante;

    class Fornecedor extends Participante {
        private $codigoFornecedor;
        private $observacao;
        private $tipoFornecedor;

        /**
         * GET and SET methods
         */ 

        public function getCodigoFornecedor(){
                return $this->codigoFornecedor;
        }

        public function getObservacao(){
                return $this->observacao;
        }

        public function getTipoFornecedor(){
                return $this->tipoFornecedor;
        }

        public function setCodigoFornecedor($codigoFornecedor){
                $this->codigoFornecedor = $codigoFornecedor;
        }
 
        public function setObservacao($observacao){
                $this->observacao = $observacao;
        }

        public function setTipoFornecedor($tipoFornecedor){
                $this->tipoFornecedor = $tipoFornecedor;
        }
    }
?>