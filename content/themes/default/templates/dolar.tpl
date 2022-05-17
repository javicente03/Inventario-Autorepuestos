{include file="_head.tpl"}
{include file="_header.tpl"}


<div class="container section">
	<div class="row container-center">
		<form class="js_form" data-url="core/options.php?do=dolar">
			<div class="row">
				<h4>Modifique la tasa del día</h4>
				<div class="input-field col s10">
					<input type="number" name="dolar" value="{$tasa}" step="0.01" style="text-align:center;font-weight:bold;">
				</div>
				<div class="input-field col s2"><h6>Bs</h6></div>

				<div class="input-field col s12">
					<button class="btn-op">Guardar</button>
				</div>	
			</div>		
		</form>
	</div>
</div>


{include file="_footer.tpl"}