<?php
/* Smarty version 3.1.40, created on 2022-05-14 23:28:53
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\edit_category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62803b355a7da1_52156359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55c8ed489b1a20a9932c1215920a7650feb567d3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\edit_category.tpl',
      1 => 1652570931,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62803b355a7da1_52156359 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/categories/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Registrar Categoría</h2>
			<form class="js_form" data-url="core/categories.php?do=edit&id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
">
				<div class="row">
					<div class="input-field col s6">
						<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
">
						<label for="name">Nombre</label>
					</div>
					
					<div class="input-field col s6 center">
						<button type="submit" class="btn-op">Agregar Categoría</button>
					</div>
				</div>
			</form><?php }
}
