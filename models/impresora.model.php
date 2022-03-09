<?php

class ImpresoraModel
{

    private $db_impresoras;

    public function __construct()
    {
        $this->db_impresoras = new PDO('mysql:host=localhost;' . 'dbname=db_impresoras;charset=utf8', 'root', '');
    }

    function getPrinterByID($parametro)
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM impresoras WHERE id_impresora=?');
        $query->execute([$parametro]);
        $impresora = $query->fetchAll(PDO::FETCH_OBJ);
        return $impresora;
    }

    function getAllPrinters()
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM impresoras JOIN metodos ON impresoras.id_metodo_fk=metodos.id_metodo');
        $query->execute();
        $allPrinters = $query->fetchAll(PDO::FETCH_OBJ); // obtengo un arreglo con TODAS las impresoras.
        return $allPrinters;
    }


    function createImpresora($marca, $modelo, $descripcion, $metodo, $image=null)
    {
        $pathImg = null;
        if ($image) { 
            $pathImg = $this->uploadImage($image);
            $query = $this->db_impresoras->prepare('INSERT INTO impresoras (modelo, marca, descripcion, id_metodo_fk, imagen) VALUES (?,?,?,?,?)');
            $query->execute([$modelo, $marca, $descripcion, $metodo, $pathImg]);}
        else{
            $query = $this->db_impresoras->prepare('INSERT INTO impresoras (modelo, marca, descripcion, id_metodo_fk) VALUES (?,?,?,?)');
            $query->execute([$modelo, $marca, $descripcion, $metodo]);}
        
    }

    function editImpresora($id_impresora, $marca, $modelo, $descripcion, $metodo, $image = null)
    {
        if ($image == 'false') {  //Elimino imagen por checkbox.
            $this->eliminarFoto($id_impresora, $marca, $modelo, $descripcion, $metodo);
        } else {
            $pathImg = null;
            if ($image) {  //verifico si hay imagen.
                $pathImg = $this->uploadImage($image);
            }
            $query = $this->db_impresoras->prepare('UPDATE impresoras SET modelo=?, marca=?, descripcion=?, id_metodo_fk=?, imagen=? WHERE id_impresora=?');
            $query->execute([$modelo, $marca, $descripcion, $metodo, $pathImg, $id_impresora]);
        }
    }
    function uploadImage($image)
    {
        $filePath = 'img/' . uniqid() . "." . strtolower(pathinfo($_FILES['input_name']['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image, $filePath); //funcion predeterminada de php
        return $filePath;
    }
    function deleteImpresoraByID($id)
    {
        $query = $this->db_impresoras->prepare('DELETE FROM impresoras WHERE id_impresora= ?');
        $query->execute([$id]);
    }

    function getPrinterByMetodo($id)
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM impresoras WHERE impresoras.id_metodo_fk=?');
        $query->execute([$id]);
        $printerByMetodo = $query->fetch(PDO::FETCH_OBJ);
        return $printerByMetodo;
    }

    function eliminarFoto($id, $marca, $modelo, $descripcion, $metodo)
    { 
        $eliminar = null;
        $query = $this->db_impresoras->prepare('UPDATE impresoras SET modelo=?, marca=?, descripcion=?, id_metodo_fk=?, imagen=? WHERE id_impresora=?');
        $query->execute([$modelo, $marca, $descripcion, $metodo, $eliminar, $id]);
    }

  
}
