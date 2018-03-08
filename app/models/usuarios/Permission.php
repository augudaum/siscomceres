<?php
	
	namespace app\models\admin;

	use app\models\database\DefaultModel;

	class Permission extends DefaultModel {

		protected $table = 'tb_permissoes';
		const SEQUENCE = "permissions_id_seq";

		public function userPermissions($user) {
			$sql = "SELECT * FROM {$this->table} WHERE user_id = :id";
			$pdo = $this->database->prepare($sql);
			$pdo->bindValue(':id', $user);
			$pdo->execute();

			return $pdo->fetchAll();
		}

		/**
		 * Busca uma permissão de acordo com os parâmetros passados
		 * @param $method = Método a ser alterado
		 * @param $controller = Controller cujo método será alterado
		 * @param $idUser = ID do usuário cujas permissões serão atualizadas
		 */
		public function findPermissions($method, $controller, $idUser) {
			$sql = "SELECT * FROM {$this->table} WHERE user_id = :id AND controller = :controller and method = :method";
			$pdo = $this->database->prepare($sql);
			$pdo->bindValue(':id', $idUser);
			$pdo->bindValue(':controller', $controller);
			$pdo->bindValue(':method', $method);
			$pdo->execute();

			return $pdo->rowCount();
		}

		public function removePermission($method, $controller, $idUser) {
			$sql = "DELETE FROM {$this->table} WHERE user_id = :id AND controller = :controller and method = :method";
			$pdo = $this->database->prepare($sql);
			$pdo->bindValue(':id', $idUser);
			$pdo->bindValue(':controller', $controller);
			$pdo->bindValue(':method', $method);
			$pdo->execute();

			return $pdo->rowCount();
		}
	}