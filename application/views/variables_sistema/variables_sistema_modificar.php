<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery-ui.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery.ui.datepicker-es.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>
		
		
		<script language="JavaScript" type="text/javascript">
			//Variable que almacena el número total de fechas 
			var num = 0;
			
			//Función que agrega filas para introducir fechas		
			function agregarFecha(){
				num= parseInt(document.getElementById("num_fechas").value)+1;
				document.getElementById("num_fechas").value= num;
				
				fila = document.getElementById("dias_festivos").insertRow(-1);
				columna = fila.insertCell(-1);
				columna.innerHTML= "<td><input class='date_fecha' type='text' name='fecha_ini_"+num+"'/></td>";
				$('.date_fecha').datepicker();
				
				columna = fila.insertCell(-1);
				columna.innerHTML= "<td><input class='date_fecha' type='text' name='fecha_fin_"+num+"'/></td>";
				$('.date_fecha').datepicker();
				
				num++;
			}
			
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
<form action="<?php echo site_url();?>/variables_sistema/modificar_datos" method="post" name="formulario" id="formulario" style="width: 70%">
<div id="form">
<div class="columnaizq">		   
	<fieldset>
		<legend>Horario general</legend>
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
</div>		 
<div class="columnader">
	<fieldset>
		<legend>D&iacute;as no laborales</legend>
	   <div align="center">
	   		<table class="tabla_formulario" id="dias_festivos" >
				<tr><th >Fecha inicio:</th><th>Fecha fin:</th></tr>
				<?php
					$j = 0;
					if ($resultados != NULL)
					  foreach ($resultados as $r){
					  	if ($r['fecha_ini'] != NULL){
					  		echo '<tr><td><input class="date_fecha" type="text" value="'.$r['fecha_ini'].'" name="fecha_ini_'.$j.'"/></td>';
					  		echo '<td><input class="date_fecha" type="text" value="'.$r['fecha_fin'].'" name="fecha_fin_'.$j.'"</td></tr>';
					  		$j++;
							}  
					}
				?>
			</table>
			<input type="button" value="Agregar Fecha" onclick="agregarFecha()"/>
	   </div>
	</fieldset>
	<input type="text" name="num_fechas" id="num_fechas" value="<?php echo $j;?>"/>
	<input type="text" name ="aux" id="aux" value=""/>
	
  <div class="botones">
	<input type="submit" value="Guardar" />
	<input type="button" value="Cancelar" onclick='document.location.href="<?php echo site_url();?>/variables_sistema/cancelar"'/>
  </div>	
</div>
</div>
</form>
</body>
</html>