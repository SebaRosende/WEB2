<?php
require_once 'models/coment.model.php';
require_once 'api/api.view.php';
require_once 'models/impresora.model.php';
require_once 'helper/authhelper.php';



class ApiTaskController
{
    private $model;
    private $user;

    function __construct()
    {
        $this->model = new ComentModel();
        $this->modelprinter = new ImpresoraModel();
        $this->view = new ApiView();
        $this->user = new AuthHelper();
    }
    private function getBody()
    {
        $data = file_get_contents("php://input");
        return json_decode($data);
    }

    public function addComent($params = null)
    {
        $id = $params[':ID'];
        $data = $this->getBody();
        $comentario = $data->detalle;
        $puntaje = $data->puntaje;
        $idComentario = $this->model->insertComent($id, $comentario, $puntaje);
        $comentarios = $this->model->getComentbyID($idComentario);

        if ($comentarios)
            $this->view->response($comentarios, 200);
        else
            $this->view->response("Comentario no creado", 500);
    }

    function showComentByPrinter($params = null) //Llamo a los comentarios de una impresora por id de impresora (FK).
    {
        $id = $params[':ID'];
        if (!empty($id) && is_numeric($id)) {
            $impresora = $this->model->getComentbyPrinter($id);
            if (!empty($impresora)) {
                $this->view->response($impresora);
            } else {
                echo  'La impresora no tiene comentarios';
            }
        } else {
            $this->view->response("consulta erronea", 404);
        }
    }


    public function removeComentario($params = null)  //Elimnar comentario por ID.
    {
        $rol = $this->user->checkRol();
        if ($rol) {
            $id = $params[':ID'];
            if (!empty($id) && is_numeric($id)) {
                $comentario_impresora = $this->model->getComentbyID($id);
                if (!empty($comentario_impresora)) {
                    $this->model->deleteComent($id);
                    echo 'comentario eliminado';
                } else {
                    echo 'el comentario no existe';
                }
            } else {
                $this->view->response("consulta erronea, id incorrecto", 404);
            }
        } else {
            echo "Ud. no puede eliminar el comentario";
        }
    }

    function getAllImpresoras() //Busca todas las impresoras.
    {
        $allPrinters = $this->modelprinter->getAllPrinters();
        $this->view->response($allPrinters, 200);
    }

    function getimpresoraByID($params = null)  //Busca impresora por ID.
    {
        $id = $params[':ID'];
        $detalles = $this->modelprinter->getPrinterByID($id);
        $this->view->response($detalles, 200);
    }
    /*------------------ORDENAR  COMENTARIOS----------------- */
    function getOrderAsc($params = null)  //Ordenar comentarios ascendente.
    {
        $id = $params[':ID'];
        $detalles = $this->model->getComentbyOrderAsc($id);
        $this->view->response($detalles);
    }
    function getOrderDesc($params = null)  //Ordenar comentarios descendente.
    {
        $id = $params[':ID'];
        $detalles = $this->model->getComentbyOrderDesc($id);
        $this->view->response($detalles);
    }
}
