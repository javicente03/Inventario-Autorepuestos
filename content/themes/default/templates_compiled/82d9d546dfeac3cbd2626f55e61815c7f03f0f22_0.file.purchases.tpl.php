<?php
/* Smarty version 3.1.40, created on 2022-05-15 11:55:32
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\purchases.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280ea345b7bc2_13750948',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82d9d546dfeac3cbd2626f55e61815c7f03f0f22' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\purchases.tpl',
      1 => 1652615729,
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
function content_6280ea345b7bc2_13750948 (Smarty_Internal_Template $_smarty_tpl) {
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
