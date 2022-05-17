<h2>
<a href="{$base_url}/purchases/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Compra #{$purchase['purchase_id']}</h2>

<div class="row plantilla">
	<div class="col s12 m4">
		<h6>Detalle de la fatura</h6>
	</div>
	<div class="col s12 m4">
		<h6>Proveedor: {$purchase['provider_name']} <a href="{$base_url}/providers/detail/{$purchase['provider_id']}" class="btn btn-flat"><i class="material-icons">visibility</i></a></h6>
	</div>
	<div class="col s12 m4">
		<h6>Fecha: {$purchase['purchase_date']}</h6>
	</div>
</div>


<table class="table centered striped" id="detail">
	<thead>	
		<th>Producto</th>
		<th>Precio</th>
		<th>Precio Bs (Para ese momento)</th>
		<th>Cantidad</th>
		<th>Sub Total</th>
	</thead>
	<tbody id="tbody_purchase">
	{if $details}
		{foreach $details as $row}
			<tr id="tr{$row['purchase_detail_id']}">
				<td>{$row['product_name']}</td>
				<td>${$row['detail_price_unit']}</td>
				<td>{$row['detail_price_unit_bs']} Bs</td>
				<td>{$row['detail_quantity']}</td>
				<td>${$row['detail_sub_total']}</td>
			</tr>
		{/foreach}
		<tr class="tr-total">
			<td colspan="2"></td>
			<td class="td-total">Total: </td>
			<td class="td-total">{$purchase['purchase_amount_bs']} Bs (Para ese momento)</td>
			<td class="td-total">${$purchase['purchase_amount']}</td>
		</tr>
	{/if}
	</tbody>
</table>