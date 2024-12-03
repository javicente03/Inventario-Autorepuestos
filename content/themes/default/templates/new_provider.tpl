<h2>
<a href="{$base_url}/providers/list" class="btn btn-flat tooltipped" data-position="bottom" data-tooltip="Regresar"><i class="material-icons">arrow_back</i></a>
Registrar Proveedor</h2>
			<form class="js_form" data-url="core/providers.php?do=new">
				<div class="row">
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">local_shipping</i>
						<input type="text" name="name" id="name">
						<label for="name">Nombre</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">location_on</i>
						<input type="text" name="ubication" id="ubication">
						<label for="ubication">Ubicación</label>
					</div>
					<div class="input-field col s12 m4">
						<i class="material-icons prefix">contact_phone</i>
						<input type="text" name="contact" id="contact">
						<label for="contact">Contacto</label>
					</div>
					
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Registrar</button>
					</div>
				</div>
			</form>