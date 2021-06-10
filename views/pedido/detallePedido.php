
<h1>Detalles pedidos</h1>

<?php if(isset($pedido)): ?>
        <?php if(isset($_SESSION['admin'])): ?>
            <h3>Cambiar estado del pedido</h3>
            <form action="<?=base_url?>pedido/estado" method="POST">
                <input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>
                <select name="estado">
                    <option value="confirm" <?=$pedido->estado=="confirm"? 'selected':'';?> >Pendiente</option>
                    <option value="preparation" <?=$pedido->estado=="preparation"? 'selected':'';?> >En preparacion</option>
                    <option value="ready" <?=$pedido->estado=="ready"? 'selected':'';?> >Preparado para enviar</option>
                    <option value="sended" <?=$pedido->estado=="sended"? 'selected':'';?> >Enviado</option>
                </select>
                <input type="submit" value="Cambiar Estado"/>
            </form>
            <br>
        <?php endif; ?>

        <h3>Direccion del envio:</h3>
        Provincia: <?=$pedido->provincia?><br/>
        Ciudad: <?=$pedido->localidad?><br/>
        Direccion: <?=$pedido->direccion?><br/>

        <hr>
        <h3>Datos del pedido:</h3>
        Estado: <?=Utils::showStatus($pedido->estado)?><br>
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
