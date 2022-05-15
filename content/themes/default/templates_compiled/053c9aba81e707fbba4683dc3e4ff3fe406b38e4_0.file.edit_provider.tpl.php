<?php
/* Smarty version 3.1.40, created on 2022-05-14 22:48:03
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\edit_provider.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_628031a363df59_69834337',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '053c9aba81e707fbba4683dc3e4ff3fe406b38e4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\edit_provider.tpl',
      1 => 1652568480,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_628031a363df59_69834337 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Editar Proveedor
</h2>
			<form class="js_form" data-url="core/providers.php?do=edit&id=<?php echo $_smarty_tpl->tpl_vars['provider']->value['provider_id'];?>
">
				<div class="row">
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">local_shipping</i>
						<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['provider']->value['provider_name'];?>
">
						<label for="name">Nombre</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">location_on</i>
						<input type="text" name="ubication" id="ubication" value="<?php echo $_smarty_tpl->tpl_vars['provider']->value['provider_ubication'];?>
">
						<label for="ubication">Ubicación</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">contact_phone</i>
						<input type="text" name="contact" id="contact" value="<?php echo $_smarty_tpl->tpl_vars['provider']->value['provider_contact'];?>
">
						<label for="contact">Contacto</label>
					</div>
					
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form><?php }
}
