<?php
/* Smarty version 3.1.40, created on 2024-11-25 17:35:53
  from 'C:\xampp\htdocs\casper\Inventario-Autorepuestos\content\themes\default\templates\purchases.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6744b5799fb3d4_24328788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24e66080fa0f1edb7cde690a26b1c67c072d3c52' => 
    array (
      0 => 'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\content\\themes\\default\\templates\\purchases.tpl',
      1 => 1709126301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:list_purchases.tpl' => 1,
    'file:new_purchase.tpl' => 1,
    'file:view_purchase.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_6744b5799fb3d4_24328788 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			<?php if ($_smarty_tpl->tpl_vars['view']->value == "list") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:list_purchases.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "edit") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:new_purchase.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "detail") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:view_purchase.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php }?>
		</div>
	</div>
</div>


<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
