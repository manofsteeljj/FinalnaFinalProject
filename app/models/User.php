<?php
namespace models;

use config\Db;

class User extends Db{
    
    protected function getUser($username, $password){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if(password_verify($password, $user['password'])){
            return $user;
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public function setUser($username, $password){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->connect()->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        $stmt = null;
    }

    public function getAllUsers() {
        $stmt = $this->connect()->prepare('SELECT * FROM user');
        $stmt->execute();
        $admin = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $admin;
    }
    public function delete($id) {
        $stmt = $this->connect()->prepare('DELETE FROM user WHERE admin_id = ?');
        $stmt->execute([$id]);
    }
}