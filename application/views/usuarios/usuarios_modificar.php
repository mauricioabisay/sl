<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>	
		<script language="JavaScript" type="text/javascript" >
			
		</script>
	</head>
	<body>
	<?php 
	if(isset($tipo)){
		echo '<div><span id="'.$tipo.'">';
		echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
		echo '</span></div>';
		
	}
	?>
	<form action="<?php echo site_url();?>/usuarios/modificar_datos" method="post" name="formulario" id="formulario" style="width: 70%">
	<?php 	if ($resultados != NULL){
					foreach($resultados as $r)?>
	<fieldset >
		<legend>Alta de usuarios</legend>
				<input type="hidden" name="id_usr" value="<?php echo $r['id_usr'];?>" />
				<label>Nombre(s):</label>
				<span class="lineal"><input type="text" name="nombre" value="<?php echo $r['nombre'];?>"/><?php echo form_error('nombre')?></span>
				
				<label>Apellido Paterno:</label>
				<span class="lineal"><input type="text" name="ap" value="<?php echo $r['ap'];?>" /><?php echo form_error('ap')?></span>
				
				<label>Apellido Materno:</label>
				<span class="lineal"><input type="text" name="am" value="<?php echo $r['am'];?>" /><?php echo form_error('am')?></span>
			
				<!--
				<label>Usuario:</label>
				<span class="lineal"><input type="text" name="nick" value="<?php echo $u['nick'];?>"/><?php echo form_error('nick')?></span>
				
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
	<?php }?>
	<fieldset>
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
					<?php $aux = FALSE;
						  if ($resultados != NULL)
							foreach ($resultados as $r){
								if ($r['dias'] == $dia)
								    $aux = TRUE;
							}
					
					echo set_checkbox('dias_trabajo_'.$i,$dia,$aux);?> />
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
				<?php 
					  $aux = FALSE;
					  if ($resultados != NULL)
						foreach ($resultados as $r){
							if ($r['dias'] == $dia)
							    $aux = TRUE;
						} 
						echo ($this->input->post('dias_trabajo_'.$i)==$dia) || $aux ?'':'style ="display: none"' 
			    ?> >
			<select name="horas_inicio_<?php echo $i;?>">
				<option></option>
				 <option value="01" <?php   $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '01' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'01',$aux);?>>01</option>
				 <option value="02" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '02' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'02',$aux)?>>02</option>
				 <option value="03" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '03' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'03',$aux);?>>03</option>
				 <option value="04" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '04' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'04',$aux);?>>04</option>
				 <option value="05" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '05' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'05',$aux);?>>05</option>
				 <option value="06" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '06' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'06',$aux);?>>06</option>
				 <option value="07" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '07' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'07',$aux);?>>07</option>
				 <option value="08" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '08' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'08',$aux);?>>08</option>
				 <option value="09" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '09' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'09',$aux);?>>09</option>
				 <option value="10" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '10' &&  $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'10',$aux);?>>10</option>
				 <option value="11" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '11' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'11',$aux);?>>11</option>
				 <option value="12" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_inicio'] > 12)
													   $r['horas_inicio'] = $r['horas_inicio'] - 12;
													if ($r['horas_inicio'] == '12' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'12',$aux);?>>12</option>
			</select>
			
			<select name="minutos_inicio_<?php echo $i;?>">
				 <option></option>
				 <option value="00" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '00' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_inicio_'.$i,'00',$aux);?>>00</option>
				 <option value="05" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '05' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_inicio_'.$i,'05',$aux);?>>05</option>
				 <option value="10" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '10' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'10',$aux);?>>10</option>
				 <option value="15" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '15' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'15',$aux);?>>15</option>
				 <option value="20" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '20' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'20',$aux);?>>20</option>
				 <option value="25" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '25' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'25',$aux);?>>25</option>
				 <option value="30" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '30' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'30',$aux);?>>30</option>
				 <option value="35" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '35' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'35',$aux);?>>35</option>
				 <option value="40" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '40' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'40',$aux);?>>40</option>
				 <option value="45" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '45' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'45',$aux);?>>45</option>
				 <option value="50" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '50' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'50',$aux);?>>50</option>
				 <option value="55" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_inicio'] == '55' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_inicio_'.$i,'55',$aux);?>>55</option>
			</select>
		
			<select name="ampm_inicio_<?php echo $i;?>">
				<option></option>
				 <option value="am" <?php  $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if (($r['horas_inicio'] < 12 || $r['horas_inicio'] == 24 )&& $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('ampm_inicio_'.$i,'am',$aux);?>>a.m.</option>
				 <option value="pm" <?php   $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if (($r['horas_inicio'] >= 12 && $r['horas_inicio'] != 24) && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							
				 							echo set_select('ampm_inicio_'.$i,'pm',$aux);?>>p.m.</option>
			</select>
			
			</div>
		</td>
		
		<td>
			<div id="horario_fin_<?php echo $i;?>" 
			 <?php 
					  $aux = FALSE;
					  if ($resultados != NULL)
						foreach ($resultados as $r){
							if ($r['dias'] == $dia)
							    $aux = TRUE;
						} 
						echo ($this->input->post('dias_trabajo_'.$i)==$dia) || $aux ?'':'style ="display: none"' 
			    ?> >
			<select name="horas_fin_<?php echo $i;?>">
				<option></option>
				 <option value="01" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '01' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'01',$aux);?>>01</option>
				 <option value="02" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '02' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'02',$aux);?>>02</option>
				 <option value="03" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '03' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'03',$aux);?>>03</option>
				 <option value="04" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '04' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'04',$aux);?>>04</option>
				 <option value="05" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '05' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'05',$aux);?>>05</option>
				 <option value="06" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '06' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'06',$aux);?>>06</option>
				 <option value="07" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '07' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'07',$aux);?>>07</option>
				 <option value="08" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '08' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'08',$aux);?>>08</option>
				 <option value="09" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '09' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'09',$aux);?>>09</option>
				 <option value="10" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '10' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'10',$aux);?>>10</option>
				 <option value="11" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '11' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'11',$aux);?>>11</option>
				 <option value="12" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if($r['horas_fin'] > 12)
													   $r['horas_fin'] = $r['horas_fin'] - 12;
													if ($r['horas_fin'] == '12' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('horas_fin_'.$i,'12',$aux);?>>12</option>
			</select>
			
			<select name="minutos_fin_<?php echo $i;?>">
				<option></option>
				 <option value="00" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '00' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'00',$aux);?>>00</option>
				 <option value="05" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '05' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'05',$aux);?>>05</option>
				 <option value="10" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '10' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'10',$aux);?>>10</option>
				 <option value="15" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '15' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'15',$aux);?>>15</option>
				 <option value="20" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '20' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'20',$aux);?>>20</option>
				 <option value="25" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '25' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'25',$aux);?>>25</option>
				 <option value="30" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '30' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'30',$aux);?>>30</option>
				 <option value="35" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '35' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'35',$aux);?>>35</option>
				 <option value="40" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '40' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'40',$aux);?>>40</option>
				 <option value="45" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '45' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'45',$aux);?>>45</option>
				 <option value="50" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '50' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'50',$aux);?>>50</option>
				 <option value="55" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if ($r['minutos_fin'] == '55' && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							echo set_select('minutos_fin_'.$i,'55',$aux);?>>55</option>
			</select>
			
			<select name="ampm_fin_<?php echo $i;?>">
				<option></option>
				 <option value="am" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if (($r['horas_fin'] < 12 || $r['horas_fin'] == 24) && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							
				 							echo set_select('ampm_fin_'.$i,'pm',$aux);?>>a.m.</option>
				 <option value="pm" <?php $aux = FALSE;
											if ($resultados != NULL)
												foreach ($resultados as $r){
													if (($r['horas_fin'] >= 12 && $r['horas_fin'] != 24) && $r['dias']==$dia)
													    $aux = TRUE;
												}
				 							
				 							echo set_select('ampm_fin_'.$i,'pm',$aux);?>>p.m.</option>
			</select>
			
			</div>
		</td>
		</tr>
		<?php }?>
	</table>
	
	</fieldset>
	<div class="botones" align="left" >
		<input type="submit" value="Guardar" />
		<input type="button" value="Cancelar"  onclick='document.location.href="<?php echo site_url();?>/usuarios/cancelar/<?php echo $r['id_usr'];?>"' />
	</div>
	</form>
	</body>
</html>