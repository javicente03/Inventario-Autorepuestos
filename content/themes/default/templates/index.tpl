{include file="_head.tpl"}
{include file="_header.tpl"}


<div class="container">
	<div class="row container-center" style="display:block;">
		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Top 10 Más Vendidos</h2>

			<ul class="collection">
				{if $mas_vendidos}
					{foreach $mas_vendidos as $row}
					    <li class="collection-item avatar">
					      <img src="{$base_url}/content/uploads/{$row['product_image']}" alt="{$row['product_name']}" class="circle">
					      <span class="title">{$row['product_name']}</span>
					      <p>Vendidas: {$row['suma']} unidades<br>
					      	Categoría: {$row['category_name']}
					      </p>
					      <a href="{$base_url}/products/detail/{$row['product_id']}" class="secondary-content tooltipped" data-position="bottom" data-tooltip="Ver Histórico"><i class="material-icons">visibility</i></a>
					    </li>
					{/foreach}
			    {else}
			    	<li class="collection-item">Aún no hay data</li>
			    {/if}
			  </ul>
		</div>
		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Top 5 Proveedores constantes</h2>

			<ul class="collection">
				{if $proveedores_constantes}
					{foreach $proveedores_constantes as $row}
					    <li class="collection-item avatar">
					      <i class="material-icons circle">local_shipping</i>
					      <span class="title">{$row['provider_name']}</span>
					      <p>Compras realizadas: {$row['count']}<br>
					         {$row['provider_contact']}
					      </p>
					    </li>
					{/foreach}
			    {else}
			    	<li class="collection-item">Aún no hay data</li>
			    {/if}
			  </ul>
		</div>

		<div class="col s12 m6 z-depth-3 div-dash">
			<h2>Productos con stock menor a 5</h2>

			<ul class="collection">
				{if $productos_poco_stock}
					{foreach $productos_poco_stock as $row}
					    <li class="collection-item avatar">
					      <img src="{$base_url}/content/uploads/{$row['product_image']}" alt="{$row['product_name']}" class="circle">
					      <span class="title">{$row['product_name']}</span>
					      <p>Stock: {$row['product_quantity']} unidades<br>
					      </p>
					      <a href="{$base_url}/products/detail/{$row['product_id']}" class="secondary-content tooltipped" data-position="bottom" data-tooltip="Ver Histórico"><i class="material-icons">visibility</i></a>
					    </li>
					{/foreach}
			    {else}
			    	<li class="collection-item">No hay productos con bajo stock</li>
			    {/if}
			  </ul>
		</div>
	</div>
</div>

{include file="_footer.tpl"}