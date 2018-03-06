<?php

    namespace app\models\database;
    use PDO;

    class Connection {
        
        //const INIFILE = './config/database.ini';
        //private $iniData;

        private $config;

        public function __construct() {
            //$this->iniData = parse_ini_file(self::INIFILE);
            $this->config = require '../config.php';            
        }

        public function connection() {
            $pdo = new PDO("{$this->config->driver}:host={$this->config->host};port={$this->config->port};dbname={$this->config->dbname}", $this->config->username, $this->config->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        }

    }