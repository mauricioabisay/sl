<fieldset>	<label id="harris_geb_normal" style="display: none"><?php echo $harris_gasto_energetico_basal;?></label>
	<legend>Harris-Benedict</legend>
	<fieldset class="columnaizq">
		<legend>Variables</legend>
		<div class="lineal">
			<label>Factor de Actividad:</label>
			<select id="harris_factor_actividad" name="harris_factor_actividad" onchange="harris_geb()">
				<option value="1" label="1" <?php echo set_select('harris_factor_actividad','1',TRUE);?>>&nbsp;</option>
				<?php foreach($tabla_harris_factor as $factor){?>
					<option value="<?php echo $factor->id;?>" label="<?php echo $factor->valor_inf;?>" <?php echo set_select('harris_factor_actividad',$factor->id);?>><?php echo $factor->nombre;?></option>	
				<?php }?>
				
			</select>
			<?php echo form_error('harris_factor_actividad');?>
		</div>
		<div class="lineal">
			<label>Tipo de Actividad F&iacute;sica:</label>
			<select id="harris_actividad_fisica" name="harris_actividad_fisica" onchange="harris_actividad_fisica_default()">
				<option label="0-0" <?php echo set_select('harris_actividad_fisica','0',TRUE);?>>&nbsp;</option>
				<?php foreach($tabla_harris_actividad_fisica as $actividad){?>
						<option value="<?php echo $actividad->id;?>" 
							label="<?php echo ''.$actividad->valor_inf.'-'.$actividad->valor_sup.'';?>"
							<?php echo set_select('harris_actividad_fisica',$actividad->id);?> 
						>
							<?php echo ''.$actividad->nombre.' ('.($actividad->valor_inf)*(100).'%-'.($actividad->valor_sup)*(100).'%)';?>
						</option>
				<?php }?>
			</select>
			<?php echo form_error('harris_actividad_fisica');?>
			<input type="text" id="heaf" name="harris_actividad_fisica_factor" size="2" maxlength="3" onchange="harris_actividad_fisica_custom()" value="<?php echo set_value('harris_actividad_fisica_factor');?>" />
			<label>%</label>
			<?php echo form_error('harris_actividad_fisica_factor');?>
		</div>
		<div class="lineal">
			<label><strong>Tipo de Condiciones Especiales:</strong><input type="button" value="+" onclick='$("#harris_condiciones_especiales").toggle(100);' /></label>
		</div>
		<div id="harris_condiciones_especiales" style="display:none">
		<div class="columnaizq">
			<?php
				$i = 0;
				$total = sizeof($tabla_harris_condiciones_especiales);
				$mitad = intval($total/2);
				foreach($tabla_harris_condiciones_especiales as $condicion){
			?>
					<div class="lineal">
						<label style="float:left">
							<input type="checkbox" name="harris_condiciones_especiales[]" id="<?php echo $condicion->id;?>_ch"
							onclick="harris_condiciones_especiales('<?php echo $condicion->id;?>')" value="<?php echo $condicion->id;?>"
							<?php echo set_checkbox('harris_condiciones_especiales[]',$condicion->id);?> />
							<?php echo ''.$condicion->nombre.' ('.$condicion->valor_inf.'-'.$condicion->valor_sup.')';?>&nbsp;
						</label>
						<input type="text" id="<?php echo $condicion->id;?>" name="<?php echo $condicion->id;?>_factor" 
						maxlength="5" size="4" style="float:right;display:none"
						title="<?php echo "".$condicion->valor_inf."-".$condicion->valor_sup."";?>"
						onchange="harris_condiciones_especiales_custom(<?php echo $condicion->id;?>)"
						value="<?php echo set_value(''.$condicion->id.'_factor',0);?>"
						/>
						<?php echo form_error(''.$condicion->id.'_factor');?>
					</div>
			<?php
					$i++;
					echo ($i==$mitad)?'</div><div class="columnaizq">':'';
				}
			?>
		</div>
		</div>
	</fieldset>
	<fieldset class="columnader">
		<legend>Estimaci&oacute;n</legend>
		<table class="listado" style="font-size:80%">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th colspan="2">Predeterminado</th>
					<th>Estimado</th>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<th>L&iacute;m. Inf.</th>
					<th>L&iacute;m. Sup.</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Gasto Energ&eacute;tico Basal</td>
					<td>N/A</td>
					<td>N/A</td>
					<td><label id="harris_geb"><?php echo $harris_gasto_energetico_basal;?></label></td>
				</tr>
				<tr>
					<td>Efecto T&eacute;rmico Alimentos</td>
					<td>N/A</td>
					<td>N/A</td>
					<td><label id="harris_eta"><?php echo $harris_gasto_energetico_basal*.10;?></label></td>
				</tr>
				<tr>
					<td>Energ&iacute;a de Actividad F&iacute;sica</td>
					<td><i id="estimado_harris_actividad_fisica_inf">0</i></td>
					<td><i id="estimado_harris_actividad_fisica_sup">0</i></td>
					<td><label id="harris_eaf">0</i></td>
				</tr>
				<tr>
					<td>Energ&iacute;a de Condiciones Especiales</td>
					<td><i id="estimado_harris_condiciones_especiales_inf">0</i></td>
					<td><i id="estimado_harris_condiciones_especiales_sup">0</i></td>
					<td><label id="harris_ecs">0</i></td>
				</tr>
				<tr>
					<td>Total</td>
					<td><i><strong id="estimado_harris_total_inf">0</strong></i></td>
					<td><i><strong id="estimado_harris_total_sup">0</strong></i></td>
					<td><label><strong id="harris_total">0</strong></label></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</fieldset>