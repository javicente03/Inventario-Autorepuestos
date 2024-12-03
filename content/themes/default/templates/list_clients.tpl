<h2 {if $clients}class="title-table"{/if}>Lista de Clientes</h2>

<table class="table centered striped" id="datatable">
	<thead>
		<th>Nombre</th>
		<th>Contácto</th>
	</thead>
	<tbody>
		{if $clients}
			{foreach $clients as $row}
				<tr>
					<td>{$row['client_name']}</td>
					<td>{$row['client_contact']}</td>
				</tr>
			{/foreach}
		{else}
			<tr>
			    <td colspan="2" class="text-center">
		        "No hay data cargada"
		        </td>
		    </tr>
		{/if}
	</tbody>
</table>
