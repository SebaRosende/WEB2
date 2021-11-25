<?php
require_once 'libs/Router.php';
require_once 'api/api-coment.controller.php';


$router = new Router();

$router->addRoute('comentario/impresora/:ID', 'POST', 'ApiTaskController', 'addComent'); //Agregar comentario
$router->addRoute('comentario/impresora/:ID', 'GET', 'ApiTaskController', 'showComentByPrinter'); //Mostrar comentarios x id impresora
$router->addRoute('comentario/:ID', 'DELETE', 'ApiTaskController', 'removeComentario'); //Eliminar comentario x id
$router->addRoute('impresoras', "GET", 'ApiTaskController', 'getAllImpresoras'); //Obtener impresoras
$router->addRoute('impresoras/:ID', "GET", 'ApiTaskController', 'getimpresoraByID'); //Obtener impresora x id
$router->addRoute('comentario/impresora/:ID/orderasc', 'GET', 'ApiTaskController', 'getOrderAsc'); //Ordenar comentarios ascendente
$router->addRoute('comentario/impresora/:ID/orderdesc', 'GET', 'ApiTaskController', 'getOrderDesc'); //Ordenar comentarios descendente


$resource = $_GET['resource'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);
