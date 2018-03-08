<?php
	
	namespace app\classes;

	use app\models\usuarios\Permission;

	class ControllersPermissions {

		/*************************************
		************* ATTRIBUTES *************
		*************************************/

		private $methods = [
			'index', 'show', 'edit', 'update', 'create', 'store', 'destroy'
		];

		// Contém os Controllers que não devem ser considerados nas permissões. São comuns a todos os usuários.
		private $exclude = [
			'HomeController.php', 'LoginController.php', 'ContainerController.php'
		];

		// Contém os controllers cujas permissões deverão ser checadas
		private $controllers = [];

		// Contém os cotrollers e seus métodos, indicando suas permissões
		private $controllersName = [];

		/*************************************
		*********** PUBLIC METHODS **********
		*************************************/

		/**
		 * Retorna os controllers e seus métodos, indicando quais serão permitidos ao usuário
		 * @param $user = ID do usuário
		 */
		public function getPermissions($user) {
			$controllers = $this->getControllersName();
			foreach ($controllers as $controller) {
				$this->controllersAndPermissions($controller, $user);
			}
			return $this->controllersName;
		}

		/*************************************
		*********** PRIVATE METHODS **********
		*************************************/

		/**
		 * Percorre a lista de controllers e retira a extensão (.php) de cada um
		 */ 
		private function getControllersName() {
			$controllers = $this->folderControllers();
			$controllers = array_map(function($controller) {
				list($filename, $extension) = explode('.', $controller);
				return $filename;
			}, $controllers);
			return $controllers;
		}

		/**
		 * Faz a chamada ao método que percorre todas as pastas e subpastas
		 */
		private function folderControllers() {
			$this->scanDirectoriesAndSub('../app/controllers/');
			return $this->controllers;
		}

		/**
		 * Percorre os diretórios dos controllers recursivamente em busca dos mesmos
		 * @param $base_dir = Diretório base a ser percorrido
		 */
		private function scanDirectoriesAndSub($base_dir) {
			$dirs = [];
			foreach (scandir($base_dir) as $file) {
				if ($file != '.' && $file != '..') {
					$dir = $base_dir.DIRECTORY_SEPARATOR.$file;
					if (is_dir($dir)) {
						$dirs[] = $dir;
						$dirs = array_merge($dirs, $this->scanDirectoriesAndSub($dir));
					} else if (!in_array($file, $this->exclude)) {
						$this->controllers[] = $file;
					}
				}
			}
			return $this->controllers;
		}

		/**
		 * Pesquisa no banco de dados, através do model Permission, quais métodos o usuário passado por parâmetro tem acesso
		 * @param $controller = Controler cujos métodos serão verificados
		 * @param $user = ID do usuário
		 */
		private function controllersAndPermissions($controller, $user) {
			$permission = new Permission();
			$permissions = $permission->userPermissions($user);

			if (!$permissions) {
				$this->permissionsNotFound($controller);
			} else {
				$this->permissionsFound($permissions, $controller);
			}
		}

		/**
		 * Caso uma permissão não seja encontrada, será rotalada como 'negative', classe contextual do Semantic UI
		 * @param $controller = Controller cujos métodos serão marcados como não permitidos
		 */
		private function permissionsNotFound($controller) {
			foreach ($this->methods as $method) {
				if (!isset($this->controllersName[$controller][$method])) {
					$this->controllersName[$controller][$method] = 'negative';
				}
			}
		}

		/**
		 * Caso uma permissão seja encontrada, será rotalada como 'positive', classe contextual do Semantic UI
		 * @param $permissions = Permissões retornadas da tabela 'tb_permissoes'
		 */
		private function permissionsFound($permissions, $controller) {
			foreach ($permissions as $permission) {
				if ($permission->controller == $controller) {
					$this->controllersName[$controller][$permission->method] = 'positive';
				}

				foreach ($this->methods as $method) {
					if (!isset($this->controllersName[$controller][$method])) {
						$this->controllersName[$controller][$method] = 'negative';
					}
				}
			}
		}
	}
?>