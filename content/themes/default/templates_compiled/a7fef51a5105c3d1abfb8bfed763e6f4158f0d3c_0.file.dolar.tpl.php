<?php
/* Smarty version 3.1.40, created on 2024-11-25 16:23:58
  from 'C:\xampp\htdocs\casper\Inventario-Autorepuestos\content\themes\default\templates\dolar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6744a49e52c823_61482777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7fef51a5105c3d1abfb8bfed763e6f4158f0d3c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\content\\themes\\default\\templates\\dolar.tpl',
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
function content_6744a49e52c823_61482777 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container section">
	<div class="row container-center">
		<form class="js_form" data-url="core/options.php?do=dolar">
			<div class="row">
				<h4>Modifique la tasa del día</h4>
				<div class="input-field col s10">
					<input type="number" name="dolar" value="<?php echo $_smarty_tpl->tpl_vars['tasa']->value;?>
" step="0.01" style="text-align:center;font-weight:bold;">
				</div>
				<div class="input-field col s2"><h6>Bs</h6></div>

				<div class="input-field col s12">
					<button class="btn-op">Guardar</button>
				</div>	
			</div>		
		</form>
	</div>
</div>


<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
