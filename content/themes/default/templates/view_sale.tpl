<h2>
<a href="{$base_url}/sales/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Compra #{$sale['sale_id']}</h2>

<div class="row plantilla">
	<div class="col s12 m4">
		<h6>Detalle de la fatura</h6>
	</div>
	<div class="col s12 m4">
		<h6>Cliente: {$sale['client_name']}</h6>
	</div>
	<div class="col s12 m4">
		<h6>Fecha: {$sale['sale_date']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Tipo de Pago: <span class="{if $sale['sale_type_payment'] == 'credito'}red-text{else}green-text{/if}">{$sale['sale_type_payment']}</span></h6>
	</div>

	<div class="col s12 m4">
		<h6>Fecha de crédito: {$sale['date_limit']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Días de crédito: {$sale['days_payment_credit']}</h6>
	</div>

	<div class="col s12 m4">
		<h6>Días de crédito restantes: 
			<span class="
				{if $sale['sale_type_payment'] == 'credito' && !$sale['credit_payment']}
					{if $sale['days_remaining_is_less_5']}
						red-text
					{else}
						green-text
					{/if}
				{/if}
			">
				{if $sale['sale_type_payment'] == 'credito'}
					{if !$sale['credit_payment']}
						{$sale['days_remaining']}
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
			{if $sale['sale_type_payment'] == 'credito'}
				{if $sale['credit_payment']}
					<i class="material-icons green-text">check</i>
				{else}
					<i class="material-icons red-text">close</i>
				{/if}
			{else}
				N/A
			{/if}
		</h6>
	</div>

	{if $sale['sale_type_payment'] == 'credito' && !$sale['credit_payment']}
		<div class="col s12 m4">
			<button class="btn-op js_button_confirm"
				data-id="{$sale['sale_id']}"
				data-url="core/sales.php?do=check_credit_payment"
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
			<td class="td-total">Total: </td>
			<td class="td-total">{$sale['sale_amount_bs']} Bs (Para ese momento)</td>
			<td class="td-total">${$sale['sale_amount']}</td>
		</tr>
	{/if}
	</tbody>
</table>