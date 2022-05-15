<?php
/* Smarty version 3.1.40, created on 2022-05-14 20:47:03
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280154755d717_84873165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b97c87e72a4e543e7d4462500d140b48c5937f74' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\products.tpl',
      1 => 1652561221,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:list_products.tpl' => 1,
    'file:new_product.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_6280154755d717_84873165 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			<?php if ($_smarty_tpl->tpl_vars['view']->value == "list") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:list_products.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "new") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:new_product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php }?>
		</div>
	</div>
</div>


<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
