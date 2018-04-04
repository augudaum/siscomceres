<?php

    namespace app\controllers;

    use app\controllers\ContainerController;

    class ProdutosController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $this->view([
                'title' => 'Painel Administrativo :: Produtos',
                'class_produtos_selected' => 'active'
            ], 'produtos.index');
        }

        public function create() {
            $this->view([
                'title' => 'Painel Administrativo :: Produtos',
                'class_produtos_selected' => 'active',
            ], 'produtos.cadastro');
        }
    }
?>