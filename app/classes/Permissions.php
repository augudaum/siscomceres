<?php
	
	namespace app\classes;

	use app\models\usuarios\Permission;
	use app\models\usuarios\Usuario;

	class Permissions {

		private $controller;
		private $method;
		private $user;
		private $methodsToDie = [
			'store', 'update', 'destroy'
		];
		private $exclude = [
			'ContainerController', 'HomeController', 'LoginController'
		];

		public function __construct($controller, $method) {
			$this->controller = $controller;
			$this->method = $method;
			$this->user = getUser(new Usuario());
		}

		public function checkPermissions() {
			if (isset($this->user) && $this->user->master == 1) {
				return;
			}

			if (!isset($this->getUserPermissions()[$this->controller]) && !in_array($this->controller, $this->exclude)) {
				$this->actionIfBlocked();
			}

			if (!in_array($this->controller, $this->exclude)) {
				$this->actionIfBlocked();
			}
		}

		private function getUserPermissions() {
			if (!$this->user) {
				return;
			}

			$permission = new Permission();
			$permissionsEncontradas = $permission->userPermissions($this->user->id);

			$controllersAndNames = [];

			foreach ($permissionsEncontradas as $permission) {
				$controllersAndNames[$permission->controller][] = $permission->method;
			}

			return $controllersAndNames;
		}		

		private function controllersName() {
			$controller = $this->controller;
		}

		private function actionIfBlocked() {
			if (in_array($this->method, $this->methodsToDie)) {
				throw new AccessDeniedException("Acesso Negado");
			}
			$methods = $this->getUserPermissions()[$this->controller];
			if (!in_array($this->method, $methods)) {
				if (strstr($this->controller, 'Painel')) {
					flash(['acesso_negado' => "Você não possui permissão para acessar o painel. Contate o <b>Administrador</b>."]);
					return redirect('/');
				}
				return redirect('/painel');
			}
		}
		
	}