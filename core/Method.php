<?php

    namespace core;

    use app\classes\Uri;
    use app\exceptions\MethodNotExistException;

    class Method {

        private $uri;

        public function __construct() {
            $this->uri = Uri::uri();
        }

        public function load($controller) {
            $method = $this->getMethod();

            if (!method_exists($controller, $method)) {
                throw new MethodNotExistException("O seguinte método ({$method}) não foi encontrado: {$method}");
            }
            return $method;
        }

        /**
         * Verifica se algum método está sendo chamado. Caso nenhum esteja sendo chamado, retorna o index
         */
        public function getMethod() {
            if (substr_count($this->uri, '/') > 1) {
                list($controller, $method) = array_values(array_filter(explode('/', $this->uri)));
                return $method;
            }
            return 'index';
        }
    }