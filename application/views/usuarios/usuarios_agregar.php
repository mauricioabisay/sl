<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>	
	</head>
	<body>
	<?php 
	if(isset($tipo)){
		echo '<div><span id="'.$tipo.'">';
		echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
		echo '</span></div>';
	}
	?>
	<form action="<?php echo site_url();?>/usuarios/agregar" method="post" name="formulario" id="formulario">
	<fieldset >
		<legend>Alta de nutriólogos</legend>
	
				<label>Nombre(s):</label>
				<span class="lineal"><input type="text" name="nombre" value="<?php echo set_value('nombre');?>"/><?php echo form_error('nombre')?></span>
				
				<label>Apellido Paterno:</label>
				<span class="lineal"><input type="text" name="ap" value="<?php echo set_value('ap');?>" /><?php echo form_error('ap')?></span>
				
				<label>Apellido Materno:</label>
				<span class="lineal"><input type="text" name="am" value="<?php echo set_value('am');?>" /><?php echo form_error('am')?></span>
			
				<!--
				<label>Usuario:</label>
				<span class="lineal"><input type="text" name="nick" value="<?php echo set_value('nick');?>"/><?php echo form_error('nick')?></span>
				
				<label>Contrase&ntilde;a:</label>
				<span class="lineal"><input type="password" name="pass" /><?php echo form_error('pass');?></span>
			
				
				<label>Tipo:</label>
				<span class="lineal">
				<select>
					<option></option>
					<option>Administrador</option>
					<option>Doctor</option>
					<option>Recepcionista</option>
				</select>
				</span>
				-->
			
	</fieldset>
	<fieldset class="">
		<legend>Horarios de trabajo</legend>
		<?php echo form_error('dias_trabajo_0');?>
		<table class="tabla_formulario">
			<tr>
				<th>D&iacute;as</th><th>Hora de entrada:</th><th>Hora de salida:</th>
			</tr>
			<?php for($i=0; $i<7;$i++){
				switch ($i){
					case 0:$dia="Lunes";break;
					case 1:$dia="Martes";break;
					case 2:$dia="Miercoles";break;
					case 3:$dia="Jueves";break;
					case 4:$dia="Viernes";break;
					case 5:$dia="Sabado";break;
					case 6:$dia="Todos";break;
				}?>
			
			<tr><td>
					<div class="lineal">
						<input type="checkbox" name="dias_trabajo_<?php echo $i;?>"  value="<?php echo $dia;?>" 
						 onclick='$("#horario_inicio_<?php echo $i;?>").toggle(200);$("#horario_fin_<?php echo $i;?>").toggle(200);' 
						<?php echo set_checkbox('dias_trabajo_'.$i,$dia);?> />
						<label><?php if($i==2)
									    echo 'Mi&eacute;rcoles';
									elseif($i==5)
										echo'S&aacute;bado';
									else {
										echo $dia;
									} ?>
						</label>
					</div>
				</td>
				
				<td>
					<div id="horario_inicio_<?php echo $i;?>" 
					 style="<?php echo ($this->input->post('dias_trabajo_'.$i)==$dia)?'':'display:none';?>">
					<select name="horas_inicio_<?php echo $i;?>">
						<option></option>
						 <option value="01" <?php echo set_select('horas_inicio_'.$i,'01');?>>01</option>
						 <option value="02" <?php echo set_select('horas_inicio_'.$i,'02');?>>02</option>
						 <option value="03" <?php echo set_select('horas_inicio_'.$i,'03');?>>03</option>
						 <option value="04" <?php echo set_select('horas_inicio_'.$i,'04');?>>04</option>
						 <option value="05" <?php echo set_select('horas_inicio_'.$i,'05');?>>05</option>
						 <option value="06" <?php echo set_select('horas_inicio_'.$i,'06');?>>06</option>
						 <option value="07" <?php echo set_select('horas_inicio_'.$i,'07');?>>07</option>
						 <option value="08" <?php echo set_select('horas_inicio_'.$i,'08');?>>08</option>
						 <option value="09" <?php echo set_select('horas_inicio_'.$i,'09');?>>09</option>
						 <option value="10" <?php echo set_select('horas_inicio_'.$i,'10');?>>10</option>
						 <option value="11" <?php echo set_select('horas_inicio_'.$i,'11');?>>11</option>
						 <option value="12" <?php echo set_select('horas_inicio_'.$i,'12');?>>12</option>
					</select>
					<select name="minutos_inicio_<?php echo $i;?>">
						 <option></option>
						 <option value="00" <?php echo set_select('minutos_inicio_'.$i,'00');?>>00</option>
						 <option value="05" <?php echo set_select('minutos_inicio_'.$i,'05');?>>05</option>
						 <option value="10" <?php echo set_select('minutos_inicio_'.$i,'10');?>>10</option>
						 <option value="15" <?php echo set_select('minutos_inicio_'.$i,'15');?>>15</option>
						 <option value="20" <?php echo set_select('minutos_inicio_'.$i,'20');?>>20</option>
						 <option value="25" <?php echo set_select('minutos_inicio_'.$i,'25');?>>25</option>
						 <option value="30" <?php echo set_select('minutos_inicio_'.$i,'30');?>>30</option>
						 <option value="35" <?php echo set_select('minutos_inicio_'.$i,'35');?>>35</option>
						 <option value="40" <?php echo set_select('minutos_inicio_'.$i,'40');?>>40</option>
						 <option value="45" <?php echo set_select('minutos_inicio_'.$i,'45');?>>45</option>
						 <option value="50" <?php echo set_select('minutos_inicio_'.$i,'50');?>>50</option>
						 <option value="55" <?php echo set_select('minutos_inicio_'.$i,'55');?>>55</option>
					</select>
					<select name="ampm_inicio_<?php echo $i;?>">
						<option></option>
						 <option value="am" <?php echo set_select('ampm_inicio_'.$i,'am');?>>a.m.</option>
						 <option value="pm" <?php echo set_select('ampm_inicio_'.$i,'pm');?>>p.m.</option>
					</select>
					</div>
				</td>
				
				<td>
					<div id="horario_fin_<?php echo $i;?>" 
					 style="<?php echo ($this->input->post('dias_trabajo_'.$i)==$dia)?'':'display:none';?>">
					<select name="horas_fin_<?php echo $i;?>">
						<option></option>
						 <option value="01" <?php echo set_select('horas_fin_'.$i,'01');?>>01</option>
						 <option value="02" <?php echo set_select('horas_fin_'.$i,'02');?>>02</option>
						 <option value="03" <?php echo set_select('horas_fin_'.$i,'03');?>>03</option>
						 <option value="04" <?php echo set_select('horas_fin_'.$i,'04');?>>04</option>
						 <option value="05" <?php echo set_select('horas_fin_'.$i,'05');?>>05</option>
						 <option value="06" <?php echo set_select('horas_fin_'.$i,'06');?>>06</option>
						 <option value="07" <?php echo set_select('horas_fin_'.$i,'07');?>>07</option>
						 <option value="08" <?php echo set_select('horas_fin_'.$i,'08');?>>08</option>
						 <option value="09" <?php echo set_select('horas_fin_'.$i,'09');?>>09</option>
						 <option value="10" <?php echo set_select('horas_fin_'.$i,'10');?>>10</option>
						 <option value="11" <?php echo set_select('horas_fin_'.$i,'11');?>>11</option>
						 <option value="12" <?php echo set_select('horas_fin_'.$i,'12');?>>12</option>
					</select>
					<select name="minutos_fin_<?php echo $i;?>">
						<option></option>
						 <option value="00" <?php echo set_select('minutos_fin_'.$i,'00');?>>00</option>
						 <option value="05" <?php echo set_select('minutos_fin_'.$i,'05');?>>05</option>
						 <option value="10" <?php echo set_select('minutos_fin_'.$i,'10');?>>10</option>
						 <option value="15" <?php echo set_select('minutos_fin_'.$i,'15');?>>15</option>
						 <option value="20" <?php echo set_select('minutos_fin_'.$i,'20');?>>20</option>
						 <option value="25" <?php echo set_select('minutos_fin_'.$i,'25');?>>25</option>
						 <option value="30" <?php echo set_select('minutos_fin_'.$i,'30');?>>30</option>
						 <option value="35" <?php echo set_select('minutos_fin_'.$i,'35');?>>35</option>
						 <option value="40" <?php echo set_select('minutos_fin_'.$i,'40');?>>40</option>
						 <option value="45" <?php echo set_select('minutos_fin_'.$i,'45');?>>45</option>
						 <option value="50" <?php echo set_select('minutos_fin_'.$i,'50');?>>50</option>
						 <option value="55" <?php echo set_select('minutos_fin_'.$i,'55');?>>55</option>
					</select>
					<select name="ampm_fin_<?php echo $i;?>">
						<option></option>
						 <option value="am" <?php echo set_select('ampm_fin_'.$i,'am');?>>a.m.</option>
						 <option value="pm" <?php echo set_select('ampm_fin_'.$i,'pm');?>>p.m.</option>
					</select>
					</div>
				</td>
				
			</tr>
			
		<?php }?>
		</table>
		
	</fieldset>
	<div class="botones" align="left" >
		<input type="submit" value="Guardar" />
		<input type="reset" value="Limpiar" />
	</div>
	</form>
	</body>
</html>