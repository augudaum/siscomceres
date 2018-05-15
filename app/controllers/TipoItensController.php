<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\produtos\TipoItem;

    class TipoItensController extends ContainerController {

        public function show() {
            if (!isset($_SESSION['usuario_logado'])) {
                return back();
            }
            return toJson((new TipoItem())->all());
        }
        
    }