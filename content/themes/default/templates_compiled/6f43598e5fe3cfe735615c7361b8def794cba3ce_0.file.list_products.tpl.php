<?php
/* Smarty version 3.1.40, created on 2024-11-25 17:08:21
  from 'C:\xampp\htdocs\casper\Inventario-Autorepuestos\content\themes\default\templates\list_products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6744af0510c983_79838193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f43598e5fe3cfe735615c7361b8def794cba3ce' => 
    array (
      0 => 'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\content\\themes\\default\\templates\\list_products.tpl',
      1 => 1709126301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6744af0510c983_79838193 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\includes\\libs\\Smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<h2 <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>class="title-table"<?php }?>>Lista de Productos</h2>
<table class="table centered striped" id="datatable">
	<thead>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Descripción</th>
		<th>Precio Prov. $</th>
		<th>Precio Prov. Bs</th>
		<th>Precio Vent. $</th>
		<th>Precio Vent. Bs</th>
		<th>Imágen</th>
		<th>Cantidad Actual</th>
		<th>Editar</th>
		<th>Histórico</th>
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
					<td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['row']->value['product_description'],120);?>
</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_bs'];?>
 Bs</td>
					<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_sale'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_sale_bs'];?>
 Bs</td>
					<td><img width="100px" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_image'];?>
"></td>
					<td><span <?php if ($_smarty_tpl->tpl_vars['row']->value['product_quantity'] < 5) {?> class="danger" <?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['product_quantity'];?>
<span></td>
					<td><a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
"><i class="material-icons">edit</i></a></td>
					<td><a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
"><i class="material-icons">visibility</i></a></td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
			<tr>
			    <td colspan="12" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		<?php }?>
	</tbody>
</table>
<?php }
}
