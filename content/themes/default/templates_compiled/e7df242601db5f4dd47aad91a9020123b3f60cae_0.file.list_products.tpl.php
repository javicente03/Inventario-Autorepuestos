<?php
/* Smarty version 3.1.40, created on 2022-05-14 21:55:59
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\list_products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280256fdefbf7_13346268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7df242601db5f4dd47aad91a9020123b3f60cae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\list_products.tpl',
      1 => 1652565357,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6280256fdefbf7_13346268 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Lista de Productos</h2>
<table class="table centered" id="table">
	<thead>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Descripción</th>
		<th>Precio $</th>
		<th>Precio Bs</th>
		<th>Imágen</th>
		<th>Cantidad</th>
		<th>Categoría</th>
		<th>Estatus</th>
		<th>Acción</th>
	</thead>
	<tbody>
		<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_marca'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_description'];?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_bs'];?>
 Bs</td>
					<td><img width="100px" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_image'];?>
"></td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_quantity'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['row']->value['product_status']) {?>
							Activo
						<?php } else { ?>
							Inactivo
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
