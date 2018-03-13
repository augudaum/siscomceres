<?php

    namespace app\models\usuarios;

    use app\models\database\DefaultModel;

    class Usuario extends DefaultModel {
        protected $table = 'tb_usuarios';
        // Identifica a sessão de um usuário Administrador
        public $session_string = 'usuario_logado';
        // Identifica os dados de um usuário Administrador
        public $session_id_string = 'usuario_id';
        const SEQUENCE = "usuarios_id_seq";

        /**
         * Ativa um usuário
         * @param $id = ID do usuário a ser ativado
         */
        public function ativarUsuario($id) {
            $sql = "UPDATE {$this->table} SET ativo = 1 WHERE id = :id";
            $pdo = $this->database->prepare($sql);
            $pdo->bindValue(':id', $id);
            $pdo->execute();

            return $pdo->rowCount();
        }

        /**
         * Inativa um usuário
         * @param $id = ID do usuário a ser inativado
         */
        public function inativarUsuario($id) {
            $sql = "UPDATE {$this->table} SET ativo = 0 WHERE id = :id";
            $pdo = $this->database->prepare($sql);
            $pdo->bindValue(':id', $id);
            $pdo->execute();

            return $pdo->rowCount();
        }
    }