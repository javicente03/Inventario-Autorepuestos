<?php
/* Smarty version 3.1.40, created on 2022-05-16 06:33:35
  from 'C:\xampp\htdocs\Casper\content\themes\default\templates\new_sale.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6281f03f73b074_93641484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08de86cef160e003173814122f5a8412284bc61b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Casper\\content\\themes\\default\\templates\\new_sale.tpl',
      1 => 1652682812,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6281f03f73b074_93641484 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>
<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/sales/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Nueva Factura</h2>
			<form class="js_form" data-url="core/sales.php?do=check&id=<?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_id'];?>
">
				<div class="row">
					<div class="input-field col s12 m4 center">
						<a class="waves-effect waves-light btn indigo darken-4 modal-trigger" href="#modal-client">
						<i class="material-icons left">person</i>Cliente</a>
					</div>
					
					<div class="input-field col s12 m4 center">
						<a class="waves-effect waves-light btn indigo darken-4 modal-trigger" href="#modal1">
						<i class="material-icons left">shopping_cart</i>Añadir al carrito</a>
					</div>
					
					<div class="input-field col s12 m4 center">
						<button type="submit" class="btn-op">Facturar</button>
					</div>
				</div>
				<input type="hidden" id="hd_client_name" name="hd_client_name">
				<input type="hidden" id="hd_client_contact" name="hd_client_contact">
				<input type="hidden" id="hd_client_type" name="hd_client_type">
				<input type="hidden" id="hd_client_id" name="hd_client_id">
			</form>

<div class="row plantilla">
	<div class="col s12 m6">
		<h6>Detalles de la factura</h6>
	</div>
	<div class="col s12 m6">
		<h6>Cliente: <span id="client_span"></span></h6>
	</div>
</div>

<table class="table centered striped" id="detail">
	<thead>	
		<th>Producto</th>
		<th>Precio</th>
		<th>Precio Bs</th>
		<th>Cantidad</th>
		<th>Sub Total</th>
		<th>Descartar</th>
	</thead>
	<tbody id="tbody_sale">
	<?php if ($_smarty_tpl->tpl_vars['details']->value) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['details']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
			<tr id="tr<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_detail_id'];?>
">
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</td>
				<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_price_unit_bs'];?>
 Bs</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['detail_quantity'];?>
</td>
				<td>$<?php echo $_smarty_tpl->tpl_vars['row']->value['detail_sub_total'];?>
</td>
				<td><button class="btn btn-flat js_button" data-url="core/sales.php?do=desc&sale=<?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['sale_detail_id'];?>
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
      
      <form class="js_form" id="form_product" data-url="core/sales.php?do=add&sale=<?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_id'];?>
">
      	<div class="row">
	      	<div class="input-field col s12 m6">
						<input type="text" name="name" id="name" placeholder="Nombre (*)" disabled>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="price_unit" id="price_unit" disabled>
						<span>Precio original</span>
					</div>

					<div class="input-field col s12 m6">
						<input type="text" name="price_unit_bs" id="price_unit_bs" disabled>
						<span>Precio original Bs</span>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price_sale" id="price_sale" disabled>
						<span>Precio Venta</span>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price_sale_bs" id="price_sale_bs" disabled>
						<span>Precio Venta Bs</span>
					</div>
	      			
					<div class="input-field col s12 m6">
						<input type="number" name="quantity" id="quantity" placeholder="Cantidad a Vender (*)">
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Añadir</button>
					</div>
					<input type="hidden" name="product_id" id="product_id" value="0">
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

								<td><button class="btn btn-flat js_button_check_sale modal-close"
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
								data-sale_id="<?php echo $_smarty_tpl->tpl_vars['sale']->value['sale_id'];?>
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
  </div>


<div id="modal-client" class="modal">
    <div class="modal-content">
    	<h6>Crear Nuevo Cliente</h6>
    	<div class="row">
    		<div class="input-field col s12 m6">
	    		<input type="text" id="client_name" placeholder="Nombre">
	    	</div>
	    	<div class="input-field col s12 m6">
	    		<input type="text" id="client_contact" placeholder="Contacto">
	    	</div>
	    	<div class="input-field col s12">
	    		<button class="btn-op js_button_new_client modal-close">Agregar</button>
	    	</div>
    	</div>

      <h6>Buscar Cliente</h6>
    	<table class="table centered striped datatable">
				<thead>
					<th>Nombre</th>
					<th>Contacto</th>
					<th>Seleccionar</th>
				</thead>
				<tbody>
					<?php if ($_smarty_tpl->tpl_vars['clients']->value) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clients']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['row']->value['client_name'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['row']->value['client_contact'];?>
</td>

								<td><button class="btn btn-flat js_button_client modal-close"
								data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['client_id'];?>
"
								data-name="<?php echo $_smarty_tpl->tpl_vars['row']->value['client_name'];?>
"
								data-contact="<?php echo $_smarty_tpl->tpl_vars['row']->value['client_contact'];?>
"
								><i class="material-icons">check</i></button></td>

							</tr>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php } else { ?>
						<tr>
						    <td colspan="3" class="text-center">
					        "No hay data cargada"
					        </td>
					    </tr>
					<?php }?>
				</tbody>
			</table>
    </div>
  </div><?php }
}
