<?php
namespace config;
class Db{

    protected function connect(){
        try {
            // Database configuration
            $host = 'localhost';
            $dbname = 'dormdb_sasa';
            $username = 'root';
            $password = '';

            // Connect to the database using PDO
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>