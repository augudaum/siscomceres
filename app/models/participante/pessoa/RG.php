<?php

    /**
     * Classe responsável por modelar o RG de um usuário
     * @author Marcelo Augusto
     */

    namespace app\models\participante\pessoa;

    class RG {
        private $numero;
        private $orgao;
        private $uf;
        private $dataExpedicao;

        public function __construct($numero = null, $orgao = null, $uf = null, $dataExpedicao = null) {
            $this->numero = $numero;
            $this->orgao = $orgao;
            $this->uf = $uf;
            $this->dataExpedicao = $dataExpedicao;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }
        
        public function setOrgao($orgao) {
            $this->orgao = $orgao;
        }

        public function setUF($uf) {
            $this->uf = $uf;
        }

        public function setDataExpedicao($dataExpedicao) {
            $this->dataExpedicao = $dataExpedicao;
        }
    }

?>