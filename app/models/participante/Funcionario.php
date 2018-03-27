<?php

    namespace app\models\participante;

    use app\models\participante\Participante;

    class Funcionario extends Participante {
        private $matricula;
        private $cargo;
        private $funcao;
        private $salario;
        private $dataAdmissao;
        private $ctps;
    }
?>