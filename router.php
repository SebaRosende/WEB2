<?php

require_once 'controllers/controller.php';
require_once 'controllers/metodoController.php';
require_once 'controllers/impresorasController.php';
require_once 'controllers/authcontroller.php';
require_once 'controllers/usuariosController.php';
require_once 'models/impresora.model.php';
require_once 'models/metodo.model.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('LOGIN', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/login');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);
$controlador = new controller();
$controladorMetodo = new metodoController();
$controladorImpresoras = new impresorasController();
$controladorusuarios = new UserController();


switch ($params[0]) {
    case 'home':
        $controlador->showHome();
        break;
    case 'detalle':
        $controlador->showDetails();
        break;
    case 'filtrar':
        $controlador->showFilter();
        break;
    case 'filtrado':
        $controlador->showFiltrado($params[1]);
        break;
        /*------------ Cuentas y Administracion ---------*/
    case 'registrar':
        $controlador->showRegister();
        break;
    case 'login':
        $authController = new AuthController();
        $authController->showLogin();
        break;
    case 'verify':
        $authController = new AuthController();  //Verificar Sesion.
        $authController->login();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->showLogout();
        break;
    case 'administrar':
        $authController = new AuthController();
        $controlador->showAdmin();  //Administracion (Agregar, eliminar, editar, etc.).
        break;


        /*--------- Administrar Impresoras -------------*/
    case 'agregar_impresora':
        $authController = new AuthController();
        $controladorImpresoras->agregarImpresora();
        break;
    case 'editar_impresora':
        $authController = new AuthController();
        $controladorImpresoras->editarImpresora();
        break;
    case 'eliminar_impresora':
        $authController = new AuthController();
        $controladorImpresoras->eliminarImpresora($params[1]);
        break;
        /*
    case 'upload_image':
        $authController = new AuthController();
        $controladorImpresoras->uploadImage();
        */

        /*---------  Administrar Metodos ----------------*/
    case 'agregar_metodo':
        $authController = new AuthController();
        $controladorMetodo->agregarMetodo();
        break;
    case 'eliminar_metodo':
        $authController = new AuthController();
        $controladorMetodo->deleteMetodo($params[1]);
        break;
    case 'editar_metodo':
        $authController = new AuthController();
        $controladorMetodo->editMetodo();
        break;
        /*---------  Administrar Usuarios----------------*/

    case 'usuarios':
        $authController = new AuthController();
        $controladorusuarios->showUsuarios();
        break;
    case 'cambiarRol':
        $authController = new AuthController();
        $controladorusuarios->editarUsuario();
        break;
    case 'eliminarUser':
        $authController = new AuthController();
        $controladorusuarios->eliminarUsuario($params[1]);
        break;

    default:
        $controlador->showHome();  //Por defecto va al Home.
        break;
}
