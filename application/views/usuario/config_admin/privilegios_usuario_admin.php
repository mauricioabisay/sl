<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<form action="<?php echo site_url();?>/usuario/admin_privilegios_usuario" method="post">
<?php 
if(isset($usuarios) && $usuarios != FALSE)
foreach($usuarios as $usuario){
?>
<table class="listado" border="0">
	<thead>
	<tr>
		<th colspan="2"><?php echo $usuario->nombre;?></th>
	</tr>
	<tr>
		<th>M&oacute;dulo</th>
		<th>Privilegios</th>
	</tr>
	</thead>
	<?php
		if(isset($modulos) && $modulos != FALSE)
		foreach ($modulos as $modulo) {
			if(isset($privilegios) && $privilegios != FALSE){
				foreach($privilegios as $privilegio){
					$aux_privilegio = (($privilegio->usuario == $usuario->id)&&($privilegio->modulo == $modulo->id))?$privilegio->permiso:FALSE;
					if($aux_privilegio){
						break;
					}
				}
			}
	?>
		<tr>
			<td><?php echo $modulo->nombre;?></td>
			<td align="center">
				<input type="checkbox" name="<?php echo $usuario->id.'_'.$modulo->id.'_';?>permiso[]" value="Crear" <?php echo (($privilegios)&&($aux_privilegio)&&(stristr($aux_privilegio,'Crear')))?'checked="checked"':'';?> /><label>Crear</label>
				<input type="checkbox" name="<?php echo $usuario->id.'_'.$modulo->id.'_';?>permiso[]" value="Ver" <?php echo (($privilegios)&&($aux_privilegio)&&(stristr($aux_privilegio,'Ver')))?'checked="checked"':'';?> /><label>Ver</label>
				<input type="checkbox" name="<?php echo $usuario->id.'_'.$modulo->id.'_';?>permiso[]" value="Modificar" <?php echo (($privilegios)&&($aux_privilegio)&&(stristr($aux_privilegio,'Modificar')))?'checked="checked"':'';?> /><label>Modificar</label>
				<input type="checkbox" name="<?php echo $usuario->id.'_'.$modulo->id.'_';?>permiso[]" value="Eliminar" <?php echo (($privilegios)&&($aux_privilegio)&&(stristr($aux_privilegio,'Eliminar')))?'checked="checked"':'';?> /><label>Eliminar</label>				
			</td>		
		</tr>
	<?php
		}
	?>
</table>
<?php }?>
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar" />
	</div>
</form>
