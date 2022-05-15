<?php
/* Smarty version 3.1.40, created on 2022-05-14 23:14:13
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\new_category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_628037c52e6b12_09705798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6397da1e14e9a872b3020b5341b60b92e10708ad' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\new_category.tpl',
      1 => 1652570051,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_628037c52e6b12_09705798 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/categories/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Registrar Categoría</h2>
			<form class="js_form" data-url="core/categories.php?do=new">
				<div class="row">
					<div class="input-field col s6">
						<input type="text" name="name" id="name">
						<label for="name">Nombre</label>
					</div>
					
					<div class="input-field col s6 center">
						<button type="submit" class="btn-op">Agregar Categoría</button>
					</div>
				</div>
			</form><?php }
}
