<?php

require_once 'models/user.model.php';
require_once 'helper/authhelper.php';
require_once 'view/usuarios.view.php';

class AuthController
{
    private $usermodel;   
    private $authHelper;

    public function __construct()
    {
        $this->usermodel = new UserModel();      
        $this->userview = new UserView();
        $this->authHelper = new AuthHelper();
    }

    public function showLogin() //Muestro formulario de Login.
    {
        $this->userview->renderLogin();  
    }

    public function showLogout()  //Cierra cesion y devuelve al home.
    {
        $this->authHelper->logout();        
    }

    public function login()  //Verificacion de cuenta.
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->usermodel->getUser($email);   // Busco el usuario en la BDD.

            if ($user && password_verify($password, $user->password)) { //Verifico si coincide el usuario y la contraseña.
                $this->authHelper->login($user);  //creo la sesion del usuario.
                header('LOCATION:' .BASE_URL);
            } else {
                $this->userview->renderLogin("Usuario o contraseña invalido.");
            }
        }
    }
}