<?php

    /**
     * Classe responsável por modelar o produto
     * @author Marcelo Augusto
     */

    namespace app\models\compras;

    use app\models\database\DefaultModel;

    class Requisicao extends DefaultModel {
        private $numero;
        private $dataRequisicao;
        protected $table = 'tb_requisicoes_compra';
        const SEQUENCE = 'tb_requisicoes_compra_seq';

        public function getAll() {
            $requisicoes = $this->all();
            $arrayRequisicoes = [];
            foreach ($requisicoes as $r) {
                $requisicao = new Requisicao();
                $requisicao->setNumero($r->numero);
                $requisicao->setDataRequisicao($r->data_requisicao);
                $arrayRequisicoes[] = $requisicao;
            }
            return $arrayRequisicoes;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getDataRequisicao() {
            return $this->dataRequisicao;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function setDataRequisicao($dataRequisicao) {
            $this->$dataRequisicao = $dataRequisicao;
        }

    }

?>