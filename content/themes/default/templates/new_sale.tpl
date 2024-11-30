<h2>
<a href="{$base_url}/sales/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Nueva Factura</h2>
			<form class="js_form" data-url="core/sales.php?do=check&id={$sale['sale_id']}">
				<div class="row">
					<div class="input-field col s12 m4 center">
						<a class="waves-effect waves-light btn indigo darken-4 modal-trigger" href="#modal-client">
						<i class="material-icons left">person</i>Cliente</a>
					</div>
					
					<div class="input-field col s12 m4 center">
						<a class="waves-effect waves-light btn indigo darken-4 modal-trigger" href="#modal1">
						<i class="material-icons left">shopping_cart</i>Añadir al carrito</a>
					</div>

					<div class="input-field col s12 m4">
						<select name="sale_type_payment" id="sale_type_payment">
							<option value="contado">Contado</option>
							<option value="credito">Crédito</option>
						</select>
						<label for="sale_type_payment">Tipo de Pago</label>
					</div>
					
					<div class="input-field col s12 m4" id="days_payment_credit_div" style="display:none;">
						<input type="number" name="days_payment_credit" id="days_payment_credit">
						<label for="days_payment_credit">Días de Crédito</label>
					</div>
					
					<div class="input-field col s12 center">
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
	{if $details}
		{foreach $details as $row}
			<tr id="tr{$row['sale_detail_id']}">
				<td>{$row['product_name']}</td>
				<td>${$row['detail_price_unit']}</td>
				<td>{$row['detail_price_unit_bs']} Bs</td>
				<td>{$row['detail_quantity']}</td>
				<td>${$row['detail_sub_total']}</td>
				<td><button class="btn btn-flat js_button" data-url="core/sales.php?do=desc&sale={$sale['sale_id']}" data-id="{$row['sale_detail_id']}"><i class='material-icons'>close<i></button></td>
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
      
      <form class="js_form" id="form_product" data-url="core/sales.php?do=add&sale={$sale['sale_id']}">
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

								<td><button class="btn btn-flat js_button_check_sale modal-close"
								data-id="{$row['product_id']}"
								data-name="{$row['product_name']}"
								data-price="{$row['product_price']}"
								data-price_bs="{$row['product_price_bs']}"
								data-price_sale="{$row['product_price_sale']}"
								data-price_sale_bs="{$row['product_price_sale_bs']}"
								data-sale_id="{$sale['sale_id']}"

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
					{if $clients}
						{foreach $clients as $row}
							<tr>
								<td>{$row['client_name']}</td>
								<td>{$row['client_contact']}</td>

								<td><button class="btn btn-flat js_button_client modal-close"
								data-id="{$row['client_id']}"
								data-name="{$row['client_name']}"
								data-contact="{$row['client_contact']}"
								><i class="material-icons">check</i></button></td>

							</tr>
						{/foreach}
					{else}
						<tr>
						    <td colspan="3" class="text-center">
					        "No hay data cargada"
					        </td>
					    </tr>
					{/if}
				</tbody>
			</table>
    </div>
  </div>