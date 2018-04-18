<?php

    /**
     * Classe responsável por modelar a cidade
     * @author Alanfagner
     */

    namespace app\models\enderecos;

    use app\models\database\DefaultModel;
    use app\models\enderecos\Estado;

    class Cidade extends DefaultModel {
        private $codigo;
        private $estado;
        private $nome;
        protected $table = 'tb_cidades';

        public function getCidades($codigoEstado = null) {
            if (isset($codigoEstado)) {
                return $this->findBy('estado_codigo', $codigoEstado); 
            }
            return $this->all();
        }

        public function getCidade($codigo) {
            $cidade = $this->findBy('codigo', $codigo);
            $c = new Cidade();
            $c->codigo = $codigo;
            $c->estado = (new Estado())->getEstado($cidade->estado_codigo);
            $c->nome = $cidade->nome;
            return $c;
        }

        /**
         * GET and SET methods
         */ 
        public function getCodigo(){
            return $this->codigo;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getNomeUF() {
            return "{$this->nome}/{$this->getEstado()->getSigla()}";
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
    }
