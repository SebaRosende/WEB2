<?php
require_once 'helper/authhelper.php';
require_once 'view/usuarios.view.php';

class impresorasController
{
    private $impresoramodel;
    private $userview;
    private $user;

    public function __construct()
    {
        $this->userview = new UserView();   //al atributo le instacio la clase View del View.php
        $this->impresoramodel = new ImpresoraModel();
        $this->user = new AuthHelper();
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
            $this->impresoramodel->createImpresora($marca, $modelo, $descripcion, $metodo);
            $this->userview->refreshAdmin();
        } else {
            echo "Ud. no puede eliminar impresora";
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
            echo "Ud. no puede eliminar impresora";
        }
    }

    function eliminarImpresora($id)
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $this->impresoramodel->deleteImpresoraByID($id);
            $this->userview->refreshAdmin();
        } else {
            echo "Ud. no puede eliminar impresora";
        }
    }
}
