<?php

    namespace app\classes;

    use app\models\database\DefaultModel;

    class User {

        /**
         * Retorna os dados do usuário a partir do seu id, salvo na sessão
         */
        public function getData(DefaultModel $model) {
            if (isset($_SESSION[$model->session_string])) {
                return $model->findBy('id', $_SESSION[$model->session_id_string]);
            }
        }
    }