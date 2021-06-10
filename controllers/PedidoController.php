<?php

require_once 'models/pedido.php';

class pedidoController{

    public function hacer(){

        require_once 'views/pedido/hacerPedido.php';
    }
    

    public function add(){

        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;  
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;  
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false; 

            //para obtener el coste total invocamos la clase utls y ejecutal nuestra funcion stats
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
          
            
            if($provincia && $localidad && $direccion){
                //GUARDAR DADOS EN BD
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();
                //guardar linea pedido
                $save_linea_pedido = $pedido->save_linea_pedido();


                if ($save && $save_linea_pedido) {
                    $_SESSION['pedido'] = "complete";
                }else{
                    $_SESSION['pedido'] = "failed";
                }
            }else{
                $_SESSION['pedido'] = "failed";
            }
            header("location:".base_url.'pedido/confirmado');
            
        }else{
            //redirigir a index
            header("location:".base_url);
        }
    }

    //crear una funcion de peddido
    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser(); 

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);

        }
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        //sacar los pedidos del usuario
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detallePedido(){
        Utils::isIdentity();
        if(isset($_GET['id'])){
            $idPedido = $_GET['id']; 
            //sacar los datos del pedido
            $pedido = new Pedido();
            $pedido->setId($idPedido);
            $pedido = $pedido->getOne();
            //sacar lo producto 
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($idPedido);

            require_once 'views/pedido/detallePedido.php';
        }else{
            header('Location:'.base_url.'pedido/mis_pedidos');
        }

    }

    //crear gestion pedidos COMO ADMIN
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos =  $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    //fuction para hacer el cambio de estado del pedido
    public function estado(){
        Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            //recoger datos de formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //hacer un update del pedido del estado de pedio
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:".base_url.'pedido/detallePedido&id='.$id);

        }else{
            header("Location:".base_url);
        }
    }

}