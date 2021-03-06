<?php
/* Smarty version 3.1.40, created on 2022-05-16 00:51:46
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\list_categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6281a022155c27_66388410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a829160e3c315a9e4a5af647bd867a31ca7edbb8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\list_categories.tpl',
      1 => 1652662094,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6281a022155c27_66388410 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Lista de Categorías</h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/categories/new" class="btn indigo darken-4"><i class="material-icons left">local_shipping</i>Registrar</a>

<table class="table centered striped" id="table">
	<thead>
		<th>Nombre</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</thead>
	<tbody>
		<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</td>
					<td><a class="btn btn-flat" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/categories/detail/<?php echo $_smarty_tpl->tpl_vars['row']->value['category_id'];?>
"><i class="material-icons">edit</i></a></td>
					<td>
						<button class="js_button btn red" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['category_id'];?>
" data-url="core/categories.php?do=delete&id=<?php echo $_smarty_tpl->tpl_vars['row']->value['category_id'];?>
"><i class="material-icons">delete</i></button>
					</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } else { ?>
			<tr>
			    <td colspan="3" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		<?php }?>
	</tbody>
</table>
<?php }
}
