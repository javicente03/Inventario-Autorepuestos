<?php
    // Incluimos el encabezado de la página
    include_once 'views/header/head.php';
    include_once 'views/header/header.php';
?>

<div class="container">
	<div class="row container-center" style="display:block;">
		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Top 10 Más Vendidos</h2>

			<ul class="collection">
                <?php
                    if($mas_vendidos){
                        foreach($mas_vendidos as $row){
                ?>
					    <li class="collection-item avatar">
					    
                            <img src="<?php echo SYS_URL; ?>/content/uploads/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="circle">
                            <span class="title"><?php echo $row['product_name']; ?></span>
                            <p>Vendidas: <?php echo $row['suma']; ?> unidades<br>
                                Categoría: <?php echo $row['category_name']; ?>
                            </p>
                            <a href="<?php echo SYS_URL; ?>/products/detail/<?php echo $row['product_id']; ?>" class="secondary-content tooltipped" data-position="bottom" data-tooltip="Ver Histórico"><i class="material-icons">visibility</i></a>
                        </li>
                <?php
                    }
                }else{
                ?>
			    	<li class="collection-item">Aún no hay data</li>
                <?php
                    }
                ?>
			  </ul>
		</div>
		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Top 5 Proveedores constantes</h2>

			<ul class="collection">
                <?php
                    if($proveedores_constantes){
                        foreach($proveedores_constantes as $row){
                ?>
					    <li class="collection-item avatar">
					      <i class="material-icons circle">local_shipping</i>
                            <span class="title"><?php echo $row['provider_name']; ?></span>
                            <p>Compras realizadas: <?php echo $row['count']; ?><br>
                                <?php echo $row['provider_contact']; ?>
					      </p>
					    </li>
                <?php
                    }
                }else{
                ?>
			    	<li class="collection-item">Aún no hay data</li>
                <?php
                    }
                ?>
			  </ul>
		</div>

		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Productos con stock menor a 5</h2>

			<ul class="collection">
                <?php
                    if($productos_poco_stock){
                        foreach($productos_poco_stock as $row){
                ?>
					    <li class="collection-item avatar">
                            <img src="<?php echo SYS_URL; ?>/content/uploads/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="circle">
                            <span class="title"><?php echo $row['product_name']; ?></span>
                            <p>Stock: <span class="danger"><?php echo $row['product_quantity']; ?> unidades</span><br>
					      </p>
                          <a href="<?php echo SYS_URL; ?>/products/detail/<?php echo $row['product_id']; ?>" class="secondary-content tooltipped" data-position="bottom" data-tooltip="Ver Histórico"><i class="material-icons">visibility</i></a>
                        </li>
                <?php
                    }
                }else{
                ?>
			    	<li class="collection-item">No hay productos con bajo stock</li>
                <?php
                    }
                ?>
			  </ul>
		</div>
	</div>
</div>

<?php
    // Incluimos el pie de página
    include_once 'views/footer/footer.php';
?>