<?php
/* Smarty version 3.1.40, created on 2022-05-14 20:49:20
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\_footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_628015d00d9f68_96113000',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c64c9eddc49f9b40dd20b536198dc966c488f24b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\_footer.tpl',
      1 => 1652561357,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_js_files.tpl' => 1,
  ),
),false)) {
function content_628015d00d9f68_96113000 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_js_files.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/js/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/js/materialize.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/js/elements.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/js/datatables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/js/core.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/js/user.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
