<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\produtos\UnidadeComercial;

    class UnidadesController extends ContainerController {

        public function unidades() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }
            $unidades = (new UnidadeComercial())->all();
            return toJson($unidades);
        }
    }
?>