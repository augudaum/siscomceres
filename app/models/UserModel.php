<?php

    namespace app\models;

    use app\models\database\DefaultModel;

    class UserModel extends DefaultModel {

        protected $table = 'users';
        const SEQUENCE = 'usuarios_id_seq';
        
        private $nome;
        private $login;
        private $senha;

        public function __construct() {
            
        }
    }