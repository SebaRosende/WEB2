<?php
require_once 'models/coment.model.php';
require_once 'api/api.view.php';

class ApiTaskController
{
    private $model;

    function __construct()
    {
        $this->model = new ComentModel();
        $this->view = new ApiView();
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
        $comentario = $data->coment;
        $puntaje = $data->puntaje;
        $idComentario = $this->model->insertComent($id, $comentario, $puntaje);
        $comentarios = $this->model->getComentbyID($idComentario);

        if ($comentarios)
            $this->view->response($comentarios, 200);
        else
            $this->view->response("Comentario no creado", 500);
    }

    function showImpresora($params = null)
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


    public function removeComentario($params = null)
    {
        $id = $params[':ID'];
        if (!empty($id) && is_numeric($id)) {
            $comentario_impresora = $this->model->getComentbyID($id);
            if (!empty($comentario_impresora)) {
                $this->model->deleteComent($id);
                echo 'comentario eliminado';
            } else {
                echo 'el comentario no exsiste';
            }
        } else {
            $this->view->response("consulta erronea, id incorrecto", 404);
        }
    }
}
