<?php

    namespace app\models\usuarios;

    use app\models\database\DefaultModel;

    class Usuario extends DefaultModel {
        protected $table = 'tb_usuarios';
        // Identifica a sessão de um usuário Administrador
        public $session_string = 'usuario_logado';
        // Identifica os dados de um usuário Administrador
        public $session_id_string = 'usuario_id';
        const SEQUENCE = "usuarios_id_seq";
    }