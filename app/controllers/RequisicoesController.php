<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\compras\Requisicao;
    use app\models\compras\ItemRequisicao;

    class RequisicoesController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");

            }
            $requisicoes = (new Requisicao())->getAll();

            $this->view([
                'title' => 'Painel Administrativo :: Compras > Requisições',
                'requisicoes' => $requisicoes
            ], 'operacoes.compras.requisicoes.index');
        }

        public function store() {
            $numeroRequisicao = (new Requisicao())->create(array('data_requisicao' => request()->get()->data_requisicao, 'cadastrado_por' => $_SESSION['usuario_id']));
            if ($numeroRequisicao) {
                //return toJson(["requisicao" => $numeroRequisicao]);
               
                foreach ($_POST['produtos'] as $p) {
                    (new ItemRequisicao())->create(array('numero_requisicao' => $numeroRequisicao, 'codigo_produto' => $p['codigo_produto'], 'quantidade' => $p['quantidade']));
                }
            }
        }

        public function show() {
            // Retornar todos os produtos como arrays bidimensionais
            $requisicao = (new ItemRequisicao())->findByInArray('numero_requisicao', request()->get()->id);
            return toJson($requisicao);
        }
    }

?>