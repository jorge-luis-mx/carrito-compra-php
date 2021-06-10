<h1>Gestion de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">
    Nuevo productos
</a>
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">El producto se a creado correctamente</strong>
    <?php elseif(isset($_SESSION['producto']) &&  $_SESSION['producto'] !='complete'):?>
    <strong class="alert_red">EL producto no se a creado</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
<!--session de eliminado-->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">El producto se a borrado correctamente</strong>
    <?php elseif(isset($_SESSION['delete']) &&  $_SESSION['delete'] !='complete'):?>
    <strong class="alert_red">EL producto no se a borrado</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>descripcion</th>
        <th>precio</th>
        <th>stock</th>
        <th>Accion</th>
    </tr>
    <?php while($pro = $productos->fetch_object()):?>
        <tr>
            <td><?=$pro->id;?></td>
            <td><?=$pro->nombre;?></td>
            <td><?=$pro->descripcion;?></td>
            <td><?=$pro->precio;?></td>
            <td><?=$pro->stock;?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
<?php endwhile; ?>
</table>