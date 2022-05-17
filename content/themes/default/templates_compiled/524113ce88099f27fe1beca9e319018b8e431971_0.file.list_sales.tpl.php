<?php
/* Smarty version 3.1.40, created on 2022-05-16 15:43:48
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\list_sales.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62827134c88e50_56363368',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '524113ce88099f27fe1beca9e319018b8e431971' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\list_sales.tpl',
      1 => 1652715825,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62827134c88e50_56363368 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Lista de Ventas

<?php if ((isset($_smarty_tpl->tpl_vars['get']->value['type']))) {?>
	<?php if ($_smarty_tpl->tpl_vars['get']->value['type'] == 'status' && $_smarty_tpl->tpl_vars['get']->value['page'] == 0) {?>
		Pendientes
	<?php } elseif ($_smarty_tpl->tpl_vars['get']->value['type'] == 'status' && $_smarty_tpl->tpl_vars['get']->value['page'] == 1) {?>
		Completadas
	<?php }
}?>
</h2>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/new" class="btn indigo darken-4"><i class="material-icons left">add_shopping_cart</i>Nueva Factura</a>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/list/0/status/" class="btn indigo darken-4">Pendientes</a>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/list/1/status/" class="btn indigo darken-4">Completadas</a>

<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/list/" class="btn indigo darken-4">Todas</a>


<table class="table centered striped" id="datatable">
	<thead>
		<th>Fecha</th>
		<th>Cliente</th>
		<th>Monto $</th>
		<th>Monto Bs</th>
		<th>Registrado por</th>
		<th>Ver detalle /editar</th>
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
					<td>

						<?php if ($_smarty_tpl->tpl_vars['row']->value['sale_status']) {?>
							<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_date'];?>

						<?php } else { ?>
							Pendiente
						<?php }?>
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['client_name'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_amount'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['sale_amount_bs'];?>
 Bs</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['user_name'];?>
</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['row']->value['sale_status']) {?>
						<a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_id'];?>
"><i class="material-icons">visibility</i></a>
						<?php } else { ?>
						<a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_id'];?>
"><i class="material-icons">edit</i></a>
						<button class="btn btn-flat js_button" data-url="core/sales.php?do=delete" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_id'];?>
"><i class="material-icons">delete</i></button>
						<?php }?>
					</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
			<tr>
			    <td colspan="6" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		<?php }?>
	</tbody>
</table>
<?php }
}
