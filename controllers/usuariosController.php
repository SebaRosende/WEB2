<?php
require_once 'helper/authhelper.php';
require_once 'controllers/authcontroller.php';
require_once 'view/usuarios.view.php';

class UserController
{
    private $usermodel;
    private $userview;

    public function __construct()
    {
        $this->userview = new UserView();
        $this->usermodel = new UserModel();
        $this->authHelper = new AuthHelper();
        $this->authController = new AuthController();
    }

    public function showUsuarios()
    {
        $this->authHelper->checkLoggedIn();
        $rol = $this->authHelper->checkRol();
        if ($rol) {
            $users = $this->usermodel->getAllUser();
            $roles = $this->usermodel->getAllRoles();
            $this->userview->renderUsers($users, $roles);
        } else {
            echo "No tiene derechos de administrador";
        }
    }

    function editarUsuario()
    {
        $id_user = $_REQUEST['id_user'];
        $rol = $_REQUEST['select_rol'];
        $this->usermodel->editUser($id_user, $rol);
        $this->userview->refreshUsers();
    }

    function eliminarUsuario($id)
    {

        $this->authHelper->checkLoggedIn();
        $rol = $this->authHelper->checkRol();
        if ($rol) {
            $this->usermodel->deleteUserByID($id);
            $this->userview->refreshUsers();
        } else {
            echo "No tiene derechos de administrador";
        }
    }
}
