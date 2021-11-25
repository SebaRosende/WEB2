<?php

class MetodoModel
{

    private $db_impresoras;

    public function __construct()
    {
        $this->db_impresoras = new PDO('mysql:host=localhost;' . 'dbname=db_impresoras;charset=utf8', 'root', '');
    }

    function getAllMetodos()
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM metodos');
        $query->execute();
        $allMetodos = $query->fetchAll(PDO::FETCH_OBJ); // obtengo un arreglo con TODAS las impresoras.
        return $allMetodos;
    }

    function deleteMetodoByID($id)
    {
        $query = $this->db_impresoras->prepare('DELETE FROM metodos WHERE id_metodo= ?');
        $query->execute([$id]);
    }

    function createMetodo()
    {
        $newMetodo = $_POST['input_metodo'];
        $query = $this->db_impresoras->prepare('INSERT INTO metodos (id_metodo, metodo) VALUES (?,?)');
        $query->execute(['', $newMetodo]);
    }

    function editarMetodo($id, $newMetodo)
    {
        $query = $this->db_impresoras->prepare('UPDATE metodos SET metodo=? WHERE id_metodo=?');
        $query->execute([$newMetodo, $id]);
    }

    function getPrinterByFilter($filtro)
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM metodos WHERE metodo=?');
        $query->execute([$filtro]);
        $impresoras = $query->fetch(PDO::FETCH_OBJ);
        return $impresoras;
    }
}
