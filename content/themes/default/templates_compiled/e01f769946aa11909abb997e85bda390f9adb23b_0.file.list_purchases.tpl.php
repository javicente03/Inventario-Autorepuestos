<?php
/* Smarty version 3.1.40, created on 2022-05-15 12:43:43
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\list_purchases.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280f57f3f6721_22038535',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e01f769946aa11909abb997e85bda390f9adb23b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\list_purchases.tpl',
      1 => 1652618621,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6280f57f3f6721_22038535 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Lista de Compras

<?php if ((isset($_smarty_tpl->tpl_vars['get']->value['type']))) {?>
	<?php if ($_smarty_tpl->tpl_vars['get']->value['type'] == 'status' && $_smarty_tpl->tpl_vars['get']->value['page'] == 0) {?>
		Pendientes
	<?php } elseif ($_smarty_tpl->tpl_vars['get']->value['type'] == 'status' && $_smarty_tpl->tpl_vars['get']->value['page'] == 1) {?>
		Completadas
	<?php }
}?>
</h2>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/new" class="btn indigo darken-4"><i class="material-icons left">add_shopping_cart</i>Nueva Factura</a>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/list/0/status/" class="btn indigo darken-4">Pendientes</a>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/list/1/status/" class="btn indigo darken-4">Completadas</a>

<table class="table centered" id="datatable">
	<thead>
		<th>Fecha</th>
		<th>Proveedor</th>
		<th>Monto $</th>
		<th>Monto Bs</th>
		<th>Método de Pago</th>
		<th>Número de Factura</th>
		<th>Registrado por</th>
		<th>Ver detalle /editar</th>
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
					<td>

						<?php if ($_smarty_tpl->tpl_vars['row']->value['purchase_status']) {?>
							<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_date'];?>

						<?php } else { ?>
							Pendiente
						<?php }?>
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_name'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_amount'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_amount_bs'];?>
 Bs</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_method'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_invoice'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['user_name'];?>
</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['row']->value['purchase_status']) {?>
						<a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_id'];?>
"><i class="material-icons">visibility</i></a>
						<?php } else { ?>
						<a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_id'];?>
"><i class="material-icons">edit</i></a>
						<?php }?>
					</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
			<tr>
			    <td colspan="9" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		<?php }?>
	</tbody>
</table>
<?php }
}
