<?php

    namespace app\models\database;

    use app\interfaces\IModel;
    use app\models\database\Connection;
    use app\models\database\AttributesCreate;
    use app\models\database\AttributesUpdate;
    use PDOException;

    class DefaultModel implements IModel {

        protected $database;

        public function __construct() {
            $database = new Connection;
            $this->database = $database->connection();
        }

        public function create($attributes) {
            $attributesCreate = new AttributesCreate;
            $fields = $attributesCreate->createFields($attributes);
            $values = $attributesCreate->createValues($attributes);
            $query = "INSERT INTO {$this->table} ({$fields}) VALUES({$values})";
            $pdo = $this->database->prepare($query);
            $bindParameters = $attributesCreate->bindCreateParameters($attributes);

            try {
                $pdo->execute($bindParameters);
                // O postgres requisita a sequência da tabela cujo ID deve ser retornado
                return $this->database->lastInsertId(static::SEQUENCE);
            } catch (PDOException $e) {
                /**
                 * @todo criar classe de log para salvar a mensagem
                 */
                // dump($e->getMessage());
                dd($e->getMessage());
                $log = $e->getMessage();
            }
        }

        public function read() {
            $query = "SELECT * FROM {$this->table}";
            $pdo = $this->database->prepare($query);
            try {
                $pdo->execute();
                return $pdo->fetchAll();
            } catch (PDOException $e) {
                dump($e->getMessage());
            }
        }
        
        public function update($id, $attributes) {
            $attributesUpdate = new AttributesUpdate;
            $fields = $attributesUpdate->updateFields($attributes);
            $query = "UPDATE $this->table SET $fields WHERE id = :id";
            $pdo = $this->database->prepare($query);
            $bindUpdateParameters = $attributesUpdate->bindUpdateParameters($attributes);
            $bindUpdateParameters['id'] = $id;
            try {
                $pdo->execute($bindUpdateParameters);
                return $pdo->rowCount();
            } catch (PDOException $e) {
                dump($e->getMessage());
            }
        
        }
        public function delete($name, $value) {
            $query = "DELETE FROM {$this->table} WHERE {$name} = :{$name}";
            $pdo = $this->database->prepare($query);
            try {
                $pdo->bindParam(":{$name}", $value);
                $pdo->execute();
                return $pdo->rowCount();
            } catch (PDOException $e) {
                return toJson($e->getMessage());
            }
        }

        public function findBy($name, $value) {
            $query = "SELECT * FROM {$this->table} WHERE {$name} = '{$value}'";
            $pdo = $this->database->prepare($query);
            try {
                $pdo->execute();
                return $pdo->fetch();
            } catch (PDOException $e) {
                return toJson($e->getMessage());
            }
        }

        /**
         * Retorna somente dados ativos
         */
        public function findByActives($name, $value) {
            $query = "SELECT * FROM {$this->table} WHERE {$name} = '{$value}' AND ativo = 1";
            $pdo = $this->database->prepare($query);
            try {
                $pdo->execute();
                return $pdo->fetch();
            } catch (PDOException $e) {
                return toJson($e->getMessage());
            }
        }

        /**
         * Retorna todos os dados
         */
        public function all() {
            $query = "SELECT * FROM {$this->table}";
            $pdo = $this->database->prepare($query);
            $pdo->execute();
            return $pdo->fetchAll();
        }
    }