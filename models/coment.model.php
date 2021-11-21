<?php

class ComentModel
{

    private $db_impresoras;

    public function __construct()
    {
        $this->db_impresoras = new PDO('mysql:host=localhost;' . 'dbname=db_impresoras;charset=utf8', 'root', '');
        
    }

function getComentbyPrinter($parametro)
{
    $query = $this->db_impresoras->prepare('SELECT * FROM comentarios WHERE id_impresora_fk=?');
    $query->execute([$parametro]);
    $impresora= $query->fetchAll(PDO::FETCH_OBJ);
    return $impresora;
}

function insertComent($id_impresora, $comentario, $puntaje){
    $query = $this->db_impresoras->prepare('INSERT INTO comentarios (detalle, puntaje, id_impresora_fk) VALUES (?,?,?)');
    $query->execute([$comentario, $puntaje, $id_impresora]);
}

function deleteComent($id)
    {
        $query = $this->db_impresoras->prepare('DELETE FROM comentarios WHERE id_comentario= ?');
        $query->execute([$id]);
    }



}