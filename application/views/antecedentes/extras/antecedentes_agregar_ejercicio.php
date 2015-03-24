<fieldset>
<legend>Ejercicio</legend>
<div class="lineal">
	<label>&iquest;Realiza ejercicio?</label>
		<label>S&iacute;</label><input type="radio" name="ejercicio" value="Si" onclick='$("#ocultar_ejercicio").toggle(200)' <?php echo set_radio('ejercicio','Si');?>/>
		<label>No</label><input type="radio" name="ejercicio" value="No" onclick='$("#ocultar_ejercicio").toggle(!200)'<?php echo set_radio('ejercicio','No');?>/>	
		<?php echo form_error('ejercicio');?>
</div>
<div id="ocultar_ejercicio" <?php echo ($this->input->post('ejercicio'))=='Si'?'':'style="display:none"'?>>
<?php $num = (isset($ejercicio_nombre))?sizeof($ejercicio_nombre):0;?>
	<table class="listado">
		<thead>
			<tr><th>Nombre</th><th>Tipo</th><th>Frecuencia</th><th>Duraci&oacute;n</th><th>F. Inicio</th></tr>
		</thead>
		<tbody>
			<tr id="ejercicio_0" align="center">
				<td><input type="text" name="ejercicio_nombre[]" size="15" maxlength="30" value="<?php echo (isset($ejercicio_nombre))?$ejercicio_nombre[0]:'';?>" /></td>
				<td>
					<select name="ejercicio_tipo[]">
						<option value="anaerobico" <?php echo ((isset($ejercicio_tipo))&&($ejercicio_tipo[0]=='anaerobico'))?'selected="selected"':'';?>>Aer&oacute;bico</option>
						<option value="aerobico" <?php echo ((isset($ejercicio_tipo))&&($ejercicio_tipo[0]=='aerobico'))?'selected="selected"':'';?>>Anaer&oacute;bico</option>
					</select>
				</td>
				<td class="lineal">
					<label>Veces </label>
					<input type="text" size="4" name="ejercicio_valor_frec[]" value="<?php echo (isset($ejercicio_valor_frec))?$ejercicio_valor_frec[0]:'';?>"/>
					<label> por </label>
					<select name="ejercicio_tipo_frec[]">
						<option value="diario" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[0]=='diario'))?'selected="selected"':'';?>>Por d&iacute;a</option>
						<option value="semanal" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[0]=='semanal'))?'selected="selected"':'';?>>Por semana</option>
						<option value="mensual" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[0]=='mensual'))?'selected="selected"':'';?>>Por mes</option>
						<option value="anual" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[0]=='anual'))?'selected="selected"':'';?>>Por a&ntilde;o</option>
					</select>			
				</td>
				<td class="lineal"><input type="text" size="4" name="ejercicio_duracion[]" value="<?php echo (isset($ejercicio_duracion))?$ejercicio_duracion[0]:'';?>"/> <label>minutos</label></td>
				<td class="lineal">
					<label>Mes </label>
					<select name="ejercicio_mes[]">
						<option value="1" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==1))?'selected="selected"':'';?>>Enero</option>
						<option value="2" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==2))?'selected="selected"':'';?>>Febrero</option>
						<option value="3" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==3))?'selected="selected"':'';?>>Marzo</option>
						<option value="4" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==4))?'selected="selected"':'';?>>Abril</option>
						<option value="5" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==5))?'selected="selected"':'';?>>Mayo</option>
						<option value="6" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==6))?'selected="selected"':'';?>>Junio</option>
						<option value="7" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==7))?'selected="selected"':'';?>>Julio</option>
						<option value="8" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==8))?'selected="selected"':'';?>>Agosto</option>
						<option value="9" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==9))?'selected="selected"':'';?>>Septiembre</option>
						<option value="10" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==10))?'selected="selected"':'';?>>Octubre</option>
						<option value="11" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==11))?'selected="selected"':'';?>>Noviembre</option>
						<option value="12" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[0]==12))?'selected="selected"':'';?>>Diciembre</option>
					</select>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="ejercicio_a[]" maxlength="4" value="<?php echo (isset($ejercicio_a))?$ejercicio_a[0]:'';?>"/>
					<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos_tabla"':'value="+" class="bt_mas_tabla"';?> />
				</td>
			</tr>
	<?php for($i=1;$i<$num;$i++){?>
	<tr id="ejercicio_<?php echo $i?>" align="center">
		<td><input type="text" name="ejercicio_nombre[]" size="15" maxlength="30" value="<?php echo (isset($ejercicio_nombre))?$ejercicio_nombre[$i]:'';?>" /></td>
		<td>
			<select name="ejercicio_tipo[]">
				<option value="anaerobico" <?php echo ((isset($ejercicio_tipo))&&($ejercicio_tipo[$i]=='anaerobico'))?'selected="selected"':'';?>>Aer&oacute;bico</option>
				<option value="aerobico" <?php echo ((isset($ejercicio_tipo))&&($ejercicio_tipo[$i]=='aerobico'))?'selected="selected"':'';?>>Anaer&oacute;bico</option>
			</select>
		</td>
		<td class="lineal">
			<label>Veces </label>
			<input type="text" size="4" name="ejercicio_valor_frec[]" value="<?php echo (isset($ejercicio_valor_frec))?$ejercicio_valor_frec[$i]:'';?>"/>
			<label> por </label>
			<select name="ejercicio_tipo_frec[]">
				<option value="diario" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[$i]=='diario'))?'selected="selected"':'';?>>Por d&iacute;a</option>
				<option value="semanal" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[$i]=='semanal'))?'selected="selected"':'';?>>Por semana</option>
				<option value="mensual" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[$i]=='mensual'))?'selected="selected"':'';?>>Por mes</option>
				<option value="anual" <?php echo ((isset($ejercicio_tipo_frec))&&($ejercicio_tipo_frec[$i]=='anual'))?'selected="selected"':'';?>>Por a&ntilde;o</option>
			</select>
		</td>
		<td class="lineal"><input type="text" size="4" name="ejercicio_duracion[]" value="<?php echo (isset($ejercicio_duracion))?$ejercicio_duracion[$i]:'';?>"/> <label>minutos</label></td>
		<td class="lineal">
			<label>Mes </label>
			<select name="ejercicio_mes[]">
				<option value="1" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==1))?'selected="selected"':'';?>>Enero</option>
				<option value="2" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==2))?'selected="selected"':'';?>>Febrero</option>
				<option value="3" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==3))?'selected="selected"':'';?>>Marzo</option>
				<option value="4" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==4))?'selected="selected"':'';?>>Abril</option>
				<option value="5" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==5))?'selected="selected"':'';?>>Mayo</option>
				<option value="6" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==6))?'selected="selected"':'';?>>Junio</option>
				<option value="7" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==7))?'selected="selected"':'';?>>Julio</option>
				<option value="8" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==8))?'selected="selected"':'';?>>Agosto</option>
				<option value="9" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==9))?'selected="selected"':'';?>>Septiembre</option>
				<option value="10" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==10))?'selected="selected"':'';?>>Octubre</option>
				<option value="11" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==11))?'selected="selected"':'';?>>Noviembre</option>
				<option value="12" <?php echo ((isset($ejercicio_mes))&&($ejercicio_mes[$i]==12))?'selected="selected"':'';?>>Diciembre</option>
			</select>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="ejercicio_a[]" maxlength="4" value="<?php echo (isset($ejercicio_a))?$ejercicio_a[$i]:'';?>"/>
			<input id="<?php echo $i;?>" type="button" <?php echo ($num>$i+1)?'value="-" class="bt_menos_tabla"':'value="+" class="bt_mas_tabla"';?> />
		</td>
	<?php }?>
	</tbody>
	</table>
</div>
		
</fieldset>