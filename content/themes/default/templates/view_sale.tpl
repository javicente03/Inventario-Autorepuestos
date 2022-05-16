<h2>
<a href="{$base_url}/sales/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Compra #{$sale['sale_id']}</h2>

<h6>Detalle de la fatura</h6>
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
			<tr id="tr{$row['sale_detail_id']}">
				<td>{$row['product_name']}</td>
				<td>${$row['detail_price_unit']}</td>
				<td>{$row['detail_price_unit_bs']} Bs</td>
				<td>{$row['detail_quantity']}</td>
				<td>${$row['detail_sub_total']}</td>
			</tr>
		{/foreach}
		<tr class="tr-total">
			<td colspan="2"></td>
			<td>Total: </td>
			<td>{$sale['sale_amount_bs']} Bs (Para ese momento)</td>
			<td>${$sale['sale_amount']}</td>
		</tr>
	{/if}
	</tbody>
</table>