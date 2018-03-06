<?php

    namespace app\controllers\login;

    use app\controllers\ContainerController;
    use app\classes\Password;
    use app\classes\Login as LoginUtil;
    use app\validate\admin\Login;
    use app\models\admin\Admin;

    class LoginController extends ContainerController {

        public function index() {
            $login = validate(new Login());

            if ($login->hasErrors()) {
                flash($login->getErrors());
                return redirect('/');
            }
            
            $logado = authenticate(new Admin());

            if ($logado) {
                redirect('/painel');
            }
        }

        public function destroy() {
            $login = new LoginUtil();
            return $login->logout();
        }
    }