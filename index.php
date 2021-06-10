<?php
//iniciar la session
session_start();
//Para tener acceso todo los controladores
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
//requerimos la vista
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

//conexion a la base de datos a diferentes partes
//$db = Database::connect();

//FUNCION DE ERROR 
function show_error(){
    $error = new errorController();
    $error->index();
}


//comprobar si el controlador llega por la url
if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'].'Controller';

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;

}else{
    show_error();
    exit();
}

//comprobar si existe el controlador 
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador;
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
        
    }else{
        show_error();
    }
}else{
    show_error();
}

//requerimos vista footer
require_once 'views/layout/footer.php';