<?php
/* Smarty version 3.1.40, created on 2022-05-14 22:59:45
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\404.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_628034611a6e64_34130342',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47ef64148cb27552f8e6b982409d2900feb5dbb9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\404.tpl',
      1 => 1652569183,
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
function content_628034611a6e64_34130342 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12 m6 z-depth-3">
			<h2>404 Page Not Found :(</h2>
			<span style="text-align:center;display:block;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
		</div>
	</div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
