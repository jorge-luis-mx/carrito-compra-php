<?php

class Pedido{
    private  $id;
    private  $usuario_id;
    private  $provincia;
    private  $localidad;
    private  $direccion;
    private  $coste;
    private  $estado;
    private  $fecha;
    private  $hora;
    private  $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }
    function getUsuario_id(){
        return $this->usuario_id;
    }
    function getProvincia(){
        return $this->provincia;
    }
    function getLocalidad(){
        return $this->localidad;
    }
    function getDireccion(){
        return $this->direccion;
    }
    function getCoste(){
        return $this->coste;
    }
    function getEstado(){
        return $this->estado;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getHora(){
        return $this->hora;
    }


    function setId($id){
        $this->id = $id;
    }
    function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }
    function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }
    function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }
    function setCoste($coste){
        $this->coste = $coste;
    }
    function setEstado($estado){
        $this->estado = $estado;
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setHora($hora){
        $this->hora = $hora;
    }


    //meto para listar lo productos
    public function getAll(){
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $productos;
    }
  
    public function getOne(){
    $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $producto->fetch_object();
        var_dump($producto);
    }
    //buscar un pedido por usuario
    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p "
        //."INNER JOIN lineas_pedidos line_p ON line_p.pedido_id=p.id "
        ."WHERE p.usuario_id={$this->getUsuario_Id()} ORDER BY id DESC LIMIT 1";
            // $sql_pedido = $this->db->query("SELECT p.id, p.coste FROM pedidos p
            //INNER JOIN lineas_pedidos line_p ON line_p.pedido_id=p.id 
            // WHERE p.usuario_id={$this->getUsuario_Id()} ORDER BY id DESC LIMIT 1");
            $pedido = $this->db->query($sql);
            return $pedido->fetch_object();
    }
    //obtiene todos los pedidos de un usuario
    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
        ."WHERE p.usuario_id={$this->getUsuario_Id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        return $pedido;
    }


    //obtiene el ultimo pedido
    public function getProductosByPedido($id){
        $sql = "SELECT pr.*,lp.unidades FROM productos pr "
        . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
        . "WHERE lp.pedido_id={$id}";

        $productos = $this->db->query($sql);
        return $productos;
    }


    //Crear un metodo de guardado en models
    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL,{$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(), CURTIME());";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;

    }
    //Crear un metodo para guardar la relacion de pedidos linea_pedido
    public function save_linea_pedido(){

        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        //recorer el carrito de producto
        foreach($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];
            $insert = "INSERT INTO lineas_pedidos VALUES(null,{$pedido_id},{$producto->id},{$elemento['unidades']})";
            $save = $this->db->query($insert);
        }
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    //update pedido el estado
    public function edit(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}'";
        $sql.=" WHERE id={$this->getId()};";

        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;

    }

   
}