<?php

    namespace app\models\contatos;

    use app\models\database\DefaultModel;

    class Telefone extends DefaultModel {
        private $id;
        // código do país DDI
        private $ddi;
        // código do estado DDD
        private $ddd;
        private $numero;
        private $descricao;
    }
