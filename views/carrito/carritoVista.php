<h1>carrito de la compra</h1>

<!--Primero verificamos si existe sssion del carrito y luego  si hay un producto en el carrito-->
<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1): ?>


<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>

    <?php 
        foreach($carrito as $indice => $elemento):
            $resultado = $elemento['producto'];   
    ?>
    <tr>
        <td>
            <?php if($resultado->imagen != null) :?>
                <img src="<?=base_url?>upload/images/<?=$resultado->imagen?>" alt="" class="img_carrito">
            <?php  else: ?>
                <img src="<?=base_url?>assets/img/camiseta.png" alt="" class="img_carrito">
            <?php endif; ?>   
        </td>
        <td>
           <a href="<?=base_url?>producto/verDetalleProduct&id=<?=$resultado->id?>"><?=$resultado->nombre?></a> 
        </td>
        <td>
            <?=$resultado->precio?>
        </td>
        <td>
            <?=$elemento['unidades']?>
            <div class="updown-unidades">
                <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
                <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button">-</a>
            </div>
        </td>
        <td>
            <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button button-carrito button-red">Eliminar</a>
        </td>
    </tr>
    <?php endforeach;?>

</table>
<br>
<div class="delete-carrito">
    <a href="<?=base_url?>carrito/delete_all" class="button button-delete button-red">vaciar carrito</a>
</div>

<!--imprimir datos de precios totales-->
<div class="total-carrito">
    <?php $stats = Utils::statsCarrito(); ?>
    <h3>Precio total: <?=$stats['total']?></h3>
    <a href="<?=base_url?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
</div>
<?php else:?>

    <p>el carrito esta vacio, añade un producto</p>

<?php endif; ?>