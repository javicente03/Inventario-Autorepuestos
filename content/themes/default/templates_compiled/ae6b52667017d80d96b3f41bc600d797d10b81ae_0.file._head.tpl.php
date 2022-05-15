<?php
/* Smarty version 3.1.40, created on 2022-05-14 20:46:34
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\_head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280152a556a44_52566882',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae6b52667017d80d96b3f41bc600d797d10b81ae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\_head.tpl',
      1 => 1652561192,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6280152a556a44_52566882 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\Casper\\includes\\libs\\Smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
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

    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/css/datatables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            /*background-image: url(<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/includes/assets/img/logo-n.png);*/
            /*background-size: 400px;*/
            /*background-repeat: no-repeat;*/
        }
    </style>
</head>
<body><?php }
}
