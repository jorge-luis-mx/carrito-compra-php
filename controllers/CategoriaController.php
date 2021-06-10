<?php

require_once'models/categoria.php';
require_once'models/producto.php';

class categoriaController{

    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    //metodo para ver todo los productos de la categoria
    public function ver(){
        if (isset($_GET['id'])) {
           $id = $_GET['id'];

           //CONSEGUIR CATEGORIAS
            $categorias = new Categoria();
            $categorias->setId($id);
            $categoria = $categorias->getOne();

            //CONSEGUIR PRODUCTOS
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }


    //crear un metodo crear
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    //crear un metodo para guardarcategorias
    public function save(){
        Utils::isAdmin();

        if (isset($_POST) && isset($_POST['nombre'])) {

            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();
        }
        header("Location:".base_url."categoria/index");
    }

}