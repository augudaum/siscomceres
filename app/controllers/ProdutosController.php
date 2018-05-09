<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\produtos\Produto;

    class ProdutosController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $produtos = (new Produto())->getAll();

            $this->view([
                'title' => 'Painel Administrativo :: Produtos',
                'class_produtos_selected' => 'active',
                'produtos' => $produtos
            ], 'produtos.index');
        }
        
        public function store() {
            // Remove os campos que foram enviados em branco
            $_POST = array_filter($_POST);
            $_POST['cadastrado_por'] = $_SESSION['usuario_id'];
            $produtoCodigo = (new Produto())->create((array) request()->get());
            // Retorna o id do participante inserido
            return toJson($produtoCodigo);
        }

        public function update() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['action'])) {
                return back();
            }
            $_POST['modificado_por'] = $_SESSION['usuario_id'];
            return toJson((new Produto())->update(request()->get()->codigo, (array) request()->get(), 'codigo'));
        }

        public function show() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['codigo'])) {
                return redirect("/");
            }
            return toJson(array(
                "produto" => (new Produto())->findBy('codigo', request()->get()->codigo) 
            ));
        }    

        public function destroy() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['action'])) {
                return back();
            }
            return toJson((new Produto())->delete('codigo', request()->get()->codigo));
        }

        public function produtos() {
            if (!isset($_SESSION['usuario_logado']) && !isset($_POST['action'])) {
                return back();
            }
            return toJson((new Produto())->all());
        }
    }
?>