<?php

    namespace app\models\produtos;

    use app\models\database\DefaultModel;

    class TipoItem extends DefaultModel {
        private $codigo;
        private $descricao;
        protected $table = "tb_tipo_item";

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