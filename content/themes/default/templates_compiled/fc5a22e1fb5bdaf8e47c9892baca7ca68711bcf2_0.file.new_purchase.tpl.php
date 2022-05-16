<?php
/* Smarty version 3.1.40, created on 2022-05-16 06:16:19
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\new_purchase.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6281ec3312cf40_89606034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc5a22e1fb5bdaf8e47c9892baca7ca68711bcf2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\new_purchase.tpl',
      1 => 1652681776,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_form_image.tpl' => 1,
  ),
),false)) {
function content_6281ec3312cf40_89606034 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/purchases/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Nueva Factura</h2>
			<form class="js_form" data-url="core/purchases.php?do=check&id=<?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_id'];?>
">
				<div class="row">
					<div class="input-field col s12 m4">
						<?php if ($_smarty_tpl->tpl_vars['providers']->value) {?>
							<select name="provider" id="provider">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['providers']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['provider_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['provider_name'];?>
</option>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
							<label for="name">Proveedor (*)</label>
						<?php } else { ?>
						<span>Debe registrar proveedores</span>
						<?php }?>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">date_range</i>
						<input type="date" name="date" id="date">
						<label for="date">Fecha del Pedido (*)</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">event_note</i>
						<input type="text" name="invoice" id="invoice">
						<label for="invoice">Número de Factura</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">payment</i>
						<input type="text" name="method" id="method">
						<label for="method">Método de Pago</label>
					</div>
					<div class="input-field col s12 m4">
						<a class="waves-effect waves-light btn indigo darken-4 modal-trigger" href="#modal1">
						<i class="material-icons left">shopping_cart</i>Añadir al carrito</a>
					</div>
					
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Facturar</button>
					</div>
				</div>
			</form>

<h6>Detalles de la factura</h6>
<table class="table centered striped" id="detail">
	<thead>	
		<th>Producto</th>
		<th>Precio</th>
		<th>Cantidad</th>
		<th>Sub Total</th>
		<th>Descartar</th>
	</thead>
	<tbody id="tbody_purchase">
	<?php if ($_smarty_tpl->tpl_vars['details']->value) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['details']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
			<tr id="tr<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_detail_id'];?>
">
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</td>
				<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_quantity'];?>
</td>
				<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_sub_total'];?>
</td>
				<td><button class="btn btn-flat js_button" data-url="core/purchases.php?do=desc&purchase=<?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['purchase_detail_id'];?>
"><i class='material-icons'>close<i></button></td>
			</tr>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
	</tbody>
</table>
<div class="div-total-balance">
	<h6 class="total-balance">Total: $<span id="total_balance"><?php echo $_smarty_tpl->tpl_vars['sum_details']->value['balance'];?>
</span></h6>
</div>

  <!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
      <div style="display:flex;justify-content:space-between;">
      	<h4>Agregar Producto</h4>
	      <button data-target="modal2" class="btn bt-flat modal-trigger"><i class="material-icons left">search</i></button>
      </div>
      <form class="js_form" id="form_product" data-url="core/products.php?do=new&purchase=<?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_id'];?>
">
      	<div class="row">
	      	<div class="input-field col s12 m6">
						<input type="text" name="name" id="name" placeholder="Nombre (*)">
						
					</div>
	      			<div class="input-field col s12 m6" id="cont-marca">
						<input type="text" name="marca" id="marca" placeholder="Marca (*)">
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price" id="price">
						<span>Precio Proveedor (*)</span>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price_sale" id="price_sale">
						<span>Precio Venta (*)</span>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" name="quantity" id="quantity">
						<span>Cantidad a Ingresar (*)</span>
					</div>
					<div class="input-field col s12 m6" id="cont-category">
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
							<label for="quantity">Categoría (*)</label>
						<?php } else { ?>
							<span>Debe cargar categorías</span>
						<?php }?>
					</div>
					<div class="input-field col s12 m6" id="cont-photo">
						<div class="container-uploader" data-id="photo-product">
						<?php $_smarty_tpl->_subTemplateRender("file:_form_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
						</div>
						<span id="span-image"></span>
					</div>
					<div class="input-field col s12" id="cont-description">
						<textarea name="description" id="description" class="materialize-textarea" placeholder="Descripción, no debes exceder los 500 caracteres"></textarea>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Añadir</button>
					</div>
					<input type="hidden" name="product_id_new" id="product_id_new">
	    </div>
      </form>
    </div>
  </div>

  <div id="modal2" class="modal">
    <div class="modal-content">
      <h6>Buscar Producto</h6>
      
    <table class="table centered striped" id="datatable">
	<thead>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Precio P. $</th>
		<th>Precio P. Bs</th>
		<th>Precio V. $</th>
		<th>Precio V. Bs</th>
		<th>Imágen</th>
		<th>Seleccionar</th>
	</thead>
		<tbody>
			<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_marca'];?>
</td>
						<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_bs'];?>
 Bs</td>
						<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_sale'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_sale_bs'];?>
 Bs</td>
						<td><img width="50px" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/content/uploads/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_image'];?>
"></td>

						<td><button class="btn btn-flat js_button_check modal-close"
						data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
"
						data-name="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
"
						data-price="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price'];?>
"
						data-price_bs="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_bs'];?>
"
						data-price_sale="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_sale'];?>
"
						data-price_sale_bs="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_price_sale_bs'];?>
"
						data-purchase_id="<?php echo $_smarty_tpl->tpl_vars['purchase']->value['purchase_id'];?>
"

						><i class="material-icons">check</i></button></td>

					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php } else { ?>
				<tr>
				    <td colspan="9" class="text-center">
			        "No hay data cargada"
			        </td>
			    </tr>
			<?php }?>
		</tbody>
	</table>
    </div>
  </div><?php }
}
