<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\compras\Requisicao;

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
    }

?>