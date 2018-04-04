<?php

    /**
     * Classe responsável por modelar o Cliente
     * @author Alanfagner
     */

    namespace app\models\participante;

    use app\models\participante\Participante;

    class Cliente extends Participante {
        private $codigoCliente;
        private $observacao;
        private $tipoCliente;
        private $limiteCredito;

        /**
         * GET and SET methods
         */ 

        public function getCodigoCliente(){
                return $this->codigoCliente;
        }

        public function getObservacao(){
                return $this->observacao;
        }

        public function getTipoCliente(){
                return $this->tipoCliente;
        }

        public function getLimiteCredito(){
                return $this->limiteCredito;
        }

        public function setCodigoCliente($codigoCliente){
                $this->codigoCliente = $codigoCliente;
        }

        public function setObservacao($observacao){
                $this->observacao = $observacao;
        }

        public function setTipoCliente($tipoCliente){
                $this->tipoCliente = $tipoCliente;
        }

        public function setLimiteCredito($limiteCredito){
                $this->limiteCredito = $limiteCredito;
        }
    }
?>