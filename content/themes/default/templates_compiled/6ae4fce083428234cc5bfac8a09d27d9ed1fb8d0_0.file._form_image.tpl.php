<?php
/* Smarty version 3.1.40, created on 2022-05-14 20:42:56
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\_form_image.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62801450d594e6_95770393',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ae4fce083428234cc5bfac8a09d27d9ed1fb8d0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\_form_image.tpl',
      1 => 1652560937,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62801450d594e6_95770393 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="x-uploader">  
	<input name="file" class="file_photo" type="file" accept=".jpg, .png, .gif">
    <label for="file_photo" class="label-file">Upload an image</label>

	<i class="material-icons js_x-uploader" data-handle="publisher" data-type="photo">photo</i>
    <progress value="0" max="100" class="progress_photo"></progress>
</div><?php }
}
