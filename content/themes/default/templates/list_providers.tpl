<h2>Lista de Proveedores</h2>
<a href="{$base_url}/providers/new" class="btn indigo darken-4"><i class="material-icons left">local_shipping</i>Registrar</a>

<table class="table centered" id="table">
	<thead>
		<th>Nombre</th>
		<th>Ubicación</th>
		<th>Contácto</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</thead>
	<tbody>
		{if $providers}
			{foreach $providers as $row}
				<tr>
					<td>{$row['provider_name']}</td>
					<td>{$row['provider_ubication']}</td>
					<td>{$row['provider_contact']}</td>
					<td><a class="btn btn-flat" href="{$base_url}/providers/detail/{$row['provider_id']}"><i class="material-icons">edit</i></a></td>
					<td>
						<button class="js_button btn red" data-id="{$row['provider_id']}" data-url="core/providers.php?do=delete&id={$row['provider_id']}"><i class="material-icons">delete</i></button>
					</td>
				</tr>
			{/foreach}
		{else}
			<tr>
			    <td colspan="5" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		{/if}
	</tbody>
</table>
