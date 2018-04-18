<?php

    /**
     * Classe responsável por modelar uma pessoa física ou jurídica
     * @author Marcelo Augusto
     */

    namespace app\models\participante\pessoa;

    use app\models\participante\pessoa\PessoaFisica;
    use app\models\participante\pessoa\PessoaJuridica;

    class Pessoa {
        // Variável responsável por determinar Pessoa Física ou Jurídica
        private $tipo;

        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        /**
         * @return Pessoa retorna o tipo de pessoa a ser criada
         */
        public function instantiateTipoPessoa($tipo) {
            $this->setTipo($tipo);
            switch (strtoupper($tipo)) {
                case 'F':
                    return new PessoaFisica();
                    break;
                default:
                    return new PessoaJuridica();
            }
        }
    }
?>