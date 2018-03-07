<?php

    namespace app\controllers\usuarios;

    use app\controllers\ContainerController;
    use app\validate\usuarios\UserCadastro;
    use app\models\admin\Admin;
    use app\classes\Password;

    class UsuariosController extends ContainerController {

        public function index() {
            if (!isset($_SESSION['admin_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }

            $admin = new Admin();
            $adminEncontrados = $admin->all();

            $this->view([
                'title' => 'Painel Administrativo :: Usuários',
                //'title_menu_selected' => 'Lista de usuários cadastrados',
                //'subtitle_menu_selected' => 'Lista de Usuários cadastrados',
                'class_usuarios_selected' => 'active',
                'usuarios' => $adminEncontrados
            ], 'usuarios.index');

        }

        public function show() {

        }

        public function create() {

        }

        public function store() {
            $_POST['master'] = $_POST['master'] ?? "0";
            $user = validate((new UserCadastro));
            
            if ($user->hasErrors()) {
                //flash($user->getErrors());
                return toJson($user->getErrors());

                //return back();
            }
            
            $newUser = new Admin();

            return toJson($newUser->create((array) request()->hash()));

            // redirect("/painel");

        }

        public function edit() {

        }

        public function update() {

        }

        public function destroy() {

        }
    }
