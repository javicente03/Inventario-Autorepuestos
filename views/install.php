<?php
    // Incluimos el encabezado de la página
    include_once 'views/header/head.php';
    include_once 'views/header/header.php';
?>


<div class="container">
	<div class="row container-center">
		<div class="col s12 m6 z-depth-3">
			<h2>Instalación V.1.0</h2>
			<span>Registra un usuario</span>
			<form class="js_form" data-url="core/install.php">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="username" id="username">
						<label for="username">Ingrese su usuario</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input type="password" name="password" id="password">
						<label for="password">Ingrese su Contraseña</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="firstname" id="firstname">
						<label for="firstname">Ingrese su nombre</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="lastname" id="lastname">
						<label for="lastname">Ingrese su apellido</label>
					</div>
					<div class="input-field col s12 center">
						<button type="submit" class="btn-op">Ingresar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
    // Incluimos el pie de página
    include_once 'views/footer/footer.php';
?>