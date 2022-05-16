<h2>
<a href="{$base_url}/purchases/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Nueva Factura</h2>
			<form class="js_form" data-url="core/purchases.php?do=check&id={$purchase['purchase_id']}">
				<div class="row">
					<div class="input-field col s12 m4">
						{if $providers}
							<select name="provider" id="provider">
								{foreach $providers as $row}
									<option value="{$row['provider_id']}">{$row['provider_name']}</option>
								{/foreach}
							</select>
							<label for="name">Proveedor (*)</label>
						{else}
						<span>Debe registrar proveedores</span>
						{/if}
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
	{if $details}
		{foreach $details as $row}
			<tr id="tr{$row['purchase_detail_id']}">
				<td>{$row['product_name']}</td>
				<td>${$row['detail_price_unit']}</td>
				<td>{$row['detail_quantity']}</td>
				<td>${$row['detail_sub_total']}</td>
				<td><button class="btn btn-flat js_button" data-url="core/purchases.php?do=desc&purchase={$purchase['purchase_id']}" data-id="{$row['purchase_detail_id']}"><i class='material-icons'>close<i></button></td>
			</tr>
		{/foreach}
	{/if}
	</tbody>
</table>
<div class="div-total-balance">
	<h6 class="total-balance">Total: $<span id="total_balance">{$sum_details['balance']}</span></h6>
</div>

  <!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
      <div style="display:flex;justify-content:space-between;">
      	<h4>Agregar Producto</h4>
	      <button data-target="modal2" class="btn bt-flat modal-trigger"><i class="material-icons left">search</i></button>
      </div>
      <form class="js_form" id="form_product" data-url="core/products.php?do=new&purchase={$purchase['purchase_id']}">
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
						{if $categories}
							<select name="category" id="category">
								{foreach $categories as $row}
									<option value="{$row['category_id']}">{$row['category_name']}</option>
								{/foreach}
							</select>
							<label for="quantity">Categoría (*)</label>
						{else}
							<span>Debe cargar categorías</span>
						{/if}
					</div>
					<div class="input-field col s12 m6" id="cont-photo">
						<div class="container-uploader" data-id="photo-product">
						{include file="_form_image.tpl"}
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
			{if $products}
				{foreach $products as $row}
					<tr>
						<td>{$row['product_name']}</td>
						<td>{$row['product_marca']}</td>
						<td>${$row['product_price']}</td>
						<td>{$row['product_price_bs']} Bs</td>
						<td>${$row['product_price_sale']}</td>
						<td>{$row['product_price_sale_bs']} Bs</td>
						<td><img width="50px" src="{$base_url}/content/uploads/{$row['product_image']}"></td>

						<td><button class="btn btn-flat js_button_check modal-close"
						data-id="{$row['product_id']}"
						data-name="{$row['product_name']}"
						data-price="{$row['product_price']}"
						data-price_bs="{$row['product_price_bs']}"
						data-price_sale="{$row['product_price_sale']}"
						data-price_sale_bs="{$row['product_price_sale_bs']}"
						data-purchase_id="{$purchase['purchase_id']}"

						><i class="material-icons">check</i></button></td>

					</tr>
				{/foreach}
			{else}
				<tr>
				    <td colspan="9" class="text-center">
			        "No hay data cargada"
			        </td>
			    </tr>
			{/if}
		</tbody>
	</table>
    </div>
  </div>