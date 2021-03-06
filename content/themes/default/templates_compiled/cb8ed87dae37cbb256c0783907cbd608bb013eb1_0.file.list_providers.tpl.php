<?php
/* Smarty version 3.1.40, created on 2022-05-16 06:12:56
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\list_providers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6281eb68256779_76174394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb8ed87dae37cbb256c0783907cbd608bb013eb1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\list_providers.tpl',
      1 => 1652681574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6281eb68256779_76174394 (Smarty_Internal_Template $_smarty_tpl) {
?><h2 <?php if ($_smarty_tpl->tpl_vars['providers']->value) {?>class="title-table"<?php }?>>Lista de Proveedores</h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/new" class="btn indigo darken-4"><i class="material-icons left">local_shipping</i>Registrar</a>

<table class="table centered striped" id="datatable">
	<thead>
		<th>Nombre</th>
		<th>Ubicación</th>
		<th>Contácto</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</thead>
	<tbody>
		<?php if ($_smarty_tpl->tpl_vars['providers']->value) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['providers']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_ubication'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_contact'];?>
</td>
					<td><a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['provider_id'];?>
"><i class="material-icons">edit</i></a></td>
					<td>
						<button class="js_button btn red" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['provider_id'];?>
" data-url="core/providers.php?do=delete&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['provider_id'];?>
"><i class="material-icons">delete</i></button>
					</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
			<tr>
			    <td colspan="5" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		<?php }?>
	</tbody>
</table>
<?php }
}
