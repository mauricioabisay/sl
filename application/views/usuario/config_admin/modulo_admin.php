<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<table class="listado" border="0">
	<thead>
	<tr>
		<th>Nombre</th>
		<th>Opciones</th>
	</tr>
	</thead>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $resultado) {
	?>
		<tr>
			<td><?php echo $resultado->nombre;?></td>
			<td align="center">
				<a href="<?php echo site_url()?>/usuario/borrar/<?php echo $resultado->id;?>">Borrar</a>
			</td>		
		</tr>
	<?php
		}
	?>
</table>
<form id="formulario" method="post" enctype="multipart/form-data" style="width: 100%">
<fieldset>
	<legend>Datos de Funcionalidad</legend>
	<div class="lineal">
		<label>Nombre de la Funcionalidad:</label>
		<input type="text" name="nombre_mod" size="30"  /><?php echo form_error('usuario');?>
		<?php echo form_error('nombre_mod');?>
	</div>
	<div class="lineal">
		<label>C&oacute;digo de la Funcionalidad:</label>
		<input type="text" name="codigo" size="30"  />
		<?php echo form_error('codigo');?>
	</div>
	
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar" />
	</div>
</fieldset>
</form>