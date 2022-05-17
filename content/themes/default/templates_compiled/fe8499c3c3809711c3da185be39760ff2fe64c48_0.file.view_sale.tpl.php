<?php
/* Smarty version 3.1.40, created on 2022-05-16 16:14:23
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\view_sale.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6282785fe63bb9_22589096',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe8499c3c3809711c3da185be39760ff2fe64c48' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\view_sale.tpl',
      1 => 1652717662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6282785fe63bb9_22589096 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Compra #<?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_id'];?>
</h2>

<div class="row plantilla">
	<div class="col s12 m4">
		<h6>Detalle de la fatura</h6>
	</div>
	<div class="col s12 m4">
		<h6>Cliente: <?php echo $_smarty_tpl->tpl_vars['sale']->value['client_name'];?>
</h6>
	</div>
	<div class="col s12 m4">
		<h6>Fecha: <?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_date'];?>
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
			<tr id="tr<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_detail_id'];?>
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
			<td class="td-total"><?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_amount_bs'];?>
 Bs (Para ese momento)</td>
			<td class="td-total">$<?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_amount'];?>
</td>
		</tr>
	<?php }?>
	</tbody>
</table><?php }
}
