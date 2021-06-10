<?php

require_once 'models/usuario.php';

class usuarioController{

    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    //funcion o metodo para registar usuarios
    public function save(){
        //verificamos los valores q nos envian
        if (isset($_POST)) {

            $nombre     = isset($_POST['nombre'])? $_POST['nombre']:false;
            $apellido   = isset($_POST['apellidos'])? $_POST['apellidos']:false;
            $email      = isset($_POST['email'])? $_POST['email']:false;
            $password   = isset($_POST['password'])? $_POST['password']:false;

            if ($nombre && $apellido && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre ); 
                $usuario->setApellidos($apellido); 
                $usuario->setEmail($email); 
                $usuario->setPassword($password);
                
                $save = $usuario->save();
                if ($save) {
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }

        }else {
            $_SESSION['register'] = "failed";
        }
        header ("Location:".base_url.'usuario/registro');
        
    }


    //funcion o metodo para login de usuario
    public function login(){
        if (isset($_POST)) {
            //$usuario->login($_POST['email'],$_POST['password']);
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();

            //Crear una session
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                //Crear permiso
                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'identificacion fallida!';
            }
            
        }
        header("location:".base_url);
    }

    //funcion o metodo para cerrar session de login
    public function logout(){
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:".base_url);

    }
}