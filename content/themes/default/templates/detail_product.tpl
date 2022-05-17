<div style="display:flex;justify-content:space-between;margin-bottom:10px;">
	<a href="{$base_url}/products/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>

	<a href="{$base_url}/products/edit/{$product['product_id']}" class="btn indigo darken-4"><i class="material-icons left">edit</i>Editar</a>
</div>
<div class="row plantilla">
	<div class="col s12 m8 center title-plantilla">
		<h4>{$product['product_name']}</h4>
	</div>
	<div class="col s12 m4 center">
		<img class="responsive-img product_image" src="{$base_url}/content/uploads/{$product['product_image']}">
	</div>
	<div class="col s12 m6 center">
		<h6 {if $product['product_quantity'] < 5 } class="danger" {/if}>Stock Actual: {$product['product_quantity']}</h6>
	</div>
	<div class="col s12 m6 center">
		<h6>Marca: {$product['product_marca']}</h6>
	</div>
	<div class="col s12 m4 center">
		<h6>{$product['product_name']}</h6>
	</div>
	<div class="col s12 m8 center">
		<h6>Categoría: {$product['category_name']}</h6>
	</div>
	<div class="col s12 m8 center">
		<h6>Precio Proveedor: ${$product['product_price']}</h6>
	</div>
	<div class="col s12 m4 center">
		<h6>Bs: {$product['product_price_bs']}</h6>
	</div>
	<div class="col s12 m8 center">
		<h6>Precio Venta: ${$product['product_price_sale']}</h6>
	</div>
	<div class="col s12 m4 center">
		<h6>Bs: {$product['product_price_sale_bs']}</h6>
	</div>
	<div class="col s12 m6 center">
		<h6>Compras Realizadas: {$conts['purchases_count']}</h6>
	</div>
	<div class="col s12 m6 center">
		<h6>Ventas Terminadas: {$conts['sales_count']}</h6>
	</div>
	<div class="col s12 center">
		<span>{$product['product_description']}</span>
	</div>
</div>

<h6 class="title-table"><b>Histórico de compras</b></h6>

<table class="datatable table centered striped">
	<thead>
		<th>Fecha</th>
		<th>Factura #</th>
		<th>Precio</th>
		<th>Precio Bs (Para ese momento)</th>
		<th>Unidades</th>
		<th>Sub total</th>
		<th>Proveedor</th>
		<th>Ver factura</th>
	</thead>
	<tbody>
		{if $purchases}
			{foreach $purchases as $row}
				<tr>
					<td>{$row['purchase_date']}</td>
					<td>{$row['purchase_id']}</td>
					<td>${$row['detail_price_unit']}</td>
					<td>{$row['detail_price_unit_bs']} Bs</td>
					<td>{$row['detail_quantity']}</td>
					<td>${$row['detail_sub_total']}</td>
					<td>{$row['provider_name']}</td>
					<td><a href="{$base_url}/purchases/detail/{$row['purchase_id']}" class="btn btn-flat"><i class="material-icons">visibility</i></a></td>
				</tr>
			{/foreach}
		{else}
		{/if}
	</tbody>
</table>


<h6 class="title-table"><b>Histórico de ventas</b></h6>

<table class="datatable table centered striped">
	<thead>
		<th>Fecha</th>
		<th>Factura #</th>
		<th>Precio</th>
		<th>Precio Bs (Para ese momento)</th>
		<th>Unidades</th>
		<th>Sub total</th>
		<th>Cliente</th>
		<th>Ver factura</th>
	</thead>
	<tbody>
		{if $sales}
			{foreach $sales as $row}
				<tr>
					<td>{$row['sale_date']}</td>
					<td>{$row['sale_id']}</td>
					<td>${$row['detail_price_unit']}</td>
					<td>${$row['detail_price_unit_bs']} Bs</td>
					<td>{$row['detail_quantity']}</td>
					<td>${$row['detail_sub_total']}</td>
					<td>{$row['client_name']}</td>
					<td><a href="{$base_url}/sales/detail/{$row['sale_id']}" class="btn btn-flat"><i class="material-icons">visibility</i></a></td>
				</tr>
			{/foreach}
		{else}
		{/if}
	</tbody>
</table>