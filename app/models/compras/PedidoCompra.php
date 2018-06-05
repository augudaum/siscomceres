<?php

    /**
     * Classe responsável por modelar um pedido de compra
     * @author Marcelo Augusto
     */

    namespace app\models\compras;

    use app\models\database\DefaultModel;
    use app\models\participante\Participante;

    class PedidoCompra extends DefaultModel {
        private $numero;
        private $dataPedido;
        private $fornecedor;
        private $requisicao;
        private $totalPedidoCompra;
        protected $table = 'tb_pedido_compra';
        const SEQUENCE = 'tb_pedido_compra_seq';

        public function getAll() {
            $pedidos = $this->all();
            $arrayPedidos = [];
            foreach ($pedidos as $p) {
                $pedido = new PedidoCompra();
                $pedido->setNumero($p->numero);
                $pedido->setDataPedido($p->data_pedido);
                $pedido->setFornecedor((new Participante())->get($p->codigo_fornecedor));
                $pedido->setRequisicao($p->numero_requisicao);
                $pedido->setTotalPedidoCompra($p->total_pedido_compra);
                $arrayPedidos[] = $pedido;
            }
            return $arrayPedidos;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getDataPedido() {
            return $this->dataPedido;
        }

        public function getFornecedor() {
            return $this->fornecedor;
        }

        public function getRequisicao() {
            return $this->requisicao;
        }

        public function getTotalPedidoCompra() {
            return $this->totalPedidoCompra;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function setDataPedido($dataPedido) {
            $this->dataPedido = $dataPedido;
        }

        public function setFornecedor($fornecedor) {
            $this->fornecedor = $fornecedor;
        }

        public function setRequisicao($requisicao) {
            $this->requisicao = $requisicao;
        }

        public function setTotalPedidoCompra($totalPedidoCompra) {
            $this->totalPedidoCompra = $totalPedidoCompra;
        }
    }