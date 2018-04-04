<?php

    /**
     * Classe responsável por modelar o Fornecedor
     * @author 
     */

    namespace app\models\participante;

    use app\models\participante\Participante;

    class Funcionario extends Participante {
        private $matricula;
        private $cargo;
        private $funcao;
        private $salario;
        private $dataAdmissao;
        private $ctps;

        /**
         * GET and SET methods
         */ 

        public function getMatricula(){
                return $this->matricula;
        }

        public function getCargo(){
                return $this->cargo;
        }

        public function getFuncao(){
                return $this->funcao;
        }

        public function getSalario(){
                return $this->salario;
        }

        public function getDataAdmissao(){
                return $this->dataAdmissao;
        }

        public function getCtps(){
                return $this->ctps;
        }

        public function setMatricula($matricula){
                $this->matricula = $matricula;
        }

        public function setCargo($cargo){
                $this->cargo = $cargo;
        }

        public function setFuncao($funcao){
                $this->funcao = $funcao;
        }

        public function setSalario($salario){
                $this->salario = $salario;
        }

        public function setDataAdmissao($dataAdmissao){
                $this->dataAdmissao = $dataAdmissao;
        }

        public function setCtps($ctps){
                $this->ctps = $ctps;
        }
    }
?>