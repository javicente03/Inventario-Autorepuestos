<?php
/* Smarty version 3.1.40, created on 2022-05-14 18:14:07
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\install.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_627ff16fa01757_66143615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80e00bd1a23e29e08fc7cdaaa6c90e9d9be4f2dc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\install.tpl',
      1 => 1652551692,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_627ff16fa01757_66143615 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12 m6 z-depth-3">
			<h2>Instalación</h2>
			<span>Registra un usuario</span>
			<form class="js_form" data-url="core/install.php">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="username" id="username">
						<label for="username">Ingrese su usuario</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input type="password" name="password" id="password">
						<label for="password">Ingrese su Contraseña</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="firstname" id="firstname">
						<label for="firstname">Ingrese su nombre</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="lastname" id="lastname">
						<label for="lastname">Ingrese su apellido</label>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Ingresar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
