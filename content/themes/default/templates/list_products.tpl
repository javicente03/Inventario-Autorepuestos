<h2>Lista de Productos</h2>
<table class="table centered" id="table">
	<thead>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Descripción</th>
		<th>Precio $</th>
		<th>Precio Bs</th>
		<th>Imágen</th>
		<th>Cantidad</th>
		<th>Categoría</th>
		<th>Estatus</th>
		<th>Acción</th>
	</thead>
	<tbody>
		{if $products}
			{foreach $products as $row}
				<tr>
					<td>{$row['product_name']}</td>
					<td>{$row['product_marca']}</td>
					<td>{$row['product_description']}</td>
					<td>${$row['product_price']}</td>
					<td>{$row['product_price_bs']} Bs</td>
					<td><img width="100px" src="{$base_url}/content/uploads/{$row['product_image']}"></td>
					<td>{$row['product_quantity']}</td>
					<td>{$row['category_name']}</td>
					<td>
						{if $row['product_status']}
							Activo
						{else}
							Inactivo
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
