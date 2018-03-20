<?php

    namespace app\models\contatos;

    use app\models\database\DefaultModel;

    class Email extends DefaultModel {
        private $id;
        private $endereco;
        private $descricao;
    }
