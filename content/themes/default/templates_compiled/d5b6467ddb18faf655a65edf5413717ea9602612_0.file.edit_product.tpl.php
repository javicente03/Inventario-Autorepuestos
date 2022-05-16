<?php
/* Smarty version 3.1.40, created on 2022-05-16 05:29:13
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\edit_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6281e129aa70e7_76237456',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5b6467ddb18faf655a65edf5413717ea9602612' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\edit_product.tpl',
      1 => 1652678951,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_form_image.tpl' => 1,
  ),
),false)) {
function content_6281e129aa70e7_76237456 (Smarty_Internal_Template $_smarty_tpl) {
?><div style="display:flex;justify-content:space-between;">
	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>

	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/products/detail/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
" class="btn indigo darken-4"><i class="material-icons left">visibility</i>Histórico</a>
</div>

<h2>Modificar Producto</h2>
			<form class="js_form" data-url="core/products.php?do=edit&id=<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
">
				<div class="row">
					<div class="input-field col s12 m6">
						<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_name'];?>
">
						<label for="name">Nombre (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="marca" id="marca" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_marca'];?>
">
						<label for="marca">Marca (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price" id="price" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_price'];?>
">
						<label for="price">Precio Proveedor (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price_sale" id="price_sale" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_price_sale'];?>
">
						<label for="price">Precio Venta (*)</label>
					</div>
					<div class="input-field col s12">
						<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
							<select name="category" id="category">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
									<option <?php if ($_smarty_tpl->tpl_vars['row']->value['category_id'] == $_smarty_tpl->tpl_vars['product']->value['product_category']) {?>
												selected
											<?php }?>
									 value="<?php echo $_smarty_tpl->tpl_vars['row']->value['category_id'];?>
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
						<img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_image'];?>
" class="responsive-img product_image">
					</div>
					<div class="input-field col s12 m6">
						<div class="container-uploader" data-id="photo-product">
						<?php $_smarty_tpl->_subTemplateRender("file:_form_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
						</div>
					</div>
					<div class="input-field col s12">
						<textarea name="description" class="materialize-textarea" placeholder="Descripción, no debes exceder los 500 caracteres"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_description'];?>
</textarea>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form><?php }
}
