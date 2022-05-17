<?php
/* Smarty version 3.1.40, created on 2022-05-16 16:14:35
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\view_purchase.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6282786b98b8f6_05057675',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d5d78f063b13df4ab548733655f35a8015ca72a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\view_purchase.tpl',
      1 => 1652717527,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6282786b98b8f6_05057675 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Compra #<?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_id'];?>
</h2>

<div class="row plantilla">
	<div class="col s12 m4">
		<h6>Detalle de la fatura</h6>
	</div>
	<div class="col s12 m4">
		<h6>Proveedor: <?php echo $_smarty_tpl->tpl_vars['purchase']->value['provider_name'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/detail/<?php echo $_smarty_tpl->tpl_vars['purchase']->value['provider_id'];?>
" class="btn btn-flat"><i class="material-icons">visibility</i></a></h6>
	</div>
	<div class="col s12 m4">
		<h6>Fecha: <?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_date'];?>
</h6>
	</div>
</div>


<table class="table centered striped" id="detail">
	<thead>	
		<th>Producto</th>
		<th>Precio</th>
		<th>Precio Bs (Para ese momento)</th>
		<th>Cantidad</th>
		<th>Sub Total</th>
	</thead>
	<tbody id="tbody_purchase">
	<?php if ($_smarty_tpl->tpl_vars['details']->value) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['details']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
			<tr id="tr<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_detail_id'];?>
">
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</td>
				<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit_bs'];?>
 Bs</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_quantity'];?>
</td>
				<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_sub_total'];?>
</td>
			</tr>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<tr class="tr-total">
			<td colspan="2"></td>
			<td class="td-total">Total: </td>
			<td class="td-total"><?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_amount_bs'];?>
 Bs (Para ese momento)</td>
			<td class="td-total">$<?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_amount'];?>
</td>
		</tr>
	<?php }?>
	</tbody>
</table><?php }
}
