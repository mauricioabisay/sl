<form id="formulario" action="<?php echo site_url();?>/paciente/agregar" method="post" enctype="multipart/form-data" style="width: 100%">
		<fieldset class="columnaizq">
		<legend>Datos Personales</legend>
			<label>Nombre(s):</label>
			<span class="lineal"><input autocomplete="off" type="text" name="nombre" value="<?php echo set_value('nombre');?>"/><?php echo form_error('nombre')?></span>
			<label>Apellido Paterno:</label>
			<span class="lineal"><input autocomplete="off" type="text" name="ap" value="<?php echo set_value('ap');?>" /><?php echo form_error('ap')?></span>
			<label>Apellido Materno</label>
<div class="columnader">
<fieldset>
		<label>E-mail 3:</label>
<div class="botones" align="center">
</div>	
</form>