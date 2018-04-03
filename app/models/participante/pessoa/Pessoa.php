<?php

    /**
     * Classe responsável por modelar uma pessoa física ou jurídica
     * @author Marcelo Augusto
     */

    namespace app\models\participante\pessoa;

    use \app\models\participante\pessoa\PessoaFisica;
    use \app\models\participante\pessoa\PessoaJuridica;

    class Pessoa {
        // Variável responsável por determinar Pessoa Física ou Jurídica
        private $tipo;

        public function __constructor(string $tipo) {
            $this->tipo = $tipo;
            return $this->instantiateTipoPessoa();
        }

        public function getTipo() {
            return $this->tipo;
        }

        /**
         * @return Pessoa retorna o tipo de pessoa a ser criada
         */
        private function instantiateTipoPessoa() {
            switch (strtoupper($this->getTipo())) {
                case 'F':
                    return new PessoaFisica();
                    break;
                default:
                    return new PessoaJuridica();
            }
        }
    }
?>