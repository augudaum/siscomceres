<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\produtos\GeneroProduto;

    class GenerosController extends ContainerController {
        
        public function show() {
            if (!isset($_SESSION['usuario_logado'])) {
                return redirect("/");
            }
            return toJson((new GeneroProduto())->all());
        }
    }

?>