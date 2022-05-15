<?php
/* Smarty version 3.1.40, created on 2022-05-14 23:11:39
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280372b220ec5_58404077',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94937f5ca62a5a4c9cd84b722d1bbab49133edb7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\categories.tpl',
      1 => 1652569797,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:list_categories.tpl' => 1,
    'file:new_category.tpl' => 1,
    'file:edit_category.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_6280372b220ec5_58404077 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			<?php if ($_smarty_tpl->tpl_vars['view']->value == "list") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:list_categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "new") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:new_category.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "detail") {?>
				<?php $_smarty_tpl->_subTemplateRender("file:edit_category.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php }?>
		</div>
	</div>
</div>


<?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
