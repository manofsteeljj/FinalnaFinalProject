<?php

namespace controllers;

use models\User;
class LoginContr extends User{

    protected $username;
    protected $password;
    
    public function __construct($username=null, $password=null)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (empty($this->username) || empty($this->password)) {
                return 'Input Fields are missing!';
                exit;
            }

            $user = $this->getUser($this->username, $this->password);
        
            if ($user) {
                session_start();
                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['admin_id'];
                $_SESSION['username'] = $user['username'];
         
                header('Location: ../app/views/user/home.php');
                exit;
            } else {
    
                return 'Invalid credentials!';
            }
        }
    }

    public function signUp(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (empty($this->username) || empty($this->password)) {
                return 'Input Fields are missing!';
                exit;
            }

            $this->setUser($username, $password);
            header('Location: /JJF/public/index.php');
            exit;

        }   
    }
}