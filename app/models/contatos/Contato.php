<?php

    namespace app\models\contatos;

    use app\models\database\DefaultModel;

    class Contato extends DefaultModel {
        private $id;
        private $tipoTelefone;
        private $email;
    }
