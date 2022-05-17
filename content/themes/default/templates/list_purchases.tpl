<h2 >Lista de Compras

{if isset($get['type'])}
	{if $get['type'] == 'status' && $get['page'] == 0}
		Pendientes
	{else if $get['type'] == 'status' && $get['page'] == 1}
		Completadas
	{/if}
{/if}
</h2>

<a href="{$base_url}/purchases/new" class="btn indigo darken-4"><i class="material-icons left">add_shopping_cart</i>Nueva Factura</a>

<a href="{$base_url}/purchases/list/0/status/" class="btn indigo darken-4">Pendientes</a>

<a href="{$base_url}/purchases/list/1/status/" class="btn indigo darken-4">Completadas</a>

<a href="{$base_url}/purchases/list/" class="btn indigo darken-4">Todas</a>


<table class="table centered striped" id="datatable">
	<thead>
		<th>Fecha</th>
		<th>Proveedor</th>
		<th>Monto $</th>
		<th>Monto Bs</th>
		<th>Método de Pago</th>
		<th>Número de Factura</th>
		<th>Registrado por</th>
		<th>Ver detalle /editar</th>
	</thead>
	<tbody>
		{if $purchases}
			{foreach $purchases as $row}
				<tr>
					<td>

						{if $row['purchase_status']}
							{$row['purchase_date']}
						{else}
							Pendiente
						{/if}
					</td>
					<td><a class="link-table" href="{$base_url}/providers/detail/{$row['provider_id']}">{$row['provider_name']}</a></td>
					<td>${$row['purchase_amount']}</td>
					<td>{$row['purchase_amount_bs']} Bs</td>
					<td>{$row['purchase_method']}</td>
					<td>{$row['purchase_invoice']}</td>
					<td>{$row['user_name']}</td>
					<td>
						{if $row['purchase_status']}
						<a class="btn btn-flat" href="{$base_url}/purchases/detail/{$row['purchase_id']}"><i class="material-icons">visibility</i></a>
						{else}
						<a class="btn btn-flat" href="{$base_url}/purchases/edit/{$row['purchase_id']}"><i class="material-icons">edit</i></a>
						<button class="btn btn-flat js_button" data-url="core/purchases.php?do=delete" data-id="{$row['purchase_id']}"><i class="material-icons">delete</i></button>
						{/if}
					</td>
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
