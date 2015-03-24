	<legend>Men&uacute;</legend>
	<table class="tabla_formulario">
		<tr>
			<th>Tipo de Alimento</th><th>Grupo</th><th>Total</th>
			<th>Des</th><th>CoM</th><th>Com</th><th>CoT</th><th>Cen</th>
		</tr>
		
		<?php $i = 0;
			foreach ($resultados as $r){
					
		?>
		<tr>
			<input type="hidden" name="id_<?php echo $i;?>" value="<?php echo $r->id;?>" />
			<td><?php echo $r->nombre;?><input type="hidden" size="10" name="nombre_<?php echo $i;?>" value="<?php echo $r->nombre;?>"</td>
			<td><?php 
					switch($r->recomendacion){
						case 'General': echo 'a';break;
						case 'Recomendado': echo 'b';break;
						case 'Prohibido': echo 'c';break;
						case 'Enfermedad': echo 'd';break;
					}
				?>
			</td>
			<td><input type="text" size="3" name="total_<?php echo $i;?>" value="<?php echo $r->total_tiempos;?>"></td>
			<td><input type="text" size="3" name="des_<?php echo $i;?>"" value="<?php echo $r->desayuno;?>"></td>
			<td><input type="text" size="3" name="co1_<?php echo $i;?>"" value="<?php echo $r->co1;?>"></td>
			<td><input type="text" size="3" name="com_<?php echo $i;?>"" value="<?php echo $r->comida;?>"></td>
			<td><input type="text" size="3" name="co2_<?php echo $i;?>"" value="<?php echo $r->co2;?>"></td>
			<td><input type="text" size="3" name="cen_<?php echo $i;?>"" value="<?php echo $r->cena;?>"></td>
		</tr>
		<?php $i++; } ?>
		
	</table>