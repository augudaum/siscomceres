<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\compras\ItemRequisicao;

    class ItemRequisicaoController extends ContainerController {

        public function store() {
            if (!isset($_SESSION['usuario_logado'])) {
                return redirect("/");
            }
            $_POST = array_filter($_POST);
            $_POST['cadastrado_por'] = $_SESSION['usuario_id'];
        }

    }

?>