<?php

    /**
     * Classe responsável por modelar o bairro
     * @author Alanfagner
     */

    namespace app\models\contatos;

    use app\models\database\DefaultModel;
    use app\models\contatos\Telefone;
    use app\models\contatos\Email;

    class Contato extends DefaultModel {
        private $id;
        private $telefone;
        private $email;
        private $tipo_contato;

        /**
         * GET and SET methods
         */ 

        public function getId(){
            return $this->id;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getTipo_contato(){
            return $this->tipo_contato;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setTelefone(Telefone $telefone){
            $this->telefone = $telefone;
        }

        public function setEmail(Email $email){
            $this->email = $email;
        }

        public function setTipo_contato($tipo_contato){
            $this->tipo_contato = $tipo_contato;
        }
    }
