<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\compras\PedidoCompra;
    use app\models\compras\ItemPedidoCompra;
    
    class PedidosCompraController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $pedidos = (new PedidoCompra())->getAll();

            $this->view([
                'title' => 'Painel Administrativo :: Compras > Pedidos',
                'pedidos' => $pedidos
            ], 'operacoes.compras.pedidos.index');
        }

        public function store() {
            if (!isset($_SESSION['usuario_logado'])) {
                return back();
            }
            $pedidoNumero = (new PedidoCompra())->create(array(
                'codigo_fornecedor' => request()->get()->codigo_fornecedor,
                'numero_requisicao' => request()->get()->numero_requisicao,
                'data_pedido' => request()->get()->data_pedido,
                'total_pedido_compra' => request()->get()->total_pedido_compra,
                'cadastrado_por' => $_SESSION['usuario_id']
            ));

            foreach ($_POST['produtos'] as $p) {
                (new ItemPedidoCompra())->create(array(
                    'numero_pedido' => $pedidoNumero,
                    'codigo_produto' => $p['codigo_produto'],
                    'quantidade' => $p['quantidade'],
                    'preco_produto' => $p['preco_produto']
                ));
            }
            return toJson($pedidoNumero);
        }
    }
?>