<?php if(isset($categoria)):?>
    <h1><?=$categoria->nombre?></h1>

        <!--PREGUNTAMOS SI PRODUCTOS ES IGUAL cero(0) filas Y IMPRE MENSAJE-->
        <?php if($productos->num_rows == 0):?>
            <p>No hay productos para mostrar</p>
            <!--PREGUNTAMOS SI  no fue asi-->
            <?php else: ?>
            <?php  while ($product = $productos->fetch_object()): ?>
                <div class="product">
                    <a href="<?=base_url?>producto/verDetalleProduct&id=<?=$product->id?>">
                        <?php if($product->imagen != null) :?>
                            <img src="<?=base_url?>upload/images/<?=$product->imagen?>" alt="">
                        <?php  else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png" alt="">
                        <?php endif; ?>
                        <h2><?=$product->nombre?></h2>
                    </a>
                    <p><?=$product->precio?></p>
                    <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <!--fin-->

    <?php else: ?>
        <h1>la categoria no existe</h1>
<?php endif; ?>