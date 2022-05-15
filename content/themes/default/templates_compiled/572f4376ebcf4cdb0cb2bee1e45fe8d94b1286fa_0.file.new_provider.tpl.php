<?php
/* Smarty version 3.1.40, created on 2022-05-14 23:04:01
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\new_provider.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62803561a7ad25_60995474',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '572f4376ebcf4cdb0cb2bee1e45fe8d94b1286fa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\new_provider.tpl',
      1 => 1652569439,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62803561a7ad25_60995474 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/providers/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Registrar Proveedor</h2>
			<form class="js_form" data-url="core/providers.php?do=new">
				<div class="row">
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">local_shipping</i>
						<input type="text" name="name" id="name">
						<label for="name">Nombre</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">location_on</i>
						<input type="text" name="ubication" id="ubication">
						<label for="ubication">Ubicación</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">contact_phone</i>
						<input type="text" name="contact" id="contact">
						<label for="contact">Contacto</label>
					</div>
					
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form><?php }
}
