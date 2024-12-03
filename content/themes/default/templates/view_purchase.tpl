<h2>
<a href="{$base_url}/purchases/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Compra #{$purchase['purchase_id']}</h2>

<div class="row plantilla">
	<h6 style="margin-top: 60px">Proveedor: {$purchase['provider_name']} <a href="{$base_url}/providers/detail/{$purchase['provider_id']}" class="btn btn-flat"><i class="material-icons">visibility</i></a></h6>

	<div class="col s12 m4">
		<h6>Detalle de la fatura</h6>
	</div>
	<div class="col s12 m4">
		<h6>Fecha: {$purchase['purchase_date']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Método de Pago: {$purchase['purchase_method']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Número de Factura: {$purchase['purchase_invoice']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Tipo de Pago: <span class="{if $purchase['purchase_type_payment'] == 'credito'}red-text{else}green-text{/if}">{$purchase['purchase_type_payment']}</span></h6>
	</div>

	<div class="col s12 m4">
		<h6>Fecha de crédito: {$purchase['date_limit']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Días de crédito: {$purchase['days_payment_credit']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Días de crédito restantes: 
			<span class="
				{if $purchase['purchase_type_payment'] == 'credito' && !$purchase['credit_payment']}
					{if $purchase['days_remaining_is_less_5']}
						red-text
					{else}
						green-text
					{/if}
				{/if}
			">
				{if $purchase['purchase_type_payment'] == 'credito'}
					{if !$purchase['credit_payment']}
						{$purchase['days_remaining']}
					{else}
						<i class="material-icons green-text">check</i>
					{/if}
				{else}
					N/A
				{/if}
			</span>
		</h6>
	</div>

	<div class="col s12 m4">
		<h6>Crédito Pagado: 
			{if $purchase['purchase_type_payment'] == 'credito'}
				{if $purchase['credit_payment']}
					<i class="material-icons green-text">check</i>
				{else}
					<i class="material-icons red-text">close</i>
				{/if}
			{else}
				N/A
			{/if}
		</h6>
	</div>

	{if $purchase['purchase_type_payment'] == 'credito' && !$purchase['credit_payment']}
		<div class="col s12 m4">
			<button class="btn-op js_button_confirm"
				data-id="{$purchase['purchase_id']}"
				data-url="core/purchases.php?do=check_credit_payment"
				data-message="¿Está seguro de pagar el crédito de esta compra?"
			>Pagar Crédito</button>
		</div>
	{/if}

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