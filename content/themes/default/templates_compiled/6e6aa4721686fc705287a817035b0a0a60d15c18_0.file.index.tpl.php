<?php
/* Smarty version 3.1.40, created on 2022-05-16 15:49:28
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62827288d3f363_34369052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e6aa4721686fc705287a817035b0a0a60d15c18' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\index.tpl',
      1 => 1652716166,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_62827288d3f363_34369052 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center" style="display:block;">
		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Top 10 Más Vendidos</h2>

			<ul class="collection">
				<?php if ($_smarty_tpl->tpl_vars['mas_vendidos']->value) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mas_vendidos']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
					    <li class="collection-item avatar">
					      <img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
" class="circle">
					      <span class="title"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</span>
					      <p>Vendidas: <?php echo $_smarty_tpl->tpl_vars['row']->value['suma'];?>
 unidades<br>
					      	Categoría: <?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>

					      </p>
					      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
" class="secondary-content tooltipped" data-position="bottom" data-tooltip="Ver Histórico"><i class="material-icons">visibility</i></a>
					    </li>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			    <?php } else { ?>
			    	<li class="collection-item">Aún no hay data</li>
			    <?php }?>
			  </ul>
		</div>
		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Top 5 Proveedores constantes</h2>

			<ul class="collection">
				<?php if ($_smarty_tpl->tpl_vars['proveedores_constantes']->value) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['proveedores_constantes']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
					    <li class="collection-item avatar">
					      <i class="material-icons circle">local_shipping</i>
					      <span class="title"><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_name'];?>
</span>
					      <p>Compras realizadas: <?php echo $_smarty_tpl->tpl_vars['row']->value['count'];?>
<br>
					         <?php echo $_smarty_tpl->tpl_vars['row']->value['provider_contact'];?>

					      </p>
					    </li>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			    <?php } else { ?>
			    	<li class="collection-item">Aún no hay data</li>
			    <?php }?>
			  </ul>
		</div>

		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Productos con stock menor a 5</h2>

			<ul class="collection">
				<?php if ($_smarty_tpl->tpl_vars['productos_poco_stock']->value) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productos_poco_stock']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
					    <li class="collection-item avatar">
					      <img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
" class="circle">
					      <span class="title"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</span>
					      <p>Stock: <span class="danger"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_quantity'];?>
 unidades</span><br>
					      </p>
					      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
" class="secondary-content tooltipped" data-position="bottom" data-tooltip="Ver Histórico"><i class="material-icons">visibility</i></a>
					    </li>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			    <?php } else { ?>
			    	<li class="collection-item">No hay productos con bajo stock</li>
			    <?php }?>
			  </ul>
		</div>
	</div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
