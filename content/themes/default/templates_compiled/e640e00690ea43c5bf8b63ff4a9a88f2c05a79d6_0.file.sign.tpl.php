<?php
/* Smarty version 3.1.40, created on 2024-11-25 17:36:13
  from 'C:\xampp\htdocs\casper\Inventario-Autorepuestos\content\themes\default\templates\sign.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6744b58d1c5736_23343241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e640e00690ea43c5bf8b63ff4a9a88f2c05a79d6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\content\\themes\\default\\templates\\sign.tpl',
      1 => 1709126301,
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
function content_6744b58d1c5736_23343241 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12 m6 z-depth-3">
			<h2>Iniciar Sesión</h2>
			<form class="js_form" data-url="core/signin.php">
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
