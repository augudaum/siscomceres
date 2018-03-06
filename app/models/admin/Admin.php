<?php

    namespace app\models\admin;

    use app\models\database\DefaultModel;

    class Admin extends DefaultModel {
        protected $table = 'tb_usuarios';
        // Identifica a sessão de um usuário Administrador
        public $session_string = 'admin_logado';
        // Identifica os dados de um usuário Administrador
        public $session_id_string = 'admin_id';
        const SEQUENCE = "usuarios_id_seq";
    }