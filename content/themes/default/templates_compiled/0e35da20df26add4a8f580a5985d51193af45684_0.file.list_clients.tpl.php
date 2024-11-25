<?php
/* Smarty version 3.1.40, created on 2024-11-25 16:22:52
  from 'C:\xampp\htdocs\casper\Inventario-Autorepuestos\content\themes\default\templates\list_clients.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6744a45c796285_64783793',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e35da20df26add4a8f580a5985d51193af45684' => 
    array (
      0 => 'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\content\\themes\\default\\templates\\list_clients.tpl',
      1 => 1709126301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6744a45c796285_64783793 (Smarty_Internal_Template $_smarty_tpl) {
?><h2 <?php if ($_smarty_tpl->tpl_vars['clients']->value) {?>class="title-table"<?php }?>>Lista de Clientes</h2>

<table class="table centered striped" id="datatable">
	<thead>
		<th>Nombre</th>
		<th>Contácto</th>
	</thead>
	<tbody>
		<?php if ($_smarty_tpl->tpl_vars['clients']->value) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clients']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['client_name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['client_contact'];?>
</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
			<tr>
			    <td colspan="2" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		<?php }?>
	</tbody>
</table>
<?php }
}
