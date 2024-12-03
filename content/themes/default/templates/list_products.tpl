<h2 {if $products}class="title-table"{/if}>Lista de Productos</h2>
<table class="table centered striped" id="datatable">
	<thead>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Descripción</th>
		<th>Precio Prov. $</th>
		<th>Precio Prov. Bs</th>
		<th>Precio Vent. $</th>
		<th>Precio Vent. Bs</th>
		<th>Imágen</th>
		<th>Cantidad Actual</th>
		<th>Editar</th>
		<th>Histórico</th>
	</thead>
	<tbody>
		{if $products}
			{foreach $products as $row}
				<tr>
					<td>{$row['product_name']}</td>
					<td>{$row['product_marca']}</td>
					<td>{$row['product_description']|truncate:120}</td>
					<td>${$row['product_price']}</td>
					<td>{$row['product_price_bs']} Bs</td>
					<td>${$row['product_price_sale']}</td>
					<td>{$row['product_price_sale_bs']} Bs</td>
					<td><img width="100px" src="{$base_url}/content/uploads/{$row['product_image']}"></td>
					<td><span {if $row['product_quantity'] < 5 } class="danger" {/if}>{$row['product_quantity']}<span></td>
					<td><a class="btn btn-flat" href="{$base_url}/products/edit/{$row['product_id']}"><i class="material-icons">edit</i></a></td>
					<td><a class="btn btn-flat" href="{$base_url}/products/detail/{$row['product_id']}"><i class="material-icons">visibility</i></a></td>
				</tr>
			{/foreach}
		{else}
			<tr>
			    <td colspan="12" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		{/if}
	</tbody>
</table>
