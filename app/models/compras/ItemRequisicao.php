<?php

     /**
     * Classe responsável por modelar o produto
     * @author Marcelo Augusto
     */

    namespace app\models\compras;

    use app\models\database\DefaultModel;

    class ItemRequisicao extends DefaultModel {
        private $numeroRequisicao;
        private $produto;
        private $quantidade;
        protected $table = 'tb_item_requisicao_compra';

        public function getAll() {
            $itemRequisicoes = $this->all();
            $arrayItemRequisicoes = [];
            foreach ($itemRequisicoes as $i) {
                $itemRequisicao = new ItemRequisicao();
                $itemRequisicao->setNumeroRequisicao($i->numero_requisicao);
                $itemRequisicao->setProduto($i->codigo_produto);
                $itemRequisicao->setQuantidade($i->quantidade);
                $arrayItemRequisicoes[] = $itemRequisicao;
            }
            return $arrayItemRequisicoes;
        }

        public function getNumeroRequisicao() {
            return $this->numeroRequisicao;
        }

        public function getProduto() {
            return $this->produto;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setNumeroRequisicao($numero) {
            $this->numeroRequisicao = $numero;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }
    }
?>