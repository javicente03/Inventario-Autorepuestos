<?php
/* Smarty version 3.1.40, created on 2024-11-25 16:22:52
  from 'C:\xampp\htdocs\casper\Inventario-Autorepuestos\content\themes\default\templates\_head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6744a45c40cbd9_76049326',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '446c83741281ffd577ce0231b5f3b520bf344380' => 
    array (
      0 => 'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\content\\themes\\default\\templates\\_head.tpl',
      1 => 1709126301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6744a45c40cbd9_76049326 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\casper\\Inventario-Autorepuestos\\includes\\libs\\Smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<!doctype html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Sngine">

    <!-- Title -->
    <title><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['page_title']->value,70);?>
</title>
    <!-- Title -->

    <!-- Meta -->
    <meta name="description" content="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['page_description']->value,300);?>
">
    <!-- Twitter-Meta -->
    <link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/img/icon.png">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/css/datatables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            background-image: url(<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/img/logo-n.png);
            background-size: 300px;
            background-repeat: no-repeat;
            background-position-x: -50px;
        }
    </style>
</head>
<body><?php }
}
