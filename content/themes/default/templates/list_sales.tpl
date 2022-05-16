<h2>Lista de Ventas

{if isset($get['type'])}
	{if $get['type'] == 'status' && $get['page'] == 0}
		Pendientes
	{else if $get['type'] == 'status' && $get['page'] == 1}
		Completadas
	{/if}
{/if}
</h2>

<a href="{$base_url}/sales/new" class="btn indigo darken-4"><i class="material-icons left">add_shopping_cart</i>Nueva Factura</a>

<a href="{$base_url}/sales/list/0/status/" class="btn indigo darken-4">Pendientes</a>

<a href="{$base_url}/sales/list/1/status/" class="btn indigo darken-4">Completadas</a>

<a href="{$base_url}/sales/list/" class="btn indigo darken-4">Todas</a>


<table class="table centered striped" id="datatable">
	<thead>
		<th>Fecha</th>
		<th>Cliente</th>
		<th>Monto $</th>
		<th>Monto Bs</th>
		<th>Registrado por</th>
		<th>Ver detalle /editar</th>
	</thead>
	<tbody>
		{if $sales}
			{foreach $sales as $row}
				<tr>
					<td>

						{if $row['sale_status']}
							{$row['sale_date']}
						{else}
							Pendiente
						{/if}
					</td>
					<td>{$row['client_name']}</td>
					<td>${$row['sale_amount']}</td>
					<td>{$row['sale_amount_bs']} Bs</td>
					<td>{$row['user_name']}</td>
					<td>
						{if $row['sale_status']}
						<a class="btn btn-flat" href="{$base_url}/sales/detail/{$row['sale_id']}"><i class="material-icons">visibility</i></a>
						{else}
						<a class="btn btn-flat" href="{$base_url}/sales/edit/{$row['sale_id']}"><i class="material-icons">edit</i></a>
						<button class="btn btn-flat js_button" data-url="core/sales.php?do=delete" data-id="{$row['sale_id']}"><i class="material-icons">delete</i></button>
						{/if}
					</td>
				</tr>
			{/foreach}
		{else}
			<tr>
			    <td colspan="6" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		{/if}
	</tbody>
</table>
