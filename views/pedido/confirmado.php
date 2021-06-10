<?php  if(isset($_SESSION['pedido']) && $_SESSION['pedido']=='complete'):?>
    <h1>Se ha confirmado tu pedido</h1>
    <p>Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria a la cuenta 75486124512356 con el coste
    del pedido, sera procesado y enviado</p>
    <br/>
    <?php if(isset($pedido)): ?>
        <h3>Datos del pedido:</h3>

        Numero de pedido: <?=$pedido->id?><br/>
        Total a pagar:$ <?=$pedido->coste?><br/>
        Productos:
        <!--hacer blucle -->
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while($proudcto =$productos->fetch_object()): ?>
            <tr>
                <td>
                    <?php if($proudcto->imagen != null) :?>
                        <img src="<?=base_url?>upload/images/<?=$proudcto->imagen?>" alt="" class="img_carrito">
                    <?php  else: ?>
                        <img src="<?=base_url?>assets/img/camiseta.png" alt="" class="img_carrito">
                    <?php endif; ?>   
                </td>
                <td>
                <a href="<?=base_url?>producto/verDetalleProduct&id=<?=$proudcto->id?>"><?=$proudcto->nombre?></a> 
                </td>
                <td>
                    <?=$proudcto->precio?>
                </td>
                <td>
                    <?=$proudcto->unidades?>
                </td>
            </tr>
        <?php  endwhile;?>
    </table>

    <?php endif;?>

    <?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido']!='complete'):?>
        <h1>Tu pedido no se ha podido procesarse</h1>
    <?php endif; ?>