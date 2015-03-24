<form id="formulario" action="<?php echo site_url();?>/usuario/buscar_nombre" method="post">
	<fieldset>
		<legend>B&uacute;squeda de Usuario</legend>
		<div class="lineal">
			<label>Buscar:</label>
			<input type="text" name="usuario" size="50"  />
			<input type="submit" value="Buscar" />
		</div>
	</fieldset>
</form>