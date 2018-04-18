<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\enderecos\Estado;

    class EstadosController extends ContainerController {

        public function estados() {
            return toJson((new Estado())->getEstados());
        }
    }