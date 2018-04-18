<?php

    /**
     * Classe responsável por modelar a Inscrição Estadual (IE) da Empresa
     * @author Marcelo Augusto
     */

    namespace app\models\participante\pessoa;

    class IE {
        private $numero;
        private $uf;

        public function __construct($numero = null, $uf = null) {
            $this->numero = $numero;
            $this->uf = $uf;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function setUF($uf) {
            $this->uf = $uf;
        }
    }
?>