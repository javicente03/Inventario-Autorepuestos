<?php
/* Smarty version 3.1.40, created on 2022-05-16 05:30:13
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\detail_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6281e165271cf1_62437125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d3bd11fe3efb4dfdcf8f20ab4733e42d492133c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\detail_product.tpl',
      1 => 1652679009,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6281e165271cf1_62437125 (Smarty_Internal_Template $_smarty_tpl) {
?><div style="display:flex;justify-content:space-between;margin-bottom:10px;">
	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>

	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/edit/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
" class="btn indigo darken-4"><i class="material-icons left">edit</i>Editar</a>
</div>
<div class="row plantilla">
	<div class="col s12 m8 center title-plantilla">
		<h4><?php echo $_smarty_tpl->tpl_vars['product']->value['product_name'];?>
</h4>
	</div>
	<div class="col s12 m4 center">
		<img class="responsive-img product_image" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_image'];?>
">
	</div>
	<div class="col s12 m6 center">
		<h6>Stock Actual: <?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity'];?>
</h6>
	</div>
	<div class="col s12 m6 center">
		<h6>Marca: <?php echo $_smarty_tpl->tpl_vars['product']->value['product_marca'];?>
</h6>
	</div>
	<div class="col s12 m4 center">
		<h6><?php echo $_smarty_tpl->tpl_vars['product']->value['product_name'];?>
</h6>
	</div>
	<div class="col s12 m8 center">
		<h6>Categoría: <?php echo $_smarty_tpl->tpl_vars['product']->value['category_name'];?>
</h6>
	</div>
	<div class="col s12 m8 center">
		<h6>Precio Proveedor: $<?php echo $_smarty_tpl->tpl_vars['product']->value['product_price'];?>
</h6>
	</div>
	<div class="col s12 m4 center">
		<h6>Bs: <?php echo $_smarty_tpl->tpl_vars['product']->value['product_price_bs'];?>
</h6>
	</div>
	<div class="col s12 m8 center">
		<h6>Precio Venta: $<?php echo $_smarty_tpl->tpl_vars['product']->value['product_price_sale'];?>
</h6>
	</div>
	<div class="col s12 m4 center">
		<h6>Bs: <?php echo $_smarty_tpl->tpl_vars['product']->value['product_price_sale_bs'];?>
</h6>
	</div>
	<div class="col s12 m6 center">
		<h6>Compras Realizadas: <?php echo $_smarty_tpl->tpl_vars['conts']->value['purchases_count'];?>
</h6>
	</div>
	<div class="col s12 m6 center">
		<h6>Ventas Terminadas: <?php echo $_smarty_tpl->tpl_vars['conts']->value['sales_count'];?>
</h6>
	</div>
	<div class="col s12 center">
		<span><?php echo $_smarty_tpl->tpl_vars['product']->value['product_description'];?>
</span>
	</div>
</div>

<h6 class="title-table"><b>Histórico de compras</b></h6>

<table class="datatable table centered striped">
	<thead>
		<th>Fecha</th>
		<th>Factura #</th>
		<th>Precio</th>
		<th>Precio Bs (Para ese momento)</th>
		<th>Unidades</th>
		<th>Sub total</th>
		<th>Proveedor</th>
		<th>Ver factura</th>
	</thead>
	<tbody>
		<?php if ($_smarty_tpl->tpl_vars['purchases']->value) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['purchases']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_date'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_id'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit_bs'];?>
 Bs</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_quantity'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_sub_total'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_name'];?>
</td>
					<td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_id'];?>
" class="btn btn-flat"><i class="material-icons">visibility</i></a></td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
		<?php }?>
	</tbody>
</table>


<h6 class="title-table"><b>Histórico de ventas</b></h6>

<table class="datatable table centered striped">
	<thead>
		<th>Fecha</th>
		<th>Factura #</th>
		<th>Precio</th>
		<th>Precio Bs (Para ese momento)</th>
		<th>Unidades</th>
		<th>Sub total</th>
		<th>Cliente</th>
		<th>Ver factura</th>
	</thead>
	<tbody>
		<?php if ($_smarty_tpl->tpl_vars['sales']->value) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sales']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['sale_date'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['sale_id'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit_bs'];?>
 Bs</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_quantity'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_sub_total'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['client_name'];?>
</td>
					<td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_id'];?>
" class="btn btn-flat"><i class="material-icons">visibility</i></a></td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
		<?php }?>
	</tbody>
</table><?php }
}
