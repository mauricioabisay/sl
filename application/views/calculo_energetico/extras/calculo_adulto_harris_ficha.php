<fieldset>
	<legend>Harris-Benedict <?php echo $harris['total'];?> Kcal.</legend>
	<table class="listado" style="font-size:80%">
		<thead>
			<tr>
				<th>Gasto</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Kcal.</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Gasto Energ&eacute;tico Basal (GEB)</td>
				<td><?php echo $harris['geb_formula'];?></td>
				<td><?php echo $harris['geb_sustitucion'];?></td>
				<td><?php echo $harris['geb'];?></td>
			</tr>
			<tr>
				<td>Efecto T&eacute;rmico Alimentos (ETA)</td>
				<td><?php echo $harris['eta_formula'];?></td>
				<td><?php echo $harris['eta_sustitucion'];?></td>
				<td><?php echo $harris['eta'];?></td>
			</tr>
			<?php 
			foreach($variables as $variable){
				if(($variable->tipo=='actividad')&&($variable->formula=='harris')){
			?>
					<tr>
						<td style="border: 0px">Energ&iacute;a de Actividad F&iacute;sica (EAF) <?php echo $variable->nombre;?>
							<!--<input type="button" onclick="$('#detalle_harris_eaf').toggle(100)" value="+" style="display:inline" />-->
						</td>
						<td style="border: 0px"><?php echo $harris['eaf_formula'];?></td>
						<td style="border: 0px"><?php echo $harris['eaf_sustitucion'];?></td>
						<td style="border: 0px"><?php echo $harris['eaf']?></td>
					</tr>
			<?php
				}
			}
			?>
<!--Preparado para poder poner mas de 1 actividad fisica en un calculo energetico-->
			<tr>
				<td colspan="4"><table id="detalle_harris_eaf" class="listado_oculto" style="width: 100%">
					<tr>
						<th colspan="2">Detalle Energ&iacute;a de Actividad F&iacute;sica</th>
					</tr>
					<?php 
						foreach($variables as $variable){
							if(($variable->tipo=='actividad')&&($variable->formula=='harris')){
					?>
						<tr>
							<td><?php echo $variable->nombre;?></td>
							<td><?php echo $variable->factor;?></td>
						</tr>
					<?php }}?>
					<tr>
						<td style="border: 0px">Subtotal</td>
						<td style="border: 0px"><?php echo $harris['eaf'];?></td>
					</tr>
				</table></td>
			</tr>
<!--FIN del detalle de intensidad de actividad fisica-->
			<tr>
				<td style="border: 0px">Energ&iacute;a de Condiciones Especiales (ECS)<input type="button" onclick="$('#detalle_harris_ecs').toggle(100)" value="+" style="display:inline" /></td>
				<td style="border: 0px">&nbsp;</td>
				<td style="border: 0px">&nbsp;</td>
				<td style="border: 0px"><?php echo $harris['ecs'];?></td>
			</tr>
<!--Detalle de ECS, ya que puede haber mas de una condicion-->
			<tr>
				<td colspan="4"><table id="detalle_harris_ecs" class="listado_oculto" style="font-size:95%;width: 100%;margin-top: 0em;margin-bottom: 1em">
					<tr>
						<th colspan="4">Detalle Energ&iacute;a de Condiciones Especiales</th>
					</tr>
					<tr>
						<th>Condici&oacute;n</th>
						<th>F&oacute;rmula</th>
						<th>Sustituci&oacute;n</th>
						<th>Kcal.</th>
					</tr>
					<?php 
						foreach($variables as $variable){
							if(($variable->tipo=='condicion')&&($variable->formula=='harris')){
					?>
						<tr>
							<td><?php echo $variable->nombre;?></td>
							<td><?php echo $variable->factor;?>xGEB</td>
							<td><?php echo ''.$variable->factor.'x'.$harris['geb'].'';?></td>
							<td><?php echo number_format($variable->factor*$harris['geb'],2);?></td>
						</tr>
					<?php }}?>
					<tr>
						<td style="border: 0px">Subtotal</td>
						<td style="border: 0px">&nbsp;</td>
						<td style="border: 0px">&nbsp;</td>
						<td style="border: 0px"><?php echo $harris['ecs'];?></td>
					</tr>			
				</table></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>(GEBxFA) + ETA + EAF + ECS</td>
				<td><?php echo '('.$harris['geb'].'x'.$harris['fa'].') + '.$harris['eta'].' + '.$harris['eaf'].' + '.$harris['ecs'].'';?></td>
				<td><strong><?php echo $harris['total'];?></strong></td>
			</tr>
		</tbody>
	</table>
</fieldset>