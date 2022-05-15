<h2>Registrar Producto</h2>
			<form class="js_form" data-url="core/products.php?do=new">
				<div class="row">
					<div class="input-field col s12 m6">
						<input type="text" name="name" id="name">
						<label for="name">Nombre (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="marca" id="marca">
						<label for="marca">Marca (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="text" name="price" id="price">
						<label for="price">Precio (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<input type="number" name="quantity" id="quantity">
						<label for="quantity">Cantidad Existente (*)</label>
					</div>
					<div class="input-field col s12 m6">
						{if $categories}
							<select name="category" id="category">
								{foreach $categories as $row}
									<option value="{$row['category_id']}">{$row['category_name']}</option>
								{/foreach}
							</select>
						{/if}
						<label for="quantity">Categoría (*)</label>
					</div>
					<div class="input-field col s12 m6">
						<div class="container-uploader" data-id="photo-product">
						{include file="_form_image.tpl"}
						</div>
					</div>
					<div class="input-field col s12">
						<textarea name="description" class="materialize-textarea" placeholder="Descripción, no debes exceder los 500 caracteres"></textarea>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form>