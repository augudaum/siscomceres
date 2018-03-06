<?php

    namespace app\traits;

    use core\Twig;

    trait View {

        /**
         * Carrega o método do minha classe Twig
         */
        private function twig() {
            $twig = new Twig();
            $loadTwig = $twig->loadTwig();
            $twig->loadExtensions();
            $twig->loadFunctions();
            return $loadTwig;
        }

        /**
         * @param $data = Dados a serem passados para o Parameter
         * @param $view = Caminho da view (template html)
         */
        public function view ($data, $view) {
            $template = $this->twig()->load(str_replace('.', '/', $view).'.html');
            return $template->display($data);
        }
    }