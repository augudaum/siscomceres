<?php

    namespace app\controllers\login;

    use app\controllers\ContainerController;

    class HomeController extends ContainerController {

        public function index() {
            $this->view([
                'title' => 'SCERP - Sistema Comercial'
            ], 'login.login');
        }
    }