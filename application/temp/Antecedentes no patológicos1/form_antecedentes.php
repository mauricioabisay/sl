<html>
<head>
	
	<title>Antecedentes no patol&oacute;gicos</title>
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>

</head>
<body>
	
	<form action="http://localhost/alumnos/index.php/alta/alta_antecedentes" method="post" id="formulario" name="formulario">
		
	Paciente:<input type="text" name="paciente"/>
	<fieldset>
		<legend>Consumo de alcohol</legend>
			
			<div class="lineal">
				<label>&iquest;Consume alcohol?</label>
				<label>S&iacute;</label><input type="radio" name="alcohol" value="si"  onclick='$("#ocultar_alcohol").toggle(200)' <?php echo set_radio('alcohol','si');?>//>
				<label>No</label><input type="radio" name="alcohol" value="no"  onclick='$("#ocultar_alcohol").toggle(!200)'<?php echo set_radio('alcohol','no');?>/>
			</div>
			<div class="lineal" id="ocultar_alcohol" style="display: <?php echo ($this->input->post('alcohol'))=='si'?'':'none'?>;">
			<div>
				<label>&iquest;Con qu&eacute; frecuencia?</label>
				<input type="text" size="4" name="alcohol_valor_frec" value="<?php echo set_value('alcohol_valor_frec');?>"/>
				<select name="alcohol_tipo_frec" >
						<option <?php echo set_select('alcohol_tipo_frec','');?>></option>
						<option value="semanal" <?php echo set_select('alcohol_tipo_frec','semanal');?>>Por semana</option> 
						<option value="mensual" <?php echo set_select('alcohol_tipo_frec','mensual');?>>Por mes</option> 
						<option value="anual" <?php echo set_select('alcohol_tipo_frec','anual');?>>Por a&ntilde;o</option> 
				</select>
			</div>
			<label>&iquest;Cu&aacute;ntas copas consume por salida?</label>
			<div>
				<table>
					<tr>
						<td><label>De 1 a 3 copas</label></td>
						<td><input type="radio" name="copas" value="1-3"<?php echo set_radio('copas','1-3');?> /></td>
					</tr>
					<tr>
						<td><label>De 4 a 8 copas</label></td>
						<td><input type="radio" name="copas" value="4-8"<?php echo set_radio('copas','4-8');?> /></td>
					</tr>
					<tr>
						<td><label>De 9 a 15 copas</label></td>
						<td><input type="radio" name="copas" value="9-15"<?php echo set_radio('copas','9-15');?> /></td>
					</tr>
					<tr>
						<td><label>M&aacute;s de 15 copas</label></td>
						<td><input type="radio" name="copas" value="+15"<?php echo set_radio('copas','+15');?> /></td>
					</tr>
				</table>
			</div>
			
			<label>&iquest;Qu&eacute; tipo de alcohol consume?</label>
			<div>
				<table>
					<tr>
						<td><label>Vodka</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="vodka" <?php echo set_checkbox('alcohol_tipo','vodka');?> /></td>
					
						<td><label>Brandy</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="brandy" <?php echo set_checkbox('alcohol_tipo','brandy');?> /></td>
					</tr>
					<tr>
						<td><label>Ron</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="ron" <?php echo set_checkbox('alcohol_tipo','ron');?> /></td>
					
						<td><label>Tequila</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="tequila" <?php echo set_checkbox('alcohol_tipo','tequila');?> /></td>
					</tr>
					<tr>
						<td><label>Cerveza</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="cerveza" <?php echo set_checkbox('alcohol_tipo','cerveza');?> /></td>
					
						<td><label>Vino</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="vino" <?php echo set_checkbox('alcohol_tipo','vino');?> /></td>
					</tr>
					<tr>
						<td><label>Cockteler&iacute;a</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="cockteleria" <?php echo set_checkbox('alcohol_tipo','cockteleria');?> /></td>
					
						<td><label>Otro</label></td>
						<td><input type="checkbox" name="alcohol_tipo[]" value="otro" onclick='$("#otro_alcohol").toggle(200)'<?php echo set_checkbox('alcohol_tipo','otro');?>/></td>
						
						<td>
							<div id="otro_alcohol"   
									style="display:<?php 
										$aux= $this->input->post('alcohol_tipo');
										for($i=0;$i<sizeof($aux);$i++)
										{
											if ($aux[$i]== 'otro')
												echo '';
											else
												echo 'none';
										}
									?>;">
								<label>Especifique:</label>
								<input type="text" name="alcohol_otro" />
							</div>	
						</td>
					</tr>
					</table> 
								
			</div>
			</div>						
	</fieldset>
	
		<?php echo form_error('alcohol')?>
		<?php echo form_error('alcohol_valor_frec')?>
		<?php echo form_error('alcohol_tipo_frec')?>
		<?php echo form_error('copas')?>
		<?php echo form_error('alcohol_tipo')?>
		<?php echo form_error('alcohol_otro')?>
		
	<fieldset>		
		<legend>Consumo de cigarro</legend>
		<div class="lineal">
			<label>&iquest;Fuma?</label>
			<label>S&iacute;</label><input type="radio" name="fuma" value="si" onclick='$("#ocultar_fuma").toggle(200)' <?php echo set_radio('fuma','si');?>/>
			<label>No</label><input type="radio" name="fuma" value="no" onclick='$("#ocultar_fuma").toggle(!200)' <?php echo set_radio('fuma','no');?>/>
		</div>
		<div id="ocultar_fuma" style="display: <?php echo ($this->input->post('fuma'))=='si'?'':'none'?>;">
			<div class="lineal">
			<label>&iquest;Desde cu&aacute;ndo fuma?</label>
			<input type="text" size="4" name="fuma_valor" value="<?php echo set_value('fuma_valor');?>" />
			<select name="fuma_tiempo" >
				<option  value=""<?php echo set_select('fuma_tiempo','');?>></option>
				<option value="d"<?php echo set_select('fuma_tiempo','d');?>>d&iacute;as</option>
				<option value="m"<?php echo set_select('fuma_tiempo','m');?>>meses</option>
				<option value="a"<?php echo set_select('fuma_tiempo','a');?>>a&ntilde;os</option>
			</select>	
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;ntos cigarros fuma?</label>
			<input type="text" size="4" name="cigarros" value="<?php echo set_value('cigarros');?>"/>
			<select name="fuma_tipo_frec" >
						<option value=""<?php echo set_select('fuma_tipo_frec','');?>></option>
						<option value="diario"<?php echo set_select('fuma_tipo_frec','diario');?>>Por d&iacute;a</option>
						<option value="semanal"<?php echo set_select('fuma_tipo_frec','semanal');?>>Por semana</option> 
						<option value="mensual"<?php echo set_select('fuma_tipo_frec','mensual');?>>Por mes</option> 
			</select>
		</div>
		</div>	
	</fieldset>
		<?php echo form_error('fuma')?>
		<?php echo form_error('fuma_valor')?>
		<?php echo form_error('fuma_tiempo')?>
		<?php echo form_error('cigarros')?>
		<?php echo form_error('fuma_tipo_frec')?>
	<fieldset>
		<legend>Ejercicio</legend>
		<div class="lineal">
			<label>&iquest;Realiza ejercicio?</label>
			<label>S&iacute;</label><input type="radio" name="ejercicio" value="si" onclick='$("#ocultar_ejercicio").toggle(200)' <?php echo set_radio('ejercicio','si');?>/>
			<label>No</label><input type="radio" name="ejercicio" value="no" onclick='$("#ocultar_ejercicio").toggle(!200)'<?php echo set_radio('ejercicio','no');?>/>
		</div>
		<div id="ocultar_ejercicio" style="display: <?php echo ($this->input->post('ejercicio'))=='si'?'':'none'?>;">
			
		<div class="lineal">
			<label>Veces:</label><input type="text" size="4" name="ejercicio_valor_frec" value="<?php echo set_value('ejercicio_valor_frec');?>"/>
			<select name="ejercicio_tipo_frec">
				<option value=""<?php echo set_select('ejercicio_tipo_frec','');?>></option>
				<option value="diario"<?php echo set_select('ejercicio_tipo_frec','diario');?>>Por d&iacute;a</option>
				<option value="semanal"<?php echo set_select('ejercicio_tipo_frec','semanal');?>>Por semana</option>
				<option value="mensual"<?php echo set_select('ejercicio_tipo_frec','mensual');?>>Por mes</option>
				<option value="anual"<?php echo set_select('ejercicio_tipo_frec','anual');?>>Por a&ntilde;o</option>
			</select>
		</div>
		<div class="lineal">
			<label>Tiempo:</label><input type="text" size="4" name="duracion" value="<?php echo set_value('duracion');?>"/><label>minutos</label>
		</div>
		<div class="lineal">
			<label>Tipo:</label>
			<div>
				<table>
					<tr>
						<td><label>Caminar</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="caminar" <?php echo set_checkbox('ejercicio_tipo','caminar');?> /></td>
					
						<td><label>Trotar</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="trotar" <?php echo set_checkbox('ejercicio_tipo','trotar');?> /></td>
					</tr>
					<tr>
						<td><label>Correr</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="correr" <?php echo set_checkbox('ejercicio_tipo','correr');?> /></td>
					
						<td><label>Nadar</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="nadar" <?php echo set_checkbox('ejercicio_tipo','nadar');?> /></td>
					</tr>
					<tr>
						<td><label>Pesas</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="pesas" <?php echo set_checkbox('ejercicio_tipo','pesas');?> /></td>
					
						<td><label>Box</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="box" <?php echo set_checkbox('ejercicio_tipo','box');?> /></td>
					</tr>
					<tr>
						<td><label>Bailar</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="bailar" <?php echo set_checkbox('ejercicio_tipo','bailar');?> /></td>
					
						<td><label>Otro</label></td>
						<td><input type="checkbox" name="ejercicio_tipo[]" value="otro" onclick='$("#otro_ejercicio").toggle(200)'<?php echo set_checkbox('ejercicio_tipo','otro');?> /></td>
					
						<td>
							<div id="otro_ejercicio" style="display:<?php 
										$aux= $this->input->post('ejercicio_tipo');
										for($i=0;$i<sizeof($aux);$i++)
										{
											if ($aux[$i]== 'otro')
												echo '';
											else
												echo 'none';
										}
									?>;">
								<label>Especifique:</label>
								<input type="text" name="ejercicio_otro" />
							</div>	
						</td>
					</tr>
					</table> 
								
				
			</div>			
		</div>
		</div>
		
	</fieldset>	
		<?php echo form_error('ejercicio')?>
		<?php echo form_error('ejercicio_tipo')?>
		<?php echo form_error('ejercicio_valor_frec')?>
		<?php echo form_error('duracion')?>
	<fieldset>
		<legend>Embarazo</legend>
		<div class="lineal">
			<label>S&iacute;</label><input type="radio" name="embarazo" value="si" onclick='$("#ocultar_embarazo").toggle(200)' <?php echo set_radio('embarazo','si');?>/>
			<label>No</label><input type="radio" name="embarazo"  value="no" onclick='$("#ocultar_embarazo").toggle(!200)'<?php echo set_radio('embarazo','no');?>/>
		</div>
		<div id="ocultar_embarazo" style="display: <?php echo ($this->input->post('embarazo'))=='si'?'':'none'?>;">
		<div class="lineal">
			<label>Lactancia</label>
			<label>S&iacute;</label><input type="radio" name="lactancia" value="si"<?php echo set_radio('lactancia','si');?>/>
			<label>No</label><input type="radio" name="lactancia" value="no"<?php echo set_radio('lactancia','no');?> />
		</div>
		<div class="lineal">
			<label>N&uacute;mero de gesta</label><input type="text" size="3" name="gesta" value="<?php echo set_value('gesta');?>" />
		</div>
		<div class="lineal">
			<label>N&uacute;mero de semanas de embarazo</label><input type="text" size="3" name="semana" value="<?php echo set_value('semana');?>"/>
		</div>
		</div>
	</fieldset>	
		<?php echo form_error('embarazo')?>
		<?php echo form_error('gesta')?>
		<?php echo form_error('semana')?>
		<?php echo form_error('lactancia')?>
	<div class="botones" align="center">
		<input type="submit" value="Guardar y salir" />
		<input type="reset" value="Cancelar"/>
	</div>			
	</form>
</body>
</html>
		


