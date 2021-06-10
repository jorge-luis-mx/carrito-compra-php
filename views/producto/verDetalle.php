<?php if(isset($resultDetalleproduct)):?>
    <h1><?=$resultDetalleproduct->nombre?></h1>
    <div id="detail-product">
        <div class="image">
            <?php if($resultDetalleproduct->imagen != null) :?>
                <img src="<?=base_url?>upload/images/<?=$resultDetalleproduct->imagen?>" alt="">
            <?php  else: ?>
                <img src="<?=base_url?>assets/img/camiseta.png" alt="">
            <?php endif; ?>
        </div>
        <div class="data">
            <p class="description"><?=$resultDetalleproduct->descripcion?></p>
            <p class="price">$ <?=$resultDetalleproduct->precio?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$resultDetalleproduct->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
        <h1>El producto no existe</h1>
<?php endif; ?>