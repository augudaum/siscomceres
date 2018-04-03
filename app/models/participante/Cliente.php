<?php

    /**
     * Classe responsável por modelar o Cliente
     * @author Alanfagner
     */

    namespace app\models\participante;

    use app\models\participante\Participante;

    class Cliente extends Participante {
        private $codigoCliente;
        private $observacao;
        private $tipoCliente;
        private $limiteCredito;

    }
?>