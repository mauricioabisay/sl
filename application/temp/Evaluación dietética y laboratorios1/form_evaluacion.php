<html>
<head>
	
	<title>Evaluaci&oacute;n diet&eacute;tica</title>
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>
		
</head>
<body>
	<form action="http://localhost/alumnos/index.php/alta/alta_evaluacion_dietetica" method="post" id="formulario" name="formulario">
		
	<?php $num = (isset($error))?set_value('contador'):0;//Obtenemos el valor de campos que agregamos?>
	<fieldset>
		<legend>Recordatorio de 24 horas</legend>
		<label>Narre lo que comi&oacute; el d&iacute;a anterior(si fue ordinario)</label>
		
		<div id="div_1"  class="lineal">		
			<label>Tiempo</label>
			<select name="tiempo[]">
				<option value="" <?php echo ((isset($tiempo))&&($tiempo[0]==""))?'selected="selected"':'';?>></option>
				<option value="des" <?php echo ((isset($tiempo))&&($tiempo[0]=="des"))?'selected="selected"':'';?>>Desayuno</option>
				<option value="co1" <?php echo ((isset($tiempo))&&($tiempo[0]=="co1"))?'selected="selected"':'';?>>Colaci&oacute;n 1</option>
				<option value="com" <?php echo ((isset($tiempo))&&($tiempo[0]=="com"))?'selected="selected"':'';?>>Comida</option>
				<option value="co2" <?php echo ((isset($tiempo))&&($tiempo[0]=="co2"))?'selected="selected"':'';?>>Colaci&oacute;n 2</option>
				<option value="cen" <?php echo ((isset($tiempo))&&($tiempo[0]=="cen"))?'selected="selected"':'';?>>Cena</option>
			</select>
			<label>Alimento</label><input type="text" name="alimento[]" value="<?php echo (isset($alimento))?''.$alimento[0].'':'';?>" />
			<label>Cantidad</label><input type="text" name="cantidad[]" size="5" value="<?php echo (isset($cantidad))?''.$cantidad[0].'':'';?>" />
			<label>Kcal</label>	<input type="text" name="kcal[]" value="<?php echo (isset($kcal))?''.$kcal[0].'':'';?>"/>
			<input  id="1" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />		
		</div>
			<?php
					for ($i=1;$i <= $num; $i++){?>
					<div id="div_<?php echo $i;?>" class="lineal">
						<label>Tiempo:</label>
						<select name="tiempo[]">
							<option value="des"<?php echo ((isset($tiempo))&&($tiempo[$i]=="des"))?'selected="selected"':'';?>>Desayuno</option>
							<option value="co1"<?php echo ((isset($tiempo))&&($tiempo[$i]=="co1"))?'selected="selected"':'';?>>Colaci&oacute;n 1</option>
							<option value="com"<?php echo ((isset($tiempo))&&($tiempo[$i]=="com"))?'selected="selected"':'';?>>Comida</option>
							<option value="co2"<?php echo ((isset($tiempo))&&($tiempo[$i]=="co2"))?'selected="selected"':'';?>>Colaci&oacute;n 2</option>
							<option value="cen"<?php echo ((isset($tiempo))&&($tiempo[$i]=="cen"))?'selected="selected"':'';?>>Cena</option>
						</select>
						<label>Alimento:</label><input type="text" name="alimento[]" value="<?php echo (isset($alimento))?''.$alimento[$i].'':'';?>" />
						<label>Cantidad:</label><input type="text" name="cantidad[]" size="5" value="<?php echo (isset($cantidad))?''.$cantidad[$i].'':'';?>" />
						<label>Calorias:</label><input type="text" name="calorias[]" value="<?php echo (isset($calorias))?''.$calorias[$i].'':'';?>" />
						<?php if(($i+1)<=$num){//Comprobamos que no sea el ultimo alimento capturado?>
							<input id="<?php echo $i;?>" type="button" value="-" class="bt_menos" />	
						<?php }else{//Si es el ultimo alimento capturado, cambiamos el boton para agregar mas?>
							<input id="<?php echo $i;?>" type="button" value="+" class="bt_mas" />
						<?php }?>
						
					</div>
					<?php }?>
		<div class="lineal" align="center">
			<table>
			<th>Total Kcal.</th><td><input type="text" name="total" size="15" value="<?php echo set_value('total') ?>"/></td>
			</table>
			
		</div>
		
	</fieldset>
		<?php echo form_error('tiempo')?>
		<?php echo form_error('alimento')?>
		<?php echo form_error('cantidad')?>
		<?php echo form_error('kcal')?>
		
	<fieldset>
		<legend>Frecuencia de consumo de alimentos</legend>
		<label>Narre cu&aacute;ntos d&iacute;as a la semana consume los siguientes alimentos</label>
		<div>
			<table>
				<tr align="right">
					<td>Verduras</td>
					<td align="left"><input type="text" size="3" name="verduras" value="<?php echo set_value('verduras')?>" /></td><td>/7</td>
					<td>Grasas sp (aceite vegetal)</td>
					<td align="left"><input type="text" size="3" name="grasa_sp" value="<?php echo set_value('grasa_sp')?>" /></td><td>/7</td>
				</tr>
					<tr align="right">
					<td>Frutas</td>
					<td align="left"><input type="text" size="3" name="frutas" value="<?php echo set_value('frutas')?>" /></td><td>/7</td>
					<td>Grasas cp (almendra, nuez,etc.)</td>
					<td align="left"><input type="text" size="3" name="grasa_cp" value="<?php echo set_value('grasa_cp')?>" /></td><td>/7</td>
				</tr>
				<tr align="right">
					<td>CyTsg (pan,tortilla,papa,pasta)</td>
					<td align="left"><input type="text" size="3" name="car_sg" value="<?php echo set_value('car_sg')?>" /></td><td>/7</td>
					<td>Leche</td>
					<td align="left"><input type="text" size="3" name="leche" value="<?php echo set_value('leche')?>" /></td><td>/7</td>
				</tr>
				<tr align="right">
					<td>CyTcg (pan dulce, galletas)</td>
					<td align="left"><input type="text" size="3" name="car_cg" value="<?php echo set_value('car_cg')?>" /></td><td>/7</td>
					<td>Az&uacute;car</td>
					<td align="left"><input type="text" size="3" name="azucar" value="<?php echo set_value('azucar')?>" /></td><td>/7</td>
				</tr>
				<tr align="right">
					<td>Leguminosas (frijol, haba, lentejas)</td>
					<td align="left"><input type="text" size="3" name="leguminosas" value="<?php echo set_value('leguminosas')?>" /></td><td>/7</td>
					<td>Productos de origen animal (pollo,carne,queso)</td>
					<td align="left"><input type="text" size="3" name="origen_animal" value="<?php echo set_value('origen_animal')?>" /></td><td>/7</td>
				</tr>
			</table>
		</div>
	</fieldset>	
		<?php echo form_error('verduras')?>
		<?php echo form_error('frutas')?>
		<?php echo form_error('car_sg')?>
		<?php echo form_error('car_cg')?>
		<?php echo form_error('grasa_sp')?>
		<?php echo form_error('grasa_cp')?>
		<?php echo form_error('leche')?>
		<?php echo form_error('azucar')?>
		<?php echo form_error('leguminosas')?>
		<?php echo form_error('origen_animal')?>	
	<fieldset>
		<legend>Historial de peso</legend>
		<div class="lineal">
			<label>1. &iquest;Cu&aacute;l es el peso m&aacute;ximo que ha alcanzado? </label>
			<input type="text" size="4" name="peso_max" value="<?php echo set_value('peso_max')?>" />Kg.
		</div>
		<div class="lineal">
			<label> 2. &iquest;En qu&eacute; fecha?</label>
			<label>Mes</label>
			<select name="peso_max_mes">
				<option value="" <?php echo set_select('peso_max_mes','');?>></option>
				<option value="01" <?php echo set_select('peso_max_mes','01');?>>Enero</option>
				<option value="02" <?php echo set_select('peso_max_mes','02');?>>Febrero</option>
				<option value="03" <?php echo set_select('peso_max_mes','03');?>>Marzo</option>
				<option value="04" <?php echo set_select('peso_max_mes','04');?>>Abril</option>
				<option value="05" <?php echo set_select('peso_max_mes','05');?>>Mayo</option>
				<option value="06" <?php echo set_select('peso_max_mes','06');?>>Junio</option>
				<option value="07" <?php echo set_select('peso_max_mes','07');?>>Julio</option>
				<option value="08" <?php echo set_select('peso_max_mes','08');?>>Agosto</option>
				<option value="09" <?php echo set_select('peso_max_mes','09');?>>Septiembre</option>
				<option value="10" <?php echo set_select('peso_max_mes','10');?>>Octubre</option>
				<option value="11" <?php echo set_select('peso_max_mes','11');?>>Noviembre</option>
				<option value="12" <?php echo set_select('peso_max_mes','12');?>>Diciembre</option>
			</select>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="peso_max_a" value="<?php echo set_value('peso_max_a');?>"/>
		</div>
		<div class="lineal">
			<label>  3. &iquest;Cu&aacute;l es el m&iacute;nimo de peso que ha alcanzado?</label>
			<input type="text" size="4" name="peso_min" value="<?php echo set_value('peso_min');?>"/>Kg.
		</div>
		<div class="lineal">
			<label> 4. &iquest;En qu&eacute; fecha?</label>
			<label>Mes</label>
			<select name="peso_min_mes">
				<option value="" <?php echo set_select('peso_min_mes','');?>></option>
				<option value="01" <?php echo set_select('peso_min_mes','01');?>>Enero</option>
				<option value="02" <?php echo set_select('peso_min_mes','02');?>>Febrero</option>
				<option value="03" <?php echo set_select('peso_min_mes','03');?>>Marzo</option>
				<option value="04" <?php echo set_select('peso_min_mes','04');?>>Abril</option>
				<option value="05" <?php echo set_select('peso_min_mes','05');?>>Mayo</option>
				<option value="06" <?php echo set_select('peso_min_mes','06');?>>Junio</option>
				<option value="07" <?php echo set_select('peso_min_mes','07');?>>Julio</option>
				<option value="08" <?php echo set_select('peso_min_mes','08');?>>Agosto</option>
				<option value="09" <?php echo set_select('peso_min_mes','09');?>>Septiembre</option>
				<option value="10" <?php echo set_select('peso_min_mes','10');?>>Octubre</option>
				<option value="11" <?php echo set_select('peso_min_mes','11');?>>Noviembre</option>
				<option value="12" <?php echo set_select('peso_min_mes','12');?>>Diciembre</option>
			</select>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="peso_min_a" value="<?php echo set_value('peso_min_a');?>"/>
		</div>
		<div class="lineal" align="top">
			<label> 5. Describa su historia de peso en los &uacute;ltimos 6 meses</label>
		</div>
		<textarea rows="3" cols="70" name="desc_hist"><?php echo ($this->input->post('desc_hist')) ?></textarea>
		
		<div class="lineal">
			<label> 6. &iquest;Ha tomado medicamentos para bajar de peso? </label>
			<label>S&iacute;</label><input type="radio" name="medicamentos" value="si" onclick='$("#ocultar_med").toggle(200)' <?php echo set_radio('medicamentos','si');?>/>
			<label>No</label><input type="radio" name="medicamentos"  value="no" onclick='$("#ocultar_med").toggle(!200)'  <?php echo set_radio('medicamentos','no');?>/>
		</div>
		<div class="lineal" id="ocultar_med" style="display: <?php echo ($this->input->post('medicamentos'))=='si'?'':'none'?>;">
			<label>&iquest;Cu&aacute;les?</label>
			<input type="text" name="med" value="<?php echo set_value('med');?>"/>
		</div>
		<div class="lineal">
			<label>7. &iquest;Ha acudido a otros tratamientos? </label>	
			<label>S&iacute;</label><input type="radio" name="tratamiento" value="si" onclick='$("#ocultar_trat").toggle(200)' <?php echo set_radio('tratamiento','si');?>/>
			<label>No</label><input type="radio" name="tratamiento" value="no" onclick='$("#ocultar_trat").toggle(!200)'<?php echo set_radio('tratamiento','no');?>/>
		</div>
		<div id="ocultar_trat" style="display: <?php echo ($this->input->post('tratamiento'))=='si'?'':'none'?>;">
		<label> 8. Narre los &uacute;ltimos 3 con fechas y resultados</label>
		<div class="lineal">
			<label>Fecha: Mes </label>
			<select name="tratamiento1_mes">
				<option value="" <?php echo set_select('tratamiento1_mes','');?>></option>
				<option value="01" <?php echo set_select('tratamiento1_mes','01');?>>Enero</option>
				<option value="02" <?php echo set_select('tratamiento1_mes','02');?>>Febrero</option>
				<option value="03" <?php echo set_select('tratamiento1_mes','03');?>>Marzo</option>
				<option value="04" <?php echo set_select('tratamiento1_mes','04');?>>Abril</option>
				<option value="05" <?php echo set_select('tratamiento1_mes','05');?>>Mayo</option>
				<option value="06" <?php echo set_select('tratamiento1_mes','06');?>>Junio</option>
				<option value="07" <?php echo set_select('tratamiento1_mes','07');?>>Julio</option>
				<option value="08" <?php echo set_select('tratamiento1_mes','08');?>>Agosto</option>
				<option value="09" <?php echo set_select('tratamiento1_mes','09');?>>Septiembre</option>
				<option value="10" <?php echo set_select('tratamiento1_mes','10');?>>Octubre</option>
				<option value="11" <?php echo set_select('tratamiento1_mes','11');?>>Noviembre</option>
				<option value="12" <?php echo set_select('tratamiento1_mes','12');?>>Diciembre</option>
			</select>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="tratamiento1_a" value="<?php echo set_value('tratamiento1_a');?>"/>
			<label>Resultado</label>
			<textarea rows="2" cols="30" name="tratamiento1_res"><?php echo ($this->input->post('tratamiento1_res')) ?></textarea>
		</div>
		<div class="lineal">
			<label>Fecha: Mes </label>
			<select name="tratamiento2_mes">
				<option value="" <?php echo set_select('tratamiento2_mes','');?>></option>
				<option value="01" <?php echo set_select('tratamiento2_mes','01');?>>Enero</option>
				<option value="02" <?php echo set_select('tratamiento2_mes','02');?>>Febrero</option>
				<option value="03" <?php echo set_select('tratamiento2_mes','03');?>>Marzo</option>
				<option value="04" <?php echo set_select('tratamiento2_mes','04');?>>Abril</option>
				<option value="05" <?php echo set_select('tratamiento2_mes','05');?>>Mayo</option>
				<option value="06" <?php echo set_select('tratamiento2_mes','06');?>>Junio</option>
				<option value="07" <?php echo set_select('tratamiento2_mes','07');?>>Julio</option>
				<option value="08" <?php echo set_select('tratamiento2_mes','08');?>>Agosto</option>
				<option value="09" <?php echo set_select('tratamiento2_mes','09');?>>Septiembre</option>
				<option value="10" <?php echo set_select('tratamiento2_mes','10');?>>Octubre</option>
				<option value="11" <?php echo set_select('tratamiento2_mes','11');?>>Noviembre</option>
				<option value="12" <?php echo set_select('tratamiento2_mes','12');?>>Diciembre</option>			
			</select>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="tratamiento2_a" value="<?php echo set_value('tratamiento2_a');?>"/>
			<label>Resultado</label>
			<textarea rows="2" cols="30" name="tratamiento2_res"><?php echo ($this->input->post('tratamiento2_res')) ?></textarea>
		</div>
		<div class="lineal">
			<label>Fecha: Mes </label>
			<select name="tratamiento3_mes">
				<option value="" <?php echo set_select('tratamiento2_mes','');?>></option>
				<option value="01" <?php echo set_select('tratamiento3_mes','01');?>>Enero</option>
				<option value="02" <?php echo set_select('tratamiento3_mes','02');?>>Febrero</option>
				<option value="03" <?php echo set_select('tratamiento3_mes','03');?>>Marzo</option>
				<option value="04" <?php echo set_select('tratamiento3_mes','04');?>>Abril</option>
				<option value="05" <?php echo set_select('tratamiento3_mes','05');?>>Mayo</option>
				<option value="06" <?php echo set_select('tratamiento3_mes','06');?>>Junio</option>
				<option value="07" <?php echo set_select('tratamiento3_mes','07');?>>Julio</option>
				<option value="08" <?php echo set_select('tratamiento3_mes','08');?>>Agosto</option>
				<option value="09" <?php echo set_select('tratamiento3_mes','09');?>>Septiembre</option>
				<option value="10" <?php echo set_select('tratamiento3_mes','10');?>>Octubre</option>
				<option value="11" <?php echo set_select('tratamiento3_mes','11');?>>Noviembre</option>
				<option value="12" <?php echo set_select('tratamiento3_mes','12');?>>Diciembre</option>	
			</select>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="tratamiento3_a" value="<?php echo set_value('tratamiento3_a');?>"/>
			<label>Resultado</label>
			<textarea rows="2" cols="30" name="tratamiento3_res"><?php echo ($this->input->post('tratamiento3_res')) ?></textarea>
		</div>
	</div>
	</fieldset>	
		<?php echo form_error('peso_max')?>
		<?php echo form_error('peso_max_mes')?>
		<?php echo form_error('peso_max_a')?>
		<?php echo form_error('peso_min')?>
		<?php echo form_error('peso_min_mes')?>
		<?php echo form_error('peso_min_a')?>	
		<?php echo form_error('desc_hist')?>
		<?php echo form_error('medicamentos')?>
		<?php echo form_error('med')?>
		<?php echo form_error('tratamiento')?>
		<?php echo form_error('tratamiento1_mes')?>
		<?php echo form_error('tratamiento1_a')?>
		<?php echo form_error('tratamiento1_res')?>
		<?php echo form_error('tratamiento2_mes')?>
		<?php echo form_error('tratamiento2_a')?>
		<?php echo form_error('tratamiento2_res')?>
		<?php echo form_error('tratamiento3_mes')?>
		<?php echo form_error('tratamiento3_a')?>
		<?php echo form_error('tratamiento3_res')?>
	<fieldset>
		<legend>Preguntas sobre h&aacute;bitos alimenticios</legend>
		<div>
			<table border="1">
				<tr><th colspan="6">Comidas del d&iacute;a</th></tr>
				<tr align="center"><td></td><th>S&iacute;</th><th>No</th><th width="20%">Lugar</th><th width="20%">Horario</th><th width="30%">&iquest;Qui&eacute;n cocina?</th></tr>
				<tr><th>Desayuno</th>
					<td><input type="radio" name="desayuno" value="si" onclick='$("#ocultar_des").toggle(200)'  <?php echo set_radio('desayuno','si');?>/></td>
					<td><input type="radio" name="desayuno" value="no" onclick='$("#ocultar_des").toggle(!200)'  <?php echo set_radio('desayuno','no');?>/></td>
					
					<td colspan="3">
						<div id="ocultar_des" class="lineal" style="display: <?php echo ($this->input->post('desayuno'))=='si'?'':'none'?>;">	
					<input type="text" name="lugar_desayuno" value="<?php echo set_value('lugar_desayuno');?>"/>
					<select name="horas_desayuno">
						<option value="" <?php echo set_select('horas_desayuno','');?>></option>
						<option value="01" <?php echo set_select('horas_desayuno','01');?>>01</option>
						<option value="02" <?php echo set_select('horas_desayuno','02');?>>02</option>
						<option value="03" <?php echo set_select('horas_desayuno','03');?>>03</option>
						<option value="04" <?php echo set_select('horas_desayuno','04');?>>04</option>
						<option value="05" <?php echo set_select('horas_desayuno','05');?>>05</option>
						<option value="06" <?php echo set_select('horas_desayuno','06');?>>06</option>
						<option value="07" <?php echo set_select('horas_desayuno','07');?>>07</option>
						<option value="08" <?php echo set_select('horas_desayuno','08');?>>08</option>
						<option value="09" <?php echo set_select('horas_desayuno','09');?>>09</option>
						<option value="10" <?php echo set_select('horas_desayuno','10');?>>10</option>
						<option value="11" <?php echo set_select('horas_desayuno','11');?>>11</option>
						<option value="12" <?php echo set_select('horas_desayuno','12');?>>12</option>
					</select>:
					<select name="minutos_desayuno">
						<option value="" <?php echo set_select('minutos_desayuno','');?>></option>
						<option value="00" <?php echo set_select('minutos_desayuno','00');?>>00</option>
						<option value="05" <?php echo set_select('minutos_desayuno','05');?>>05</option>
						<option value="10" <?php echo set_select('minutos_desayuno','10');?>>10</option>
						<option value="15" <?php echo set_select('minutos_desayuno','15');?>>15</option>
						<option value="20" <?php echo set_select('minutos_desayuno','20');?>>20</option>
						<option value="25" <?php echo set_select('minutos_desayuno','25');?>>25</option>
						<option value="30" <?php echo set_select('minutos_desayuno','30');?>>30</option>
						<option value="35" <?php echo set_select('minutos_desayuno','35');?>>35</option>
						<option value="40" <?php echo set_select('minutos_desayuno','40');?>>40</option>
						<option value="45" <?php echo set_select('minutos_desayuno','45');?>>45</option>
						<option value="50" <?php echo set_select('minutos_desayuno','50');?>>50</option>
						<option value="55" <?php echo set_select('minutos_desayuno','55');?>>55</option>
					</select>
					<select name="tiempo_desayuno">
						<option value="" <?php echo set_select('tiempo_desayuno','');?>></option>
						<option value="am" <?php echo set_select('tiempo_desayuno','am');?>>am</option>
						<option value="pm" <?php echo set_select('tiempo_desayuno','pm');?>>pm</option>
					</select>
				
				<input type="text" name="cocinero_desayuno" value="<?php echo set_value('cocinero_desayuno');?>"/>
				
			</div>
			</tr>	
			<tr><th>Colaci&oacute;n</th>
				<td><input type="radio" name="colacion1" value="si" onclick='$("#ocultar_col1").toggle(200)'  <?php echo set_radio('colacion1','si');?>/></td>
				<td><input type="radio" name="colacion1" value="no" onclick='$("#ocultar_col1").toggle(!200)' <?php echo set_radio('colacion1','no');?>/></td>
				<td colspan="3">
					<div id="ocultar_col1" class="lineal" style="display: <?php echo ($this->input->post('colacion1'))=='si'?'':'none'?>;">	
					<input type="text" name="lugar_colacion1" value="<?php echo set_value('lugar_colacion1');?>"/>
					<select name="horas_colacion1">
						<option value="" <?php echo set_select('horas_colacion1','');?>></option>
						<option value="01" <?php echo set_select('horas_colacion1','01');?>>01</option>
						<option value="02" <?php echo set_select('horas_colacion1','02');?>>02</option>
						<option value="03" <?php echo set_select('horas_colacion1','03');?>>03</option>
						<option value="04" <?php echo set_select('horas_colacion1','04');?>>04</option>
						<option value="05" <?php echo set_select('horas_colacion1','05');?>>05</option>
						<option value="06" <?php echo set_select('horas_colacion1','06');?>>06</option>
						<option value="07" <?php echo set_select('horas_colacion1','07');?>>07</option>
						<option value="08" <?php echo set_select('horas_colacion1','08');?>>08</option>
						<option value="09" <?php echo set_select('horas_colacion1','09');?>>09</option>
						<option value="10" <?php echo set_select('horas_colacion1','10');?>>10</option>
						<option value="11" <?php echo set_select('horas_colacion1','11');?>>11</option>
						<option value="12" <?php echo set_select('horas_colacion1','12');?>>12</option>
					</select>:
					<select name="minutos_colacion1">
						<option value="" <?php echo set_select('minutos_colacion1','');?>></option>
						<option value="00" <?php echo set_select('minutos_colacion1','00');?>>00</option>
						<option value="05" <?php echo set_select('minutos_colacion1','05');?>>05</option>
						<option value="10" <?php echo set_select('minutos_colacion1','10');?>>10</option>
						<option value="15" <?php echo set_select('minutos_colacion1','15');?>>15</option>
						<option value="20" <?php echo set_select('minutos_colacion1','20');?>>20</option>
						<option value="25" <?php echo set_select('minutos_colacion1','25');?>>25</option>
						<option value="30" <?php echo set_select('minutos_colacion1','30');?>>30</option>
						<option value="35" <?php echo set_select('minutos_colacion1','35');?>>35</option>
						<option value="40" <?php echo set_select('minutos_colacion1','40');?>>40</option>
						<option value="45" <?php echo set_select('minutos_colacion1','45');?>>45</option>
						<option value="50" <?php echo set_select('minutos_colacion1','50');?>>50</option>
						<option value="55" <?php echo set_select('minutos_colacion1','55');?>>55</option>
					</select>
					<select name="tiempo_colacion1">
						<option value="" <?php echo set_select('tiempo_colacion1','');?>></option>
						<option value="am" <?php echo set_select('tiempo_colacion1','am');?>>am</option>
						<option value="pm" <?php echo set_select('tiempo_colacion1','pm');?>>pm</option>
					</select>
				
				<input type="text" name="cocinero_colacion1" value="<?php echo set_value('cocinero_colacion1');?>"/>
				</div>
				</td>	
			</tr>	
			<tr><th>Comida</th>
				<td><input type="radio" name="comida"  value="si" onclick='$("#ocultar_com").toggle(200)'<?php echo set_radio('comida','si');?>/></td>
				<td><input type="radio" name="comida" value="no" onclick='$("#ocultar_com").toggle(!200)'<?php echo set_radio('comida','no');?>/></td>
				<td colspan="3">
					<div id="ocultar_com" class="lineal" style="display: <?php echo ($this->input->post('comida'))=='si'?'':'none'?>;">	
					<input type="text" name="lugar_comida" value="<?php echo set_value('lugar_comida');?>"/>
					<select name="horas_comida">
						<option value="" <?php echo set_select('horas_comida','');?>></option>
						<option value="01" <?php echo set_select('horas_comida','01');?>>01</option>
						<option value="02" <?php echo set_select('horas_comida','02');?>>02</option>
						<option value="03" <?php echo set_select('horas_comida','03');?>>03</option>
						<option value="04" <?php echo set_select('horas_comida','04');?>>04</option>
						<option value="05" <?php echo set_select('horas_comida','05');?>>05</option>
						<option value="06" <?php echo set_select('horas_comida','06');?>>06</option>
						<option value="07" <?php echo set_select('horas_comida','07');?>>07</option>
						<option value="08" <?php echo set_select('horas_comida','08');?>>08</option>
						<option value="09" <?php echo set_select('horas_comida','09');?>>09</option>
						<option value="10" <?php echo set_select('horas_comida','10');?>>10</option>
						<option value="11" <?php echo set_select('horas_comida','11');?>>11</option>
						<option value="12" <?php echo set_select('horas_comida','12');?>>12</option>
					</select>:
					<select name="minutos_comida">
						<option value="" <?php echo set_select('minutos_comida','');?>></option>
						<option value="00" <?php echo set_select('minutos_comida','00');?>>00</option>
						<option value="05" <?php echo set_select('minutos_comida','05');?>>05</option>
						<option value="10" <?php echo set_select('minutos_comida','10');?>>10</option>
						<option value="15" <?php echo set_select('minutos_comida','15');?>>15</option>
						<option value="20" <?php echo set_select('minutos_comida','20');?>>20</option>
						<option value="25" <?php echo set_select('minutos_comida','25');?>>25</option>
						<option value="30" <?php echo set_select('minutos_comida','30');?>>30</option>
						<option value="35" <?php echo set_select('minutos_comida','35');?>>35</option>
						<option value="40" <?php echo set_select('minutos_comida','40');?>>40</option>
						<option value="45" <?php echo set_select('minutos_comida','45');?>>45</option>
						<option value="50" <?php echo set_select('minutos_comida','50');?>>50</option>
						<option value="55" <?php echo set_select('minutos_comida','55');?>>55</option>
					</select>
					<select name="tiempo_comida">
						<option value="" <?php echo set_select('tiempo_comida','');?>></option>
						<option value="am" <?php echo set_select('tiempo_comida','am');?>>am</option>
						<option value="pm" <?php echo set_select('tiempo_comida','pm');?>>pm</option>
					</select>
					<input type="text" name="cocinero_comida" value="<?php echo set_value('cocinero_comida');?>"/>
					</div>
					</td>	
			</tr>
			<tr><th>Colaci&oacute;n</th>
				<td><input type="radio" name="colacion2" value="si" onclick='$("#ocultar_col2").toggle(200)' <?php echo set_radio('colacion2','si');?>/></td>
				<td><input type="radio" name="colacion2" value="no" onclick='$("#ocultar_col2").toggle(!200)' <?php echo set_radio('colacion2','no');?>/></td>
				<td colspan="3">
					<div id="ocultar_col2" class="lineal" style="display: <?php echo ($this->input->post('colacion2'))=='si'?'':'none'?>;">
					<input type="text" name="lugar_colacion2" value="<?php echo set_value('lugar_colacion2');?>"/>
				
					<select name="horas_colacion2">
						<option value="" <?php echo set_select('horas_colacion2','');?>></option>
						<option value="01" <?php echo set_select('horas_colacion2','01');?>>01</option>
						<option value="02" <?php echo set_select('horas_colacion2','02');?>>02</option>
						<option value="03" <?php echo set_select('horas_colacion2','03');?>>03</option>
						<option value="04" <?php echo set_select('horas_colacion2','04');?>>04</option>
						<option value="05" <?php echo set_select('horas_colacion2','05');?>>05</option>
						<option value="06" <?php echo set_select('horas_colacion2','06');?>>06</option>
						<option value="07" <?php echo set_select('horas_colacion2','07');?>>07</option>
						<option value="08" <?php echo set_select('horas_colacion2','08');?>>08</option>
						<option value="09" <?php echo set_select('horas_colacion2','09');?>>09</option>
						<option value="10" <?php echo set_select('horas_colacion2','10');?>>10</option>
						<option value="11" <?php echo set_select('horas_colacion2','11');?>>11</option>
						<option value="12" <?php echo set_select('horas_colacion2','12');?>>12</option>
					</select>:
					<select name="minutos_colacion2">
						<option value="" <?php echo set_select('minutos_colacion2','');?>></option>
						<option value="00" <?php echo set_select('minutos_colacion2','00');?>>00</option>
						<option value="05" <?php echo set_select('minutos_colacion2','05');?>>05</option>
						<option value="10" <?php echo set_select('minutos_colacion2','10');?>>10</option>
						<option value="15" <?php echo set_select('minutos_colacion2','15');?>>15</option>
						<option value="20" <?php echo set_select('minutos_colacion2','20');?>>20</option>
						<option value="25" <?php echo set_select('minutos_colacion2','25');?>>25</option>
						<option value="30" <?php echo set_select('minutos_colacion2','30');?>>30</option>
						<option value="35" <?php echo set_select('minutos_colacion2','35');?>>35</option>
						<option value="40" <?php echo set_select('minutos_colacion2','40');?>>40</option>
						<option value="45" <?php echo set_select('minutos_colacion2','45');?>>45</option>
						<option value="50" <?php echo set_select('minutos_colacion2','50');?>>50</option>
						<option value="55" <?php echo set_select('minutos_colacion2','55');?>>55</option>
					</select>
					<select name="tiempo_colacion2">
						<option value="" <?php echo set_select('tiempo_colacion2','');?>></option>
						<option value="am" <?php echo set_select('tiempo_colacion2','am');?>>am</option>
						<option value="pm" <?php echo set_select('tiempo_colacion2','pm');?>>pm</option>
					</select>
				
				    <input type="text" name="cocinero_colacion2" value="<?php echo set_value('cocinero_colacion2');?>"/>
				    </div>
				    </td>	
			</tr>	
			<tr><th>Cena</th>
				<td><input type="radio" name="cena" value="si" onclick='$("#ocultar_cen").toggle(200)'<?php echo set_radio('cena','si');?>/></td>
				<td><input type="radio" name="cena" value="no" onclick='$("#ocultar_cen").toggle(!200)'<?php echo set_radio('cena','no');?>/></td>
				<td colspan="3">
					<div id="ocultar_cen" class="lineal" style="display: <?php echo ($this->input->post('cena'))=='si'?'':'none'?>;">
					<input type="text" name="lugar_cena" value="<?php echo set_value('lugar_cena');?>"/>
				
					<select name="horas_cena">
						<option value="" <?php echo set_select('horas_cena','');?>></option>
						<option value="01" <?php echo set_select('horas_cena','01');?>>01</option>
						<option value="02" <?php echo set_select('horas_cena','02');?>>02</option>
						<option value="03" <?php echo set_select('horas_cena','03');?>>03</option>
						<option value="04" <?php echo set_select('horas_cena','04');?>>04</option>
						<option value="05" <?php echo set_select('horas_cena','05');?>>05</option>
						<option value="06" <?php echo set_select('horas_cena','06');?>>06</option>
						<option value="07" <?php echo set_select('horas_cena','07');?>>07</option>
						<option value="08" <?php echo set_select('horas_cena','08');?>>08</option>
						<option value="09" <?php echo set_select('horas_cena','09');?>>09</option>
						<option value="10" <?php echo set_select('horas_cena','10');?>>10</option>
						<option value="11" <?php echo set_select('horas_cena','11');?>>11</option>
						<option value="12" <?php echo set_select('horas_cena','12');?>>12</option>
					</select>:
					<select name="minutos_cena">
						<option value="" <?php echo set_select('minutos_cena','');?>></option>
						<option value="00" <?php echo set_select('minutos_cena','00');?>>00</option>
						<option value="05" <?php echo set_select('minutos_cena','05');?>>05</option>
						<option value="10" <?php echo set_select('minutos_cena','10');?>>10</option>
						<option value="15" <?php echo set_select('minutos_cena','15');?>>15</option>
						<option value="20" <?php echo set_select('minutos_cena','20');?>>20</option>
						<option value="25" <?php echo set_select('minutos_cena','25');?>>25</option>
						<option value="30" <?php echo set_select('minutos_cena','30');?>>30</option>
						<option value="35" <?php echo set_select('minutos_cena','35');?>>35</option>
						<option value="40" <?php echo set_select('minutos_cena','40');?>>40</option>
						<option value="45" <?php echo set_select('minutos_cena','45');?>>45</option>
						<option value="50" <?php echo set_select('minutos_cena','50');?>>50</option>
						<option value="55" <?php echo set_select('minutos_cena','55');?>>55</option>
					</select>
					<select name="tiempo_cena">
						<option value="" <?php echo set_select('tiempo_cena','');?>></option>
						<option value="am" <?php echo set_select('tiempo_cena','am');?>>am</option>
						<option value="pm" <?php echo set_select('tiempo_cena','pm');?>>pm</option>
					</select>
				
					<input type="text" name="cocinero_cena" value="<?php echo set_select('cocinero_cena');?>"/>
					</div>
					</td>	
			</tr>
		</table>
	</div>
	<div class="lineal">
	<legend>Preguntas generales</legend>
	<label>&iquest;Qu&eacute; expectativa de evoluci&oacute;n tiene?</label>
	<div class="lineal">
		<table>
			<tr>
				<td><label>R&aacute;pida</label></td>
				<td><input type="radio" name="evolucion" value="rapida" <?php echo set_radio('evolucion','rapida');?>/></td>
			</tr>
			<tr>
				<td><label>Lenta</label></td>
				<td><input type="radio" name="evolucion" value="lenta" <?php echo set_radio('evolucion','lenta');?>/></td>
			</tr>
			<tr>
				<td><label>Moderada</label></td>
				<td><input type="radio" name="evolucion" value="moderada" <?php echo set_radio('evolucion','moderada');?>/></td>
			</tr>		
		</table>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 el nivel de desgaste o irritabilidad que le genera el tema</label>
		<select name="desgaste">
			<option value="" <?php echo set_select('desgaste','');?>></option>
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
		<label>Mencione del 1 al 10 la motivaci&oacute;n con la que llega</label>
		<select name="motivacion">
			<option value="" <?php echo set_select('motivacion','');?>></option>
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
		<label>&iquest;Por qu&eacute;?</label>
		<input type="text" size="50" name="razon_motivacion" value="<?php echo set_value('razon_motivacion');?>" >
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 qu&eacute; tan capaz se cree usted de lograr los resultados</label>
		<select name="capacidad">
			<option value="" <?php echo set_select('capacidad','');?>></option>
			<option value="1" <?php echo set_select('capacidad','1');?>>1</option>
			<option value="2" <?php echo set_select('capacidad','2');?>>2</option>
			<option value="3" <?php echo set_select('capacidad','3');?>>3</option>
			<option value="4" <?php echo set_select('capacidad','4');?>>4</option>
			<option value="5" <?php echo set_select('capacidad','5');?>>5</option>
			<option value="6" <?php echo set_select('capacidad','6');?>>6</option>
			<option value="7" <?php echo set_select('capacidad','7');?>>7</option>
			<option value="8" <?php echo set_select('capacidad','8');?>>8</option>
			<option value="9" <?php echo set_select('capacidad','9');?>>9</option>
			<option value="10" <?php echo set_select('capacidad','10');?>>10</option>
		</select>
	</div>
	</div>
	</fieldset>
		
		<?php echo form_error('desayuno')?>
		<?php echo form_error('lugar_desayuno')?>
		<?php echo form_error('horas_desayuno')?>
		<?php echo form_error('minutos_desayuno')?>
		<?php echo form_error('tiempo_desayuno')?>
		<?php echo form_error('cocinero_desayuno')?>
		<?php echo form_error('colacion1')?>
		<?php echo form_error('lugar_colacion1')?>
		<?php echo form_error('horas_colacion1')?>
		<?php echo form_error('minutos_colacion1')?>
		<?php echo form_error('tiempo_colacion1')?>
		<?php echo form_error('cocinero_colacion1')?>
		<?php echo form_error('comida')?>
		<?php echo form_error('lugar_comida')?>
		<?php echo form_error('horas_comida')?>
		<?php echo form_error('minutos_comida')?>
		<?php echo form_error('tiempo_comida')?>
		<?php echo form_error('cocinero_comida')?>
		<?php echo form_error('colacion2')?>
		<?php echo form_error('lugar_colacion2')?>
		<?php echo form_error('horas_colacion2')?>
		<?php echo form_error('minutos_colacion2')?>
		<?php echo form_error('tiempo_colacion2')?>
		<?php echo form_error('cocinero_colacion2')?>
		<?php echo form_error('cena')?>
		<?php echo form_error('lugar_cena')?>
		<?php echo form_error('horas_cena')?>
		<?php echo form_error('minutos_cena')?>
		<?php echo form_error('tiempo_cena')?>
		<?php echo form_error('cocinero_cena')?>		
		<?php echo form_error('evolucion')?>
		<?php echo form_error('desgaste')?>
		<?php echo form_error('motivacion')?>
		<?php echo form_error('razon_motivacion')?>
		<?php echo form_error('capacidad')?>
	<div class="botones" align="center">
		<input type="submit" value="Guardar y salir" />
		<input type="submit" value="Cancelar"/>
	</div>					
	</form>
</body>
</html>

