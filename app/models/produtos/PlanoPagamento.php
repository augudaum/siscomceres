<?php

    /**
     * Classe responsável por modelar o plano pagamento
     * @author Alanfagner
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class PlanoPagamento extends DefaultModel {
        private $id;
        private $formaPagamento;

        /**
         * GET and SET methods
         */ 
        
        public function getId(){
            return $this->id;
        }
    
        public function getFormaPagamento(){
            return $this->formaPagamento;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function setFormaPagamento($formaPagamento){
            $this->formaPagamento = $formaPagamento;
        }
    }
