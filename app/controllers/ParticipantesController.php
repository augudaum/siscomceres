<?php

    namespace app\controllers;

    use app\controllers\ContainerController;

    class ParticipantesController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $this->view([
                'title' => 'Painel Administrativo :: Participantes',
                'class_participantes_selected' => 'active'
            ], 'participantes.index');
        }

        public function store() {
            
        }
    }
?>