<form class="busqueda" method="post" action="<?php echo site_url();?>/paciente/busqueda">
	<fieldset>
		<legend>B&uacute;squeda</legend>
		<label>Buscar:</label><input type="text" name="nombre" />
		<input type="submit" value="Buscar" />
		<input type="reset" value="Limpiar" />
		<fieldset>
			<legend>B&uacute;squeda Avanzada<input type="button" value="+" onclick='$("#busqueda_avanzada").toggle(200)' /></legend>
			<div id="busqueda_avanzada" style="display: none">
				<input type="radio" /><label>Op1</label>
				<input type="radio" /><label>Op2</label>
				<input type="radio" /><label>Op3</label>
			</div>
		</fieldset>
	</fieldset>
</form>