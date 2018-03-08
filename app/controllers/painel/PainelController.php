<?php

    namespace app\controllers\painel;

    use app\controllers\ContainerController;
    use app\models\usuarios\Usuario;

    class PainelController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $this->view([
                'title' => 'Painel Administrativo :: Página Inicial',
                'class_home_selected' => 'active'
            ], 'painel.index');
        }
    }