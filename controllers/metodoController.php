<?php
require_once 'helper/authhelper.php';

class metodoController
{
    private $metodomodel;
    private $impresoramodel;
    private $userview;
    private $user;

    public function __construct()
    {
        $this->userview = new UserView();
        $this->metodomodel = new MetodoModel();
        $this->impresoramodel = new ImpresoraModel();
        $this->user = new AuthHelper();
    }

    function agregarMetodo()  //Agrega metodo de impresion.
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $this->metodomodel->createMetodo();
            $this->userview->refreshAdmin();
        } else {
            echo "Ud. no puede eliminar impresora";
        }
    }

    function editMetodo()  //Edita metodo de impresion.
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $id = $_POST['id_metodo'];
            $newMetodo = $_POST['input_metodo'];
            $this->metodomodel->editarMetodo($id, $newMetodo);
            $this->userview->refreshAdmin();
        } else {
            echo "Ud. no puede eliminar impresora";
        }
    }

    function deleteMetodo($id)  //Eliminar metodo. Si hay impresora vinculada al metodo, no se puede eliminar.
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $ImpresoraID = $this->impresoramodel->getPrinterByMetodo($id);
            if (!empty($ImpresoraID)) {
                $this->userview->refreshAdmin();
            } else {
                $this->metodomodel->deleteMetodoByID($id);
                $this->userview->refreshAdmin();
            }
        } else {
            echo "Ud. no puede eliminar impresora";
        }
    }
}
