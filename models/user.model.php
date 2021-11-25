<?php

class UserModel
{

    private $db_impresoras;

    public function __construct()
    {
        $this->db_impresoras = new PDO('mysql:host=localhost;' . 'dbname=db_impresoras;charset=utf8', 'root', '');
    }

    /*-----------------Funciones de usuarios-----------------*/
    function getUser($email)
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM usuarios WHERE email = ?'); //Busco user en la BDD.
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
    function registerUser($userEmail, $userPassword)
    {
        $query = $this->db_impresoras->prepare('INSERT INTO usuarios (email, password, id_rol_fk) VALUES (? , ?, ?)');  //Guardo en la BDD.
        $query->execute([$userEmail, $userPassword, 2]);
    }

    function getAllUser()  //Busca las 2 tablas, usuarios y roles.
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM usuarios JOIN roles ON usuarios.id_rol_fk=roles.id_rol');
        $query->execute();
        $allUsers = $query->fetchAll(PDO::FETCH_OBJ); // obtengo un arreglo con todos los usuarios.
        return $allUsers;
    }

    function getAllRoles()
    {
        $query = $this->db_impresoras->prepare('SELECT * FROM roles');
        $query->execute();
        $allRoles = $query->fetchAll(PDO::FETCH_OBJ);
        return $allRoles;
    }

    function editUser($id_user, $rol)
    {
        $query = $this->db_impresoras->prepare('UPDATE usuarios SET id_rol_fk=? WHERE id=?');
        $query->execute([$rol, $id_user]);
    }

    function deleteUserByID($id)
    {
        $query = $this->db_impresoras->prepare('DELETE FROM usuarios WHERE id= ?');
        $query->execute([$id]);
    }
}
