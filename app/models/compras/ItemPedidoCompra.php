<?php

    /**
     * Classe responsável por modelar um item de pedido de compra
     * @author Marcelo Augusto
     */

    namespace app\models\compras;

    use app\models\database\DefaultModel;

    class ItemPedidoCompra extends DefaultModel {
        private $numeroPedido;
        private $produto;
        private $quantidade;
        private $precoProduto;
        protected $table = 'tb_item_pedido_compra';

        public function getAll() {
            $itemPedidos = $this->all();
            $arrayItemPedidos = [];
            foreach ($itemPedidos as $i) {
                $itemPedido = new ItemPedidoCompra();
                $itemPedido->setNumeroPedido($p->numero_pedido);
                $itemPedido->setProduto($p->codigo_produto);
                $itemPedido->setQuantidade($p->quantidade);
                $itemPedido->setPrecoProduto($p->preco_produto);
                $arrayItemPedidos[] = $itemPedido;
            }
            return $arrayItemPedidos;
        }

        public function getNumeroPedido() {
            return $this->numeroPedido;
        }

        public function getProduto() {
            return $this->produto;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function getPrecoProduto() {
            return $this->precoProduto;
        }

        public function setNumeroPedido($numeroPedido) {
            $this->numeroPedido = $numeroPedido;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function setPrecoProduto($precoProduto) {
            $this->precoProduto = $precoProduto;
        }
    }
?>