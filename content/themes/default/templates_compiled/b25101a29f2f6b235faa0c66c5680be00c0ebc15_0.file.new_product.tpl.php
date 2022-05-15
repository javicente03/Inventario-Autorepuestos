<?php
/* Smarty version 3.1.40, created on 2022-05-14 21:33:16
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\new_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6280201c770880_37277381',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b25101a29f2f6b235faa0c66c5680be00c0ebc15' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\new_product.tpl',
      1 => 1652563994,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_form_image.tpl' => 1,
  ),
),false)) {
function content_6280201c770880_37277381 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Registrar Producto</h2>
			<form class="js_form" data-url="core/products.php?do=new">
				<div class="row">
					<div class="input-field col s12 m6">
						<input type="text" name="name" id="name">
						<label for="name">Nombre (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="marca" id="marca">
						<label for="marca">Marca (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="price" id="price">
						<label for="price">Precio (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" name="quantity" id="quantity">
						<label for="quantity">Cantidad Existente (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
							<select name="category" id="category">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['category_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</option>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
						<?php }?>
						<label for="quantity">Categoría (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<div class="container-uploader" data-id="photo-product">
						<?php $_smarty_tpl->_subTemplateRender("file:_form_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
						</div>
					</div>
					<div class="input-field col s12">
						<textarea name="description" class="materialize-textarea" placeholder="Descripción, no debes exceder los 500 caracteres"></textarea>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form><?php }
}
