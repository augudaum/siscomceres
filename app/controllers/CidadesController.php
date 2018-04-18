<?php

    namespace app\controllers;

    use app\controllers\ContainerController;
    use app\models\enderecos\Cidade;

    class CidadesController extends ContainerController {

        public function cidades() {
            return toJson((new Cidade())->getCidades(request()->get()->codigo_estado));
        }
    }