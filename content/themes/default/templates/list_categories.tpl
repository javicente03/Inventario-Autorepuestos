<h2>Lista de Categorías</h2>
<a href="{$base_url}/categories/new" class="btn indigo darken-4"><i class="material-icons left">local_shipping</i>Registrar</a>

<table class="table centered striped" id="table">
	<thead>
		<th>Nombre</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</thead>
	<tbody>
		{if $categories}
			{foreach $categories as $row}
				<tr>
					<td>{$row['category_name']}</td>
					<td><a class="btn btn-flat" href="{$base_url}/categories/detail/{$row['category_id']}"><i class="material-icons">edit</i></a></td>
					<td>
						<button class="js_button btn red" data-id="{$row['category_id']}" data-url="core/categories.php?do=delete&id={$row['category_id']}"><i class="material-icons">delete</i></button>
					</td>
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
