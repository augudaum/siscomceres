<?php

    namespace app\models\contatos;

    use app\models\database\DefaultModel;
    use app\models\contatos\Telefone;
    use app\models\contatos\Email;

    class Contato extends DefaultModel {
        private $id;
        private $telefone;
        private $email;
    }
