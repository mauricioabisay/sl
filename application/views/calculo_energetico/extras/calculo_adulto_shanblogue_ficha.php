<fieldset>
	<legend>Shanblogue <?php echo $shanblogue['total'];?> Kcal.</legend>
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
				<td><?php echo $shanblogue['geb_formula'];?></td>
				<td><?php echo $shanblogue['geb_sustitucion']?></td>
				<td><?php echo $shanblogue['geb'];?></td>
			</tr>
			<?php 
			foreach($variables as $variable){
				if(($variable->tipo=='actividad')&&($variable->formula=='shanblogue')){
			?>
					<tr>
						<td style="border: 0px">Energ&iacute;a de Actividad F&iacute;sica (EAF) <?php echo $variable->nombre;?>
							<!--<input type="button" onclick="$('#detalle_shanblogue_eaf').toggle(100)" value="+" style="display:inline" />-->
						</td>
						<td style="border: 0px"><?php echo $shanblogue['eaf_formula'];?></td>
						<td style="border: 0px"><?php echo $shanblogue['eaf_sustitucion'];?></td>
						<td style="border: 0px"><?php echo $shanblogue['eaf']?></td>
					</tr>
			<?php
				}
			}
			?>
<!--Preparado para poder poner mas de 1 actividad fisica en un calculo energetico-->
			<tr>
				<td colspan="4"><table id="detalle_shanblogue_eaf" class="listado_oculto" style="width: 100%">
					<tr>
						<th colspan="2">Detalle Energ&iacute;a de Actividad F&iacute;sica</th>
					</tr>
					<?php 
						foreach($variables as $variable){
							if(($variable->tipo=='actividad')&&($variable->formula=='shanblogue')){
					?>
						<tr>
							<td><?php echo $variable->nombre;?></td>
							<td><?php echo $variable->factor;?></td>
						</tr>
					<?php }}?>
					<tr>
						<td style="border: 0px">Subtotal</td>
						<td style="border: 0px"><?php echo $shanblogue['eaf'];?></td>
					</tr>
				</table></td>
			</tr>
<!--FIN del detalle de intensidad de actividad fisica-->
			<tr>
				<td style="border: 0px">Energ&iacute;a de Condiciones Estr&eacute;s (ECE)<input type="button" onclick="$('#detalle_shanblogue_ecs').toggle(100)" value="+" style="display:inline" /></td>
				<td style="border: 0px">&nbsp;</td>
				<td style="border: 0px">&nbsp;</td>
				<td style="border: 0px"><?php echo $shanblogue['ecs'];?></td>
			</tr>
<!--Detalle de ECS, ya que puede haber mas de una condicion-->
			<tr>
				<td colspan="4"><table id="detalle_shanblogue_ecs" class="listado_oculto" style="font-size:95%;width: 100%;margin-top: 0em;margin-bottom: 1em">
					<tr>
						<th colspan="4">Detalle Energ&iacute;a de Condiciones Estr&eacute;s</th>
					</tr>
					<tr>
						<th>Condici&oacute;n</th>
						<th>F&oacute;rmula</th>
						<th>Sustituci&oacute;n</th>
						<th>Kcal.</th>
					</tr>
					<?php 
						foreach($variables as $variable){
							if(($variable->tipo=='condicion')&&($variable->formula=='shanblogue')){
					?>
						<tr>
							<td><?php echo $variable->nombre;?></td>
							<td><?php echo $variable->factor;?>xGEB</td>
							<td><?php echo ''.$variable->factor.'x'.$shanblogue['geb'].'';?></td>
							<td><?php echo number_format($variable->factor*$shanblogue['geb'],2);?></td>
						</tr>
					<?php }}?>
					<tr>
						<td style="border: 0px">Subtotal</td>
						<td style="border: 0px">&nbsp;</td>
						<td style="border: 0px">&nbsp;</td>
						<td style="border: 0px"><?php echo $shanblogue['ecs'];?></td>
					</tr>			
				</table></td>
			</tr>
			<tr>
				<td>Total</td>
				<td>GEB + EAF + ECS</td>
				<td><?php echo ''.$shanblogue['geb'].' + '.$shanblogue['eaf'].' + '.$shanblogue['ecs'];?></td>
				<td><strong><?php echo $shanblogue['total'];?></strong></td>
			</tr>
		</tbody>
	</table>
</fieldset>