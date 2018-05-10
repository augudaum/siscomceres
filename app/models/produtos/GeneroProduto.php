<?php
    /**
     * Classe responsável por modelar o gênero do produto
     * @author Marcelo Augusto
     */

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class GeneroProduto extends DefaultModel {
        private $codigo;
        private $descricao;
        protected $table = "tb_genero_produto";

        /**
         * GET and SET methods
         */

        public function getCodigo() {
            return $this->codigo;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setCodigo($codigo) {
            $this->codigo = $codigo;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
    }