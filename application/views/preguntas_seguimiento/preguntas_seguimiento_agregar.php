<html>
<head>
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url();?>/assets/img/favicon.ico" />
	<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.ui.datepicker-es.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>
</head>
<body>
<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<form action="<?php echo site_url();?>/preguntas_seguimiento/agregar/<?php echo ''.$id_paciente.'/'.$id_evaluacion.'';?>" method="post" id="formulario" name="formulario">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<input type="hidden" name="evaluacion" value="<?php echo $id_evaluacion;?>" />
<fieldset>
	<legend>Preguntas de Seguimiento</legend>
	<fieldset>
		<legend>Experiencia Personal</legend>
		<div class="lineal">
			<label>&iquest;Siente que perdi&oacute; peso?</label>
			<label>S&iacute;</label><input type="radio" name="perdida_peso" value="Si" <?php echo set_radio('perdida_peso','Si');?>/>
			<label>No</label><input type="radio" name="perdida_peso"  value="No" <?php echo set_radio('perdida_peso','No');?>/>
			<?php echo form_error('perdida_peso');?>
		</div>
		<div class="lineal">
			<label>	&iquest;Qu&eacute; funciona tanto que no quiere modificar?</label>
			<input type="text" size="50" name="conservar" value="<?php echo set_value('conservar');?>"/>
			<?php echo form_error('conservar');?>
		</div>
		<div class="lineal">
			<label>&iquest;C&oacute;mo califica su cumplimiento de 0 a 10?</label>
			<select name="cumplimiento">
				<option value="" <?php echo set_select('cumplimiento','',TRUE);?>></option>
				<option value="0" <?php echo set_select('cumplimiento','0');?>>0</option>
				<option value="1" <?php echo set_select('cumplimiento','1');?>>1</option>
				<option value="2" <?php echo set_select('cumplimiento','2');?>>2</option>
				<option value="3" <?php echo set_select('cumplimiento','3');?>>3</option>
				<option value="4" <?php echo set_select('cumplimiento','4');?>>4</option>
				<option value="5" <?php echo set_select('cumplimiento','5');?>>5</option>
				<option value="6" <?php echo set_select('cumplimiento','6');?>>6</option>
				<option value="7" <?php echo set_select('cumplimiento','7');?>>7</option>
				<option value="8" <?php echo set_select('cumplimiento','8');?>>8</option>
				<option value="9" <?php echo set_select('cumplimiento','9');?>>9</option>
				<option value="10" <?php echo set_select('cumplimiento','10');?>>10</option>
			</select>
			<?php echo form_error('cumplimiento');?>
		</div>
		<div class="lineal">
			<label>Mencione del 0 al 10 su nivel de motivaci&oacute;n</label>
			<select name="motivacion">
				<option value="" <?php echo set_select('motivacion','',TRUE);?>></option>
				<option value="0" <?php echo set_select('motivacion','0');?>>0</option>
				<option value="1" <?php echo set_select('motivacion','1');?>>1</option>
				<option value="2" <?php echo set_select('motivacion','2');?>>2</option>
				<option value="3" <?php echo set_select('motivacion','3');?>>3</option>
				<option value="4" <?php echo set_select('motivacion','4');?>>4</option>
				<option value="5" <?php echo set_select('motivacion','5');?>>5</option>
				<option value="6" <?php echo set_select('motivacion','6');?>>6</option>
				<option value="7" <?php echo set_select('motivacion','7');?>>7</option>
				<option value="8" <?php echo set_select('motivacion','8');?>>8</option>
				<option value="9" <?php echo set_select('motivacion','9');?>>9</option>
				<option value="10" <?php echo set_select('motivacion','10');?>>10</option>
			</select>
			<?php echo form_error('motivacion');?>
		</div>
		<div class="lineal">
			<label>Mencione del 0 al 10 su nivel de desgaste</label>
			<select name="desgaste">
				<option value="" <?php echo set_select('desgaste','',TRUE);?>></option>
				<option value="0" <?php echo set_select('desgaste','0');?>>0</option>
				<option value="1" <?php echo set_select('desgaste','1');?>>1</option>
				<option value="2" <?php echo set_select('desgaste','2');?>>2</option>
				<option value="3" <?php echo set_select('desgaste','3');?>>3</option>
				<option value="4" <?php echo set_select('desgaste','4');?>>4</option>
				<option value="5" <?php echo set_select('desgaste','5');?>>5</option>
				<option value="6" <?php echo set_select('desgaste','6');?>>6</option>
				<option value="7" <?php echo set_select('desgaste','7');?>>7</option>
				<option value="8" <?php echo set_select('desgaste','8');?>>8</option>
				<option value="9" <?php echo set_select('desgaste','9');?>>9</option>
				<option value="10" <?php echo set_select('desgaste','10');?>>10</option>
			</select>
			<?php echo form_error('desgaste');?>
		</div>
		<div class="lineal">
			<label>&iquest;En qu&eacute; tiempo espera alcanzar su meta?</label>
			<input type="text" size="3" name="meta_fecha_valor"  value="<?php echo set_value('meta_fecha_valor');?>"/>
			<?php echo form_error('meta_fecha_valor');?>
			<select name="meta_fecha_unidad">
				<option value=""  <?php echo set_select('meta_fecha_unidad','',TRUE);?>></option>
				<option value="D"  <?php echo set_select('meta_fecha_unidad','D');?>>D&iacute;as</option>
				<option value="W"  <?php echo set_select('meta_fecha_unidad','W');?>>Semanas</option>
				<option value="M"  <?php echo set_select('meta_fecha_unidad','M');?>>Meses</option>
				<option value="Y"  <?php echo set_select('meta_fecha_unidad','Y');?>>A&ntilde;os</option>
			</select>
			<?php echo form_error('meta_fecha_unidad');?>
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;l es su meta establecida?</label>
			<input type="text" size="3" name="meta_valor" value="<?php echo set_value('meta_valor');?>"/><label>Kg.</label>
			<?php echo form_error('meta_valor');?>
		</div>
		<div class="lineal">
			<label>&iquest;Hizo las tareas establecidas?</label>
			<label>S&iacute;</label><input type="radio" name="hizo_tareas" value="Si" onclick='$("#ocultar_porque").toggle(!200)' <?php echo set_radio('hizo_tareas','Si');?>/>
			<label>No</label><input type="radio" name="hizo_tareas" value="No" onclick='$("#ocultar_porque").toggle(200)' <?php echo set_radio('hizo_tareas','No');?>/>
			<?php echo form_error('hizo_tareas');?>
		</div>
		<div class="lineal" id="ocultar_porque" <?php echo ($this->input->post('hizo_tareas')=='No')?'':'style="display:none"'?>>
			<label>&iquest;Porqu&eacute;?</label>
			<input type="text" size="50" name="tareas" value="<?php echo set_value('tareas');?>"/>
			<?php echo form_error('tareas');?>
		</div>
	</fieldset>
	<fieldset>
		<legend>Episodios</legend>
		<div class="lineal">
			<label>&iquest;Tuvo episodios de hambre(sensaci&oacute;n en est&oacute;mago)?</label>
			<label>S&iacute;</label><input type="radio" name="hambre" value="Si" onclick='$("#ocultar_hora_hambre").toggle(200)' <?php echo set_radio('hambre','Si');?>/>
			<label>No</label><input type="radio" name="hambre" value="No" onclick='$("#ocultar_hora_hambre").toggle(!200)' <?php echo set_radio('hambre','No');?>/>
			<?php echo form_error('hambre');?>
		</div>
		<div class="lineal" id="ocultar_hora_hambre" <?php echo ($this->input->post('hambre'))=='Si'?'':'style="display:none"';?>>
			<label>&iquest;A qu&eacute; hora?</label>
			<select name="hambre_horas">
				<option value="" <?php echo set_select('hambre_horas','',TRUE);?>></option>
				<option value="01" <?php echo set_select('hambre_horas','01');?>>01</option>
				<option value="02" <?php echo set_select('hambre_horas','02');?>>02</option>
				<option value="03" <?php echo set_select('hambre_horas','03');?>>03</option>
				<option value="04" <?php echo set_select('hambre_horas','04');?>>04</option>
				<option value="05" <?php echo set_select('hambre_horas','05');?>>05</option>
				<option value="06" <?php echo set_select('hambre_horas','06');?>>06</option>
				<option value="07" <?php echo set_select('hambre_horas','07');?>>07</option>
				<option value="08" <?php echo set_select('hambre_horas','08');?>>08</option>
				<option value="09" <?php echo set_select('hambre_horas','09');?>>09</option>
				<option value="10" <?php echo set_select('hambre_horas','10');?>>10</option>
				<option value="11" <?php echo set_select('hambre_horas','11');?>>11</option>
				<option value="12" <?php echo set_select('hambre_horas','12');?>>12</option>
			</select><?php echo form_error('hambre_horas');?>:
			<select name="hambre_minutos">
				<option value="" <?php echo set_select('hambre_minutos','',TRUE);?>></option>
				<option value="00" <?php echo set_select('hambre_minutos','00');?>>00</option>
				<option value="30" <?php echo set_select('hambre_minutos','30');?>>30</option>
			</select><?php echo form_error('hambre_minutos');?>
			<select name="hambre_ampm">
				<option value="" <?php echo set_select('hambre_ampm','',TRUE);?>></option>
				<option value="am" <?php echo set_select('hambre_ampm','am');?>>am</option>
				<option value="pm" <?php echo set_select('hambre_ampm','pm');?>>pm</option>
			</select><?php echo form_error('hambre_ampm');?>
			<select name="hambre_hora_relativa">
				<option value="" <?php echo set_select('hambre_hora_relativa','',TRUE);?>></option>
				<option value="m" <?php echo set_select('hambre_hora_relativa','m');?>>Ma&ntilde;ana</option>
				<option value="md" <?php echo set_select('hambre_hora_relativa','md');?>>Medio d&iacute;a</option>
				<option value="t" <?php echo set_select('hambre_hora_relativa','t');?>>Tarde</option>
				<option value="n" <?php echo set_select('hambre_hora_relativa','n');?>>Noche</option>
			</select><?php echo form_error('hambre_hora_relativa');?>
		</div>
		<div class="lineal">
			<label>&iquest;Tuvo episodios de ansiedad(sensaci&oacute;n en pecho, manos y boca)?</label>
			<label>S&iacute; </label><input type="radio" name="ansiedad"  value="Si" onclick='$("#ocultar_hora_ansiedad").toggle(200)' <?php echo set_radio('ansiedad','Si');?>/>
			<label>No</label><input type="radio" name="ansiedad" value="No" onclick='$("#ocultar_hora_ansiedad").toggle(!200)' <?php echo set_radio('ansiedad','No');?>/>
			<?php echo form_error('ansiedad');?>
		</div>
		<div class="lineal" id="ocultar_hora_ansiedad" <?php echo ($this->input->post('ansiedad'))=='Si'?'':'style="display:none"'?>;">
			<label>&iquest;A qu&eacute; hora?</label>
			<select name="ansiedad_horas">
					<option value="" <?php echo set_select('ansiedad_horas','',TRUE);?>></option>
					<option value="01" <?php echo set_select('ansiedad_horas','01');?>>01</option>
					<option value="02" <?php echo set_select('ansiedad_horas','02');?>>02</option>
					<option value="03" <?php echo set_select('ansiedad_horas','03');?>>03</option>
					<option value="04" <?php echo set_select('ansiedad_horas','04');?>>04</option>
					<option value="05" <?php echo set_select('ansiedad_horas','05');?>>05</option>
					<option value="06" <?php echo set_select('ansiedad_horas','06');?>>06</option>
					<option value="07" <?php echo set_select('ansiedad_horas','07');?>>07</option>
					<option value="08" <?php echo set_select('ansiedad_horas','08');?>>08</option>
					<option value="09" <?php echo set_select('ansiedad_horas','09');?>>09</option>
					<option value="10" <?php echo set_select('ansiedad_horas','10');?>>10</option>
					<option value="11" <?php echo set_select('ansiedad_horas','11');?>>11</option>
			</select><?php echo form_error('ansiedad_horas');?>:
			<select name="ansiedad_minutos">
				<option value="" <?php echo set_select('ansiedad_minutos','',TRUE);?>></option>
				<option value="00" <?php echo set_select('ansiedad_minutos','00');?>>00</option>
				<option value="30" <?php echo set_select('ansiedad_minutos','30');?>>30</option>
			</select><?php echo form_error('ansiedad_minutos');?>
			<select name="ansiedad_ampm">
				<option value="" <?php echo set_select('ansiedad_ampm','',TRUE);?>></option>
				<option value="am" <?php echo set_select('ansiedad_ampm','am');?>>am</option>
				<option value="pm" <?php echo set_select('ansiedad_ampm','pm');?>>pm</option>
			</select><?php echo form_error('ansiedad_ampm');?>
			<select name="ansiedad_hora_relativa">
				<option value="" <?php echo set_select('ansiedad_hora_relativa','',TRUE);?>></option>
				<option value="m" <?php echo set_select('ansiedad_hora_relativa','m');?>>Ma&ntilde;ana</option>
				<option value="md" <?php echo set_select('ansiedad_hora_relativa','md');?>>Medio d&iacute;a</option>
				<option value="t" <?php echo set_select('ansiedad_hora_relativa','t');?>>Tarde</option>
				<option value="n" <?php echo set_select('ansiedad_hora_relativa','n');?>>Noche</option>
			</select><?php echo form_error('ansiedad_hora_relativa');?>
		</div>
	</fieldset>
	<fieldset>
		<legend>Alimentaci&oacute;n</legend>
		<div class="lineal">
			<label>&iquest;Desea eliminar alg&uacute;n tiempo de comida?</label>
			<label>S&iacute;</label><input type="radio" name="eliminar_comida" value="Si" onclick='$("#ocultar_tipo_comida").toggle(200)' <?php echo set_radio('eliminar_comida','Si');?>/>
			<label>No</label> <input type="radio" name="eliminar_comida" value="No" onclick='$("#ocultar_tipo_comida").toggle(!200)' <?php echo set_radio('eliminar_comida','No');?>/>
			<?php echo form_error('eliminar_comida');?>
		</div>
		<div id="ocultar_tipo_comida" <?php echo ($this->input->post('eliminar_comida'))=='Si'?'':'style="display:none"'?>>
			<label>&iquest;Cu&aacute;l?<?php echo form_error('tiempo_eliminar');?></label>
			<div class="lineal">
				<label>Desayuno</label>
				<input type="checkbox" name="tiempo_eliminar[]" value="des" <?php echo set_checkbox('tiempo_eliminar','des');?> />
				<label>Colaci&oacute;n Ma&ntilde;ana</label>
				<input type="checkbox" name="tiempo_eliminar[]" value="co1" <?php echo set_checkbox('tiempo_eliminar','co1');?>/>
				<label>Comida</label>
				<input type="checkbox" name="tiempo_eliminar[]" value="com" <?php echo set_checkbox('tiempo_eliminar','com');?>/>
				<label>Colaci&oacute;n Tarde</label>
				<input type="checkbox" name="tiempo_eliminar[]" value="co2" <?php echo set_checkbox('tiempo_eliminar','co2');?>/>
				<label>Cena</label>
				<input type="checkbox" name="tiempo_eliminar[]" value="cen" <?php echo set_checkbox('tiempo_eliminar','cen');?>/>
			</div>
			<div class="lineal">
				<label>&iquest;Porqu&eacute;?</label>
				<input type="text" size="50" name="tiempo_eliminar_razon" value="<?php echo set_value('tiempo_eliminar_razon');?>"/>
				<?php echo form_error('tiempo_eliminar_razon');?>
			</div>
		</div>
		<div class="lineal">
			<label>&iquest;Desea aumentar alg&uacute;n tiempo de comida?</label>
			<label>S&iacute;</label> <input type="radio" name="agregar_comida" value="Si" onclick='$("#ocultar_agregar_comida").toggle(200)' <?php echo set_radio('agregar_comida','Si');?>/>
			<label>No</label><input type="radio" name="agregar_comida" value="No" onclick='$("#ocultar_agregar_comida").toggle(!200)' <?php echo set_radio('agregar_comida','No');?>/>
		</div>
		<div id="ocultar_agregar_comida" <?php echo ($this->input->post('aumentar_comida'))=='Si'?'':'style="display:none"'?>>
			<label>&iquest;Cu&aacute;l? </label>
			<div class="lineal">
				<label>Desayuno</label><input type="checkbox" name="tiempo_agregar[]" value="des" <?php echo set_checkbox('tiempo_agregar','des');?> />
				<label>Colaci&oacute;n Ma&ntilde;ana</label><input type="checkbox" name="tiempo_agregar[]" value="co1" <?php echo set_checkbox('tiempo_agregar','co1');?>/>
				<label>Comida</label><input type="checkbox" name="tiempo_agregar[]" value="com" <?php echo set_checkbox('tiempo_agregar','com');?>/>
				<label>Colaci&oacute;n Tarde</label><input type="checkbox" name="tiempo_agregar[]" value="co2" <?php echo set_checkbox('tiempo_agregar','co2');?>/>
				<label>Cena</label><input type="checkbox" name="tiempo_agregar[]" value="cen" <?php echo set_checkbox('tiempo_agregar','cen');?>/>
			</div>
			<div class="lineal">
				<label>&iquest;Porqu&eacute;? </label>
				<input type="text" size="50" name="tiempo_agregar_razon" value="<?php echo set_value('tiempo_agregar_razon');?>"/>
			</div>
		</div>
		<div class="lineal">
			<label>&iquest;Qu&eacute; alimentos quiere eliminar?</label>
			<input type="text" size="50" name="alimento_eliminar" value="<?php echo set_value('alimento_eliminar');?>"/>
		</div>
		<div class="lineal">
			<label>&iquest;Qu&eacute; alimentos quiere agregar?</label>
			<input type="text" size="50" name="alimento_agregar" value="<?php echo set_value('alimento_agregar');?>"/>
		</div>
	</fieldset>
	<fieldset>
		<legend>Ejercicio</legend>
		<div class="lineal">
			<label>&iquest;Hizo ejercicio?</label>
			<label>S&iacute;</label><input type="radio" name="ejercicio" value="Si" onclick='$("#ocultar_ejercicio").toggle(200)' <?php echo set_radio('ejercicio','Si');?>/>
			<label>No</label><input type="radio" name="ejercicio" value="No" onclick='$("#ocultar_ejercicio").toggle(!200)' <?php echo set_radio('ejercicio','No');?>/>
		</div>
		<div id="ocultar_ejercicio" <?php echo ($this->input->post('ejercicio')=='Si')?'':'style="display:none"'?>;">
		<div class="lineal">
			<label>&iquest;Cu&aacute;nto tiempo?</label>
			<input type="text" size="3" name="ejercicio_duracion" value="<?php echo set_value('ejercicio_duracion');?>"/><label>minutos</label>
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;ntos d&iacute;as de la semana?</label>
			<input type="text" size="3"  name="ejercicio_frec" value="<?php echo set_value('ejercicio_frec');?>"/><label>/7 d&iacute;as</label>
		</div>
		<div class="lineal">
			<label>&iquest;Qu&eacute; tipo de ejercicio realiz&oacute;?</label>
		</div>
		<table>
			<tr>
				<td align="right">Caminar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="caminar" <?php echo set_checkbox('ejercicio_tipo','caminar');?>/></td>
				<td align="right">Bailar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="bailar" <?php echo set_checkbox('ejercicio_tipo','bailar');?>/></td>
				<td align="right">Pesas</td><td><input type="checkbox" name="ejercicio_tipo[]" value="pesas" <?php echo set_checkbox('ejercicio_tipo','pesas');?>/></td>
			</tr>
			<tr>
				<td align="right">Trotar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="trotar" <?php echo set_checkbox('ejercicio_tipo','trotar');?>/></td>
				<td align="right">Correr</td><td><input type="checkbox" name="ejercicio_tipo[]" value="correr" <?php echo set_checkbox('ejercicio_tipo','correr');?>/></td>
				<td align="right">Box</td><td><input type="checkbox" name="ejercicio_tipo[]" value="box" <?php echo set_checkbox('ejercicio_tipo','box');?>/></td>
			</tr>
			<tr>
				<td align="right">Nadar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="nadar" <?php echo set_checkbox('ejercicio_tipo','nadar');?>/></td>
				<td align="right">Patinar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="patinar" <?php echo set_checkbox('ejercicio_tipo','patinar');?>/></td>
				<td align="right">Otro</td><td><input type="checkbox" name="ejercicio_tipo[]" value="otro" onclick='$("#otro_ejercicio").toggle(200)' <?php echo set_checkbox('ejercicio_tipo','otro');?>/></td>
				<td><div id="otro_ejercicio" class="lineal"
					<?php 
					$aux= $this->input->post('ejercicio_tipo');
					for($i=0;$i<sizeof($aux);$i++){
						if($aux[$i]== 'otro')echo '';
						else echo 'style="display:none"';
					}
					?>>
						<label>Especifique:</label>
						<input type="text" name="ejercicio_otro" value="<?php echo set_value('ejercicio_otro')?>"/>
				</div></td>
			</tr>
		</table>
		</div>
	</fieldset>
</fieldset>
<?php echo form_error('cumplimiento');?>
<?php echo form_error('hambre');?>
<?php echo form_error('hambre_horas');?>
<?php echo form_error('hambre_minutos');?>
<?php echo form_error('hambre_tiempo');?>
<?php echo form_error('hambre_hora_relativa');?>
<?php echo form_error('ansiedad');?>
<?php echo form_error('ansiedad_horas');?>
<?php echo form_error('ansiedad_minutos');?>
<?php echo form_error('ansiedad_tiempo');?>
<?php echo form_error('ansiedad_hora_relativa');?>
<?php echo form_error('perdida_peso');?>
<?php echo form_error('eliminar_comida');?>
<?php echo form_error('tiempo_eliminar');?>
<?php echo form_error('tiempo_eliminar_razon');?>
<?php echo form_error('aumentar_comida');?>
<?php echo form_error('tiempo_agregar');?>
<?php echo form_error('tiempo_agregar_razon');?>
<?php echo form_error('alimento_eliminar');?>
<?php echo form_error('alimento_agregar');?>
<?php echo form_error('conservar');?>
<?php echo form_error('motivacion');?>
<?php echo form_error('desgaste');?>
<?php echo form_error('meta_fecha');?>
<?php echo form_error('meta_valor');?>
<?php echo form_error('hizo_tareas');?>
<?php echo form_error('presentadas');?>
<?php echo form_error('tareas');?>
<?php echo form_error('ejercicio');?>
<?php echo form_error('ejercicio_duracion');?>
<?php echo form_error('ejercicio_frec');?>
<?php echo form_error('ejercicio_tipo');?>
<?php echo form_error('ejercicio_otro');?>
<div class="botones" align="center">
	<input type="submit" value="Guardar" />
	<input type="reset" value="Restaurar"/>
</div>
</form>
</body>
</html>