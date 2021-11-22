<?php

require_once 'helper/authhelper.php';
require_once 'controllers/authcontroller.php';
require_once 'view/usuarios.view.php';
require_once 'view/impresora.view.php';

class controller
{

    private $modelimpresora;
    private $metodomodel;
    private $modelUser;
    private $improrasview;
    private $authHelper;

    public function __construct()
    {
        $this->improrasview = new ImpresoraView();
        $this->userview = new UserView();
        $this->modelimpresora = new ImpresoraModel();
        $this->metodomodel = new MetodoModel();
        $this->modelUser = new UserModel();
        $this->authHelper = new AuthHelper();
        $this->authController = new AuthController();
    }

    /*-------------- Render de Views ---------------*/

    function showHome()
    {
        $allPrinters = $this->modelimpresora->getAllPrinters(); //llamas a la base de datos.
        $this->improrasview->renderHome($allPrinters);
    }


    function showDetails()
    {
        $this->authHelper->UserLogged();
        $id = $_REQUEST['id'];
        $detalles = $this->modelimpresora->getPrinterByID($id);  //llamo por id a la db.
        $this->improrasview->renderDetails($detalles);          //tipo, modelo, dpi, toner, tinta.


    }
    function showFilter()
    {
        $Metodos = $this->metodomodel->getAllMetodos();
        $this->improrasview->renderFilter($Metodos);         //quiero impresoras laser color.
    }

    function showFiltrado($filtro)
    {
        $impresoras = $this->modelimpresora->getAllPrinters();
        $this->improrasview->renderFiltrado($impresoras, $filtro);
    }


    /*------------  Registro y Vista Admin ----------*/

    function showAdmin()
    {

        $rol = $this->authHelper->checkRol();

        if ($rol) {
            $this->authHelper->checkLoggedIn();
            $impresoras = $this->modelimpresora->getAllPrinters();
            $metodos = $this->metodomodel->getAllMetodos();
            $this->userview->renderAdmin($impresoras, $metodos);   //agregar, borrar, editar.
        } else {
            echo "No tiene derechos de administrador";
        }
    }

    function showRegister()
    {
        $this->userview->renderRegister();
        if (!empty($_POST['email']) && !empty($_POST['password'])) {  //Verifico si los campos estan vacios o no.
            $userEmail = $_POST['email'];
            $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->modelUser->registerUser($userEmail, $userPassword);
            $this->authController->login();
        }
    }
}
