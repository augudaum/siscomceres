<?php

    /**
     * Classe responsável por realizar o login do usuário e inicializar sua sessão
     */

    namespace app\classes;

    use app\models\database\DefaultModel;
    use app\classes\Password;

    class Login {

        private $model;
        private $user;

        public function login(DefaultModel $model) {
            $this->model = $model;

            $this->user = $this->model->findByActives('login', request()->get()->login);
            
            if (!$this->user) {
                return $this->isNotLoggedIn();
            }
            
            if (Password::verify(request()->get()->senha, $this->user->senha)) {
                return $this->loggedIn();
            }

            return $this->isNotLoggedIn();
        }

        private function loggedIn() {
            $_SESSION[$this->model->session_string] = true;
            $_SESSION[$this->model->session_id_string] = $this->user->id;
            session_regenerate_id();
            return true;
        }

        private function isNotLoggedIn() {
            flash(["auth" => "Usuário e/ou senha incorretos!"]);
            return back();
        }

        public function logout() {
            session_destroy();
            redirect('/');
        }

    }