<div style="display:flex;justify-content:space-between;">
	<a href="{$base_url}/products/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>

	<a href="{$base_url}/products/detail/{$product['product_id']}" class="btn indigo darken-4"><i class="material-icons left">visibility</i>Histórico</a>
</div>

<h2>Modificar Producto</h2>
			<form class="js_form" data-url="core/products.php?do=edit&id={$product['product_id']}">
				<div class="row">
					<div class="input-field col s12 m6">
						<input type="text" name="name" id="name" value="{$product['product_name']}">
						<label for="name">Nombre (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="marca" id="marca" value="{$product['product_marca']}">
						<label for="marca">Marca (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price" id="price" value="{$product['product_price']}">
						<label for="price">Precio Proveedor (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" step="0.1" name="price_sale" id="price_sale" value="{$product['product_price_sale']}">
						<label for="price">Precio Venta (*)</label>
					</div>
					<div class="input-field col s12">
						{if $categories}
							<select name="category" id="category">
								{foreach $categories as $row}
									<option {if $row['category_id'] == $product['product_category']}
												selected
											{/if}
									 value="{$row['category_id']}">{$row['category_name']}</option>
								{/foreach}
							</select>
						{/if}
						<label for="quantity">Categoría (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<img src="{$base_url}/content/uploads/{$product['product_image']}" class="responsive-img product_image">
					</div>
					<div class="input-field col s12 m6">
						<div class="container-uploader" data-id="photo-product">
						{include file="_form_image.tpl"}
						</div>
					</div>
					<div class="input-field col s12">
						<textarea name="description" class="materialize-textarea" placeholder="Descripción, no debes exceder los 500 caracteres">{$product['product_description']}</textarea>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form>