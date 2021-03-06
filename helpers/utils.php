<?php

class Utils{
     
    public static function deleteSession($name){
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
    //comprueba si existe una sesion de administrador
    public static function isAdmin(){
        if (!isset($_SESSION['admin'])) {
            header("Location:".base_url);
        }else{
            return true;
        }
    }
    //comprobar si ha iniciado session
    public static function isIdentity(){
        if (!isset($_SESSION['identity'])) {
            header("Location:".base_url);
        }else{
            return true;
        }
    }
    //crear el meto de mostrar categorias
    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categoria = $categoria->getAll();
        return $categoria;
    }

    //crear una funcion para carrito de estadisticas
    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);
            //recorrer para obtener precio total
            foreach ($_SESSION['carrito'] as $index => $producto) {
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }

        return $stats;
    }

    //mostrar el estado del pedido
    public static function showStatus($status){
        $value = "pendiente";

        if($status == 'confirm') {
           $value = 'pendiente';
        }
        elseif($status == 'preparation'){
            $value = 'En preparacion';
        }
        elseif($status == 'ready') {
            $value = 'Preparado para enviar';
        }
        elseif($status == 'sended') {
            $value = 'enviado';
        }
        return $value;
    }

}