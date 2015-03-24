<html>
<head>
	<title>Preguntas de seguimiento</title>
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>

	<script>
		function desactivar_hambre(accion)
		{
			document.formulario.hambre_horas.disabled = accion;
			document.formulario.hambre_minutos.disabled = accion;
			document.formulario.hambre_tiempo.disabled = accion;
			document.formulario.hambre_hora_relativa.disabled = accion;
		}
		function desactivar_ansiedad(accion)
		{
			document.formulario.ansiedad_horas.disabled = accion;
			document.formulario.ansiedad_minutos.disabled = accion;
			document.formulario.ansiedad_tiempo.disabled = accion;
			document.formulario.ansiedad_hora_relativa.disabled = accion;
		}
		function desactivar_eliminar_comida(accion)
		{
			document.formulario.tiempo_eliminar.disabled = accion;
			document.formulario.tiempo_eliminar_razon.disabled = accion;
		}
		function desactivar_aumentar_comida(accion)
		{
			document.formulario.tiempo_agregar.disabled = accion;
			document.formulario.tiempo_agregar_razon.disabled = accion;
		}
		function desactivar_tareas(accion)
		{
			document.formulario.tareas.disabled = accion;
			document.formulario.presentadas[0].disabled = !accion;
			document.formulario.presentadas[1].disabled = !accion;
		}
		function desactivar_ejercicio(accion)
		{
			document.formulario.ejercicio_duracion.disabled = accion;
			document.formulario.ejercicio_frec.disabled = accion;
			for(i=0;i<=7;i++)
				document.formulario.ejercicio_tipo[i].disabled = accion;
			document.formulario.ejercicio_otro.disabled = accion;
		}
	</script>
</head>
<body>
	<form action="http://localhost/alumnos/index.php/alta/alta_preguntas_seg" method="post" id="formulario" name="formulario">
		<?php $fecha_dia = date ("d"); 
			  $fecha_mes = date ("m"); 
			  $fecha_year = date ("Y");
		?>
			  
	<div class="lineal">
		<label>Fecha:</label>
		<select name="fecha">
			<option><?php echo $fecha_dia."/".$fecha_mes."/".$fecha_year?></option>
		</select>
	</div>
	<fieldset>
		<legend>Preguntas de seguimiento</legend>
		<div class="lineal">
			<label>&iquest;C&oacute;mo califica su cumplimiento de 0 a 10?</label>
			<select name="cumplimiento">
				<option value="" <?php echo set_select('cumplimiento','');?>></option>
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
			</div>
			<div class="lineal">
				<label>&iquest;Tuvo episodios de hambre(sensaci&oacute;n en est&oacute;mago)?</label>
				<label>S&iacute;</label><input type="radio" name="hambre" value="si" onclick='$("#ocultar_hora_hambre").toggle(200)' <?php echo set_radio('hambre','si');?>/>
				<label>No</label><input type="radio" name="hambre" value="no" onclick='$("#ocultar_hora_hambre").toggle(!200)' <?php echo set_radio('hambre','no');?>/>
			</div>
			<div class="lineal" id="ocultar_hora_hambre" style="display: <?php echo ($this->input->post('hambre'))=='si'?'':'none'?>;">
				<label>&iquest;A qu&eacute; hora?</label>
				<select name="hambre_horas">
					<option value="" <?php echo set_select('hambre_horas','');?>></option>
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
				</select>:
				<select name="hambre_minutos">
					<option value="" <?php echo set_select('hambre_minutos','');?>></option>
					<option value="00" <?php echo set_select('hambre_minutos','00');?>>00</option>
					<option value="30" <?php echo set_select('hambre_minutos','30');?>>30</option>
				</select>
				<select name="hambre_tiempo">
					<option value="" <?php echo set_select('hambre_tiempo','');?>></option>
					<option value="am" <?php echo set_select('hambre_tiempo','am');?>>am</option>
					<option value="pm" <?php echo set_select('hambre_tiempo','pm');?>>pm</option>
				</select>
				<select name="hambre_hora_relativa">
					<option value="" <?php echo set_select('hambre_hora_relativa','');?>></option>
					<option value="m" <?php echo set_select('hambre_hora_relativa','m');?>>Ma&ntilde;ana</option>
					<option value="md" <?php echo set_select('hambre_hora_relativa','md');?>>Medio d&iacute;a</option>
					<option value="t" <?php echo set_select('hambre_hora_relativa','t');?>>Tarde</option>
					<option value="n" <?php echo set_select('hambre_hora_relativa','n');?>>Noche</option>
				</select>
		</div>
		<div class="lineal">
			<label>&iquest;Tuvo episodios de ansiedad(sensaci&oacute;n en pecho, manos y boca)?</label>
			<label>S&iacute; </label><input type="radio" name="ansiedad"  value="si" onclick='$("#ocultar_hora_ansiedad").toggle(200)' <?php echo set_radio('ansiedad','si');?>/>
			<label>No</label><input type="radio" name="ansiedad" value="no" onclick='$("#ocultar_hora_ansiedad").toggle(!200)' <?php echo set_radio('ansiedad','no');?>/>
		</div>
		<div class="lineal" id="ocultar_hora_ansiedad" style="display: <?php echo ($this->input->post('ansiedad'))=='si'?'':'none'?>;">
			<label>&iquest;A qu&eacute; hora?</label>
			<select name="ansiedad_horas">
					<option value="" <?php echo set_select('ansiedad_horas','');?>></option>
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
			</select>:
			<select name="ansiedad_minutos">
				<option value="" <?php echo set_select('ansiedad_minutos','');?>></option>
				<option value="00" <?php echo set_select('ansiedad_minutos','00');?>>00</option>
				<option value="30" <?php echo set_select('ansiedad_minutos','30');?>>30</option>
			</select>
			<select name="ansiedad_tiempo">
				<option value="" <?php echo set_select('ansiedad_tiempo','');?>></option>
				<option value="am" <?php echo set_select('ansiedad_tiempo','am');?>>am</option>
				<option value="pm" <?php echo set_select('ansiedad_tiempo','pm');?>>pm</option>
			</select>
			<select name="ansiedad_hora_relativa">
					<option value="" <?php echo set_select('ansiedad_hora_relativa','');?>></option>
					<option value="m" <?php echo set_select('ansiedad_relativa','m');?>>Ma&ntilde;ana</option>
					<option value="md" <?php echo set_select('ansiedad_hora_relativa','md');?>>Medio d&iacute;a</option>
					<option value="t" <?php echo set_select('ansiedad_hora_relativa','t');?>>Tarde</option>
					<option value="n" <?php echo set_select('ansiedad_hora_relativa','n');?>>Noche</option>
			</select>
		</div>
		<div class="lineal">
			<label>&iquest;Siente que perdi&oacute; peso?</label>
			<label>S&iacute;</label><input type="radio" name="perdida_peso" value="si" <?php echo set_radio('perdida_peso','si');?>/>
			<label>No</label><input type="radio" name="perdida_peso"  value="no" <?php echo set_radio('perdida_peso','no');?>/>
		</div>
		<div class="lineal">
			<label>&iquest;Desea eliminar alg&uacute;n tipo de comida?</label>
			<label>S&iacute;</label><input type="radio" name="eliminar_comida" value="si" onclick='$("#ocultar_tipo_comida").toggle(200)' <?php echo set_radio('eliminar_comida','si');?>/>
			<label>No</label> <input type="radio" name="eliminar_comida" value="no" onclick='$("#ocultar_tipo_comida").toggle(!200)' <?php echo set_radio('eliminar_comida','no');?>/>
		</div>
		<div class="lineal" id="ocultar_tipo_comida" style="display: <?php echo ($this->input->post('eliminar_comida'))=='si'?'':'none'?>;">
			<label>&iquest;Cu&aacute;l? </label>
			<table>
				<tr>
					<td align="right">Desayuno</td><td><input type="checkbox" name="tiempo_eliminar[]" value="des" <?php echo set_checkbox('tiempo_eliminar','des');?> /></td>
					<td align="right">Colaci&oacute;n 1</td><td><input type="checkbox" name="tiempo_eliminar[]" value="co1" <?php echo set_checkbox('tiempo_eliminar','co1');?>/></td>
					<td align="right">Comida</td><td><input type="checkbox" name="tiempo_eliminar[]" value="com" <?php echo set_checkbox('tiempo_eliminar','com');?>/></td>
					<td align="right">Colaci&oacute;n 2</td><td><input type="checkbox" name="tiempo_eliminar[]" value="co2" <?php echo set_checkbox('tiempo_eliminar','co2');?>/></td>
					<td align="right">Cena</td><td><input type="checkbox" name="tiempo_eliminar[]" value="cen" <?php echo set_checkbox('tiempo_eliminar','cen');?>/></td>
				</tr>
			</table>
			<label>&iquest;Porqu&eacute;? </label>
			<input type="text" size="50" name="tiempo_eliminar_razon" value="<?php echo set_value('tiempo_eliminar_razon');?>"/>
		</div>
		<div class="lineal">
			<label>&iquest;Desea aumentar alg&uacute;n tipo de comida?</label>
			<label>S&iacute;</label> <input type="radio" name="aumentar_comida" value="si" onclick='$("#ocultar_agregar_comida").toggle(200)' <?php echo set_radio('aumentar_comida','si');?>/>
			<label>No</label><input type="radio" name="aumentar_comida" value="no" onclick='$("#ocultar_agregar_comida").toggle(!200)' <?php echo set_radio('aumentar_comida','no');?>/>
		</div>
		<div class="lineal" id="ocultar_agregar_comida" style="display: <?php echo ($this->input->post('aumentar_comida'))=='si'?'':'none'?>;">
			<label>&iquest;Cu&aacute;l? </label>
			<table>
				<tr>
					<td align="right">Desayuno</td><td><input type="checkbox" name="tiempo_agregar[]" value="des" <?php echo set_checkbox('tiempo_agregar','des');?> /></td>
					<td align="right">Colaci&oacute;n 1</td><td><input type="checkbox" name="tiempo_agregar[]" value="co1" <?php echo set_checkbox('tiempo_agregar','co1');?>/></td>
					<td align="right">Comida</td><td><input type="checkbox" name="tiempo_agregar[]" value="com" <?php echo set_checkbox('tiempo_agregar','com');?>/></td>
					<td align="right">Colaci&oacute;n 2</td><td><input type="checkbox" name="tiempo_agregar[]" value="co2" <?php echo set_checkbox('tiempo_agregar','co2');?>/></td>
					<td align="right">Cena</td><td><input type="checkbox" name="tiempo_agregar[]" value="cen" <?php echo set_checkbox('tiempo_agregar','cen');?>/></td>
				</tr>
			</table>
			<label>&iquest;Porqu&eacute;? </label>
			<input type="text" size="50" name="tiempo_agregar_razon" value="<?php echo set_value('tiempo_agregar_razon');?>"/>
		</div>
		<div class="lineal">
			<label>&iquest;Qu&eacute; alimentos quiere eliminar?</label>
			<input type="text" size="50" name="alimento_eliminar" value="<?php echo set_value('alimento_eliminar');?>"/>
		</div>
		<div class="lineal">
			<label>&iquest;Qu&eacute; alimentos quiere agregar?</label>
			<input type="text" size="50" name="alimento_agregar" value="<?php echo set_value('alimento_agregar');?>"/>
		</div>
		<div class="lineal">
			<label>	&iquest;Qu&eacute; funciona tanto que no quiere modificar?</label>
			<input type="text" size="50" name="conservar" value="<?php echo set_value('conservar');?>"/>
		</div>
		<div class="lineal">
			<label>Mencione del 0 al 10 su nivel de motivaci&oacute;n</label>
			<select name="motivacion">
				<option value="" <?php echo set_select('motivacion','');?>></option>
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
		</div>
		<div class="lineal">
			<label>Mencione del 0 al 10 su nivel de desgaste</label>
			<select name="desgaste">
				<option value="" <?php echo set_select('desgaste','');?>></option>
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
		</div>
		<div class="lineal">
			<label>&iquest;En qu&eacute; tiempo espera alcanzar su meta?</label>
			<input type="text" size="3" name="meta_fecha"  value="<?php echo set_value('meta_fecha');?>"/>
			<select name="meta_tiempo">
				<option value=""  <?php echo set_select('meta_tiempo','');?>></option>
				<option value="d"  <?php echo set_select('meta_tiempo','d');?>>d&iacute;as</option>
				<option value="m"  <?php echo set_select('meta_tiempo','m');?>>meses</option>
				<option value="a"  <?php echo set_select('meta_tiempo','a');?>>a&ntilde;os</option>
			</select>
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;l es su meta establecida?</label>
			<input type="text" size="3" name="meta_valor" value="<?php echo set_value('meta_valor');?>"/><label>Kg.</label>
		</div>
		<div class="lineal">
			<label>&iquest;Hizo las tareas establecidas?</label>
			<label>S&iacute;</label><input type="radio" name="hizo_tareas" value="si" onclick='$("#ocultar_presentadas").toggle(200)' <?php echo set_radio('hizo_tareas','si');?>/>
			<label>No</label><input type="radio" name="hizo_tareas" value="no" onclick='$("#ocultar_presentadas").toggle(200);$("#ocultar_porque").toggle(200)' <?php echo set_radio('hizo_tareas','no');?>/>
			<div id="ocultar_presentadas" style="display: <?php echo ($this->input->post('hizo_tareas')=='si')?'':'none'?>;">
			<label>&iquest;Fueron presentadas?</label>
			<label>S&iacute;</label><input type="radio" name="presentadas" value="si" onclick='$("#ocultar_porque").toggle(!200)'<?php echo set_radio('presentadas','si');?>/>
			<label>No</label><input type="radio" name="presentadas" value="no" onclick='$("#ocultar_porque").toggle(200)'<?php echo set_radio('presentadas','no');?>/>
			</div>
		</div>
		<div class="lineal" id="ocultar_porque" style="display: <?php echo ($this->input->post('hizo_tareas')=='no'||$this->input->post('presentadas')=='no')?'':'none'?>;">
			<label>&iquest;Porqu&eacute;?</label>
			<input type="text" size="50" name="tareas" value="<?php echo set_value('tareas');?>"/>
		</div>
		<div class="lineal">
			<label>&iquest;Hizo ejercicio?</label>
			<label>S&iacute;</label><input type="radio" name="ejercicio" value="si" onclick='$("#ocultar_ejercicio").toggle(200)' <?php echo set_radio('ejercicio','si');?>/>
			<label>No</label><input type="radio" name="ejercicio" value="no" onclick='$("#ocultar_ejercicio").toggle(!200)' <?php echo set_radio('ejercicio','no');?>/>
		</div>
		<div id="ocultar_ejercicio" style="display: <?php echo ($this->input->post('ejercicio')=='si')?'':'none'?>;">
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
		<div>
			<table>
				<tr>
					<td align="right">caminar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="caminar" <?php echo set_checkbox('ejercicio_tipo','caminar');?>/></td>
					<td align="right">bailar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="bailar" <?php echo set_checkbox('ejercicio_tipo','bailar');?>/></td>
					<td align="right">pesas</td><td><input type="checkbox" name="ejercicio_tipo[]" value="pesas" <?php echo set_checkbox('ejercicio_tipo','pesas');?>/></td>
				</tr>
				<tr>
					<td align="right">trotar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="trotar" <?php echo set_checkbox('ejercicio_tipo','trotar');?>/></td>
					<td align="right">correr</td><td><input type="checkbox" name="ejercicio_tipo[]" value="correr" <?php echo set_checkbox('ejercicio_tipo','correr');?>/></td>
					<td align="right">box</td><td><input type="checkbox" name="ejercicio_tipo[]" value="box" <?php echo set_checkbox('ejercicio_tipo','box');?>/></td>
				</tr>
				<tr>
					<td align="right">nadar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="nadar" <?php echo set_checkbox('ejercicio_tipo','nadar');?>/></td>
					<td align="right">patinar</td><td><input type="checkbox" name="ejercicio_tipo[]" value="patinar" <?php echo set_checkbox('ejercicio_tipo','patinar');?>/></td>
					<td align="right">otro:</td><td><input type="checkbox" name="ejercicio_tipo[]" value="otro" onclick='$("#otro_ejercicio").toggle(200)' <?php echo set_checkbox('ejercicio_tipo','otro');?>/></td>
					<td>
							<div id="otro_ejercicio" class="lineal"
									style="display:<?php 
										$aux= $this->input->post('ejercicio_tipo');
										for($i=0;$i<sizeof($aux);$i++)
										{
											if ($aux[$i]== 'otro')
												echo '';
											else
												echo 'none';
										}
									?>">
								<label>Especifique:</label>
								<input type="text" name="ejercicio_otro" value="<?php echo set_value('ejercicio_otro')?>"/>
							</div>	
					</td>
				</tr>
			</table>
			
		</div>
		</div>
	</fieldset>
		<?php echo form_error('cumplimiento')?>
		<?php echo form_error('hambre')?>
		<?php echo form_error('hambre_horas')?>
		<?php echo form_error('hambre_minutos')?>
		<?php echo form_error('hambre_tiempo')?>
		<?php echo form_error('hambre_hora_relativa')?>
		<?php echo form_error('ansiedad')?>
		<?php echo form_error('ansiedad_horas')?>
		<?php echo form_error('ansiedad_minutos')?>
		<?php echo form_error('ansiedad_tiempo')?>
		<?php echo form_error('ansiedad_hora_relativa')?>
		<?php echo form_error('perdida_peso')?>
		<?php echo form_error('eliminar_comida')?>
		<?php echo form_error('tiempo_eliminar')?>
		<?php echo form_error('tiempo_eliminar_razon')?>
		<?php echo form_error('aumentar_comida')?>
		<?php echo form_error('tiempo_agregar')?>
		<?php echo form_error('tiempo_agregar_razon')?>
		<?php echo form_error('alimento_eliminar')?>
		<?php echo form_error('alimento_agregar')?>
		<?php echo form_error('conservar')?>
		<?php echo form_error('motivacion')?>
		<?php echo form_error('desgaste')?>
		<?php echo form_error('meta_fecha')?>
		<?php echo form_error('meta_valor')?>
		<?php echo form_error('hizo_tareas')?>
		<?php echo form_error('presentadas')?>
		<?php echo form_error('tareas')?>
		<?php echo form_error('ejercicio')?>
		<?php echo form_error('ejercicio_duracion')?>
		<?php echo form_error('ejercicio_frec')?>
		<?php echo form_error('ejercicio_tipo')?>
		<?php echo form_error('ejercicio_otro')?>
		
	<div class="botones" align="center">
		<input type="submit" value="Guardar y salir" />
		<input type="submit" value="Cancelar"/>
	</div>	
	</form>
</body>
</html>

