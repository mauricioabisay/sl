	<legend>Men&uacute;</legend>
	<table class="tabla_formulario">
		<tr>
			<th>Tipo de Alimento</th><th>Grupo</th><th>Total</th>
			<th>Des</th><th>CoM</th><th>Com</th><th>CoT</th><th>Cen</th>
		</tr>
		<?php for ($i = 1; $i <= 17; $i++){
				switch($i){
					case 1:{
						$nombre = 'Cy T';
						$rec = 'a.';
					}break;
					case 2:{
						$nombre = '';
						$rec = 'b.';
					}break;
					case 3:{
						$nombre = 'Leguminosas';
						$rec = '';
					}break;
					case 4:{
						$nombre = 'Verduras';
						$rec = '';
					}break;
					case 5:{
						$nombre = 'Frutas';
						$rec = '';
					}break;
					case 6:{
						$nombre = 'A.O.A';
						$rec = 'a.';
					}break;
					case 7:{
						$nombre = '';
						$rec = 'b.';
					}break;
					case 8:{
						$nombre = '';
						$rec = 'c.';
					}break;
					case 9:{
						$nombre = '';
						$rec = 'd.';
					}break;
					case 10:{
						$nombre = 'Leche';
						$rec = 'a.';
					}break;
					case 11:{
						$nombre = '';
						$rec = 'b.';
					}break;
					case 12:{
						$nombre = '';
						$rec = 'c.';
					}break;
					case 13:{
						$nombre = '';
						$rec = 'd.';
					}break;
					case 14:{
						$nombre = 'Aceites y Grasas';
						$rec = 'a.';
					}break;
					case 15:{
						$nombre = '';
						$rec = 'b.';
					}break;
					case 16:{
						$nombre = 'Azucares';
						$rec = 'a.';
					}break;
					case 17:{
						$nombre = '';
						$rec = 'b.';
					}break;
				}
					
		?>
		<tr>
			<td><?php echo $nombre;?></td><td><?php echo $rec;?></td><td><input type="text" size="3" name="total_<?php echo $i;?>" value="<?php echo set_value('total_'.$i);?>"></td>
			<td><input type="text" size="3" name="des_<?php echo $i;?>"" value="<?php echo set_value('des_'.$i);?>"></td>
			<td><input type="text" size="3" name="co1_<?php echo $i;?>"" value="<?php echo set_value('co1_'.$i);?>"></td>
			<td><input type="text" size="3" name="com_<?php echo $i;?>"" value="<?php echo set_value('com_'.$i);?>"></td>
			<td><input type="text" size="3" name="co2_<?php echo $i;?>"" value="<?php echo set_value('co2_'.$i);?>"></td>
			<td><input type="text" size="3" name="cen_<?php echo $i;?>"" value="<?php echo set_value('cen_'.$i);?>"></td>
		</tr>
		<?php } ?>
		
	</table>