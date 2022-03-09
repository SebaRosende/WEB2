<?php
require_once 'view/error.view.php';
require_once 'helper/authhelper.php';
require_once 'view/usuarios.view.php';
require_once 'controllers/authcontroller.php';
require_once 'view/impresora.view.php';


class impresorasController
{
    private $impresoramodel;
    private $userview;
    private $user;
    private $modelimpresora;
    private $metodomodel;
    private $modelUser;
    private $improrasview;
    private $authHelper;
    private $errorview;


    public function __construct()
    {
        $this->userview = new UserView();   
        $this->impresoramodel = new ImpresoraModel();
        $this->user = new AuthHelper();
        $this->improrasview = new ImpresoraView();
        $this->userview = new UserView();
        $this->modelimpresora = new ImpresoraModel();
        $this->metodomodel = new MetodoModel();
        $this->modelUser = new UserModel();
        $this->authHelper = new AuthHelper();
        $this->authController = new AuthController();
        $this->errorview = new ErrorView();
    }
 /*-------------- Render de Views ---------------*/

 function showHome()  //Muestra el home.
 {
     $allPrinters = $this->modelimpresora->getAllPrinters(); 
     $this->improrasview->renderHome($allPrinters);  
 }

 function showDetails()  //Muestra el detalle.
 {
     $id = $_REQUEST['id'];
     $detalles = $this->modelimpresora->getPrinterByID($id);  
     $this->improrasview->renderDetails($detalles);  //tipo, modelo, dpi, toner, tinta.


 }
 function showFilter()  //Categorias.
 {
     $Metodos = $this->metodomodel->getAllMetodos();
     $this->improrasview->renderFilter($Metodos);     
 }

 function showFiltrado($filtro)  //Render SPA de la respuesta del filtro. (Select).
 {
     $impresoras = $this->modelimpresora->getAllPrinters();
     $this->improrasview->renderFiltrado($impresoras, $filtro);
 }

 /*------------  Registro y Vista Admin ----------*/

 function showAdmin()
 {
     $rol = $this->authHelper->checkRol();  //Verifica permisos.
     if ($rol) {
         $impresoras = $this->modelimpresora->getAllPrinters();
         $metodos = $this->metodomodel->getAllMetodos();
         $this->userview->renderAdmin($impresoras, $metodos);   //ABM.
     } else {
        $this->errorview->errorAdmin();
     }
 }

 function showRegister() //Formulario de registro.
 {
     $this->userview->renderRegister();
     if (!empty($_POST['email']) && !empty($_POST['password'])) {  //Verifico si los campos estan vacios o no.
         $userEmail = $_POST['email'];
         $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
         $this->modelUser->registerUser($userEmail, $userPassword);
         $this->authController->login();
     }
 }

    /*---------------- Administrar Impresoras ------------------- */

    function agregarImpresora()
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $marca = $_REQUEST['marca'];
            $modelo = $_REQUEST['modelo'];
            $descripcion = $_REQUEST['descripcion'];
            $metodo = $_REQUEST['select_metodo'];
            if( $_FILES['input_name']['type'] == "image/jpg"    //Verifico que sea una imagen.
            || $_FILES['input_name']['type'] == "image/jpeg"
            || $_FILES['input_name']['type'] == "image/png"){
               $this->impresoramodel->createImpresora($marca, $modelo, $descripcion, $metodo, $_FILES['input_name']['tmp_name']);
            }else{
                $this->impresoramodel->createImpresora($marca, $modelo, $descripcion, $metodo);
            }
          
            $this->userview->refreshAdmin();
        } else {
            $this->errorview->errorAdmin();
        }
    }

    function editarImpresora()
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $id_impresora = $_REQUEST['id_impresora'];
            $marca = $_REQUEST['marca'];
            $modelo = $_REQUEST['modelo'];
            $descripcion = $_REQUEST['descripcion'];
            $metodo = $_REQUEST['select_metodo'];
            $eliminarFoto = $_REQUEST['eliminar_foto']; //FALSE

            if ($eliminarFoto == 'false') {  //Verifico si quiero elimnar una foto
                $this->impresoramodel->editImpresora($id_impresora, $marca, $modelo, $descripcion, $metodo, $eliminarFoto);
            } else if (
                $_FILES['input_name']['type'] == "image/jpg"    //Verifico que sea una imagen.
                || $_FILES['input_name']['type'] == "image/jpeg"
                || $_FILES['input_name']['type'] == "image/png"
            ) {
                $this->impresoramodel->editImpresora($id_impresora, $marca, $modelo, $descripcion, $metodo, $_FILES['input_name']['tmp_name']);
            } else {  //Si no modifico imagen, se edita el resto.
                $this->impresoramodel->editImpresora($id_impresora, $marca, $modelo, $descripcion, $metodo);
            }
            $this->userview->refreshAdmin();
        } else {
            $this->errorview->errorAdmin();
        }
    }

    function eliminarImpresora($id)
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $this->impresoramodel->deleteImpresoraByID($id);
            $this->userview->refreshAdmin();
        } else {
            $this->errorview->errorAdmin();
        }
    }
}
