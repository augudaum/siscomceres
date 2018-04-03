<?php

    /**
     * Classe responsável por modelar o Fornecedor
     * @author Alanfagner
     */

    namespace app\models\participante;

    use app\models\participante\Participante;

    class Fornecedor extends Participante {
        private $codigoFornecedor;
        private $observacao;
        private $tipoFornecedor;

    }
?>