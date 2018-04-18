<?php

    /**
     * Classe responsável por modelar o bairro
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Cidade;

    class Bairro {
        private $codigo;
        private $cidade;
        private $nome;

        // public function __construct($codigo) {
        //     $bairro = $this->findBy('codigo', $codigo)->fetch();
        //     $this->codigo = $codigo;
        //     $this->nome = $bairro->nome;
        //     $this->cidade = new Cidade($bairro->cidade_codigo);
        //     return $this;
        // }
        public function __construct ($codigo = null, $cidade = null, $nome = null) {
            $this->codigo = $codigo;
            $this->cidade = (new Cidade())->getCidade($cidade);
            $this->nome = $nome;
        }

        /**
         * GET and SET methods
         */ 

        public function getCodigo(){
            return $this->codigo;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function setCidade(Cidade $cidade)
        {
            $this->cidade = $cidade;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
        }
    }
