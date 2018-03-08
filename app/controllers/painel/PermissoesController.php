<?php

	namespace app\controllers\painel;

	use app\controllers\ContainerController;
	use app\models\usuarios\Usuario;
	use app\models\usuarios\Permission;
	use app\classes\ControllersPermissions;

	class PermissoesController extends ContainerController {

		public function index() {
			if (!isset($_SESSION['usuario_logado'])) {
                flash(['acesso_negado' => 'É necessário estar logado para acessar o Painel Administrativo']);
                return redirect("/");
            }
		}

		public function create() {

		}

		public function store() {
		
		}

		public function show($request) {
			$user = new Usuario();
			$userEncontrado = $user->findBy('id', $request->parameter);

			$permissionController = new ControllersPermissions();
			$controllers = $permissionController->getPermissions($request->parameter);
			//return toJson($permissionController->getPermissions($request->parameter));

			$this->view([
				'title' => 'Painel Administrativo :: Permissões do Usuário',
				'class_usuarios_selected' => 'active',
				'usuario' => $userEncontrado,
				'controllers' => $controllers
			], 'usuarios.permissoes');
		}

		public function edit() {

		}

		public function update($id) {
			list($method, $controller, $idUser) = explode(',', $_POST['data']);

			$permission = new Permission();
			$permissionsEncontrada = $permission->findPermissions($method, $controller, $idUser);

			// Caso não encontre, o usuário não tinha permissão, mas agora terá
			if (!$permissionsEncontrada) {
				$updated = $permission->create([
					'user_id' => $idUser,
					'controller' => $controller,
					'method' => $method
				]);

			} else {
				$updated = $permission->removePermission($method, $controller, $idUser);
			}

			if ($updated) {
				echo 'atualizado';
			}
		}

		public function destroy() {

		}
	}