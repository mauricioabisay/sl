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
		<div id="horario_molde" style="display: none">
			<label id="horario_nombre">Horario</label>
			<select name="horas[]">
			 <option value="01">01</option>
			 <option value="02">02</option>
			 <option value="03">03</option>
			 <option value="04">04</option>
			 <option value="05">05</option>
			 <option value="06">06</option>
			 <option value="07">07</option>
			 <option value="08">08</option>
			 <option value="09">09</option>
			 <option value="10">10</option>
			 <option value="11">11</option>
			 <option value="12">12</option>
			</select>
			<select name="minutos[]">
			 <option value="00">00</option>
			 <option value="05">05</option>
			 <option value="10">10</option>
			 <option value="15">15</option>
			 <option value="20">20</option>
			 <option value="25">25</option>
			 <option value="30">30</option>
			 <option value="35">35</option>
			 <option value="40">40</option>
			 <option value="45">45</option>
			 <option value="50">50</option>
			 <option value="55">55</option>
			</select>
			<select name="ampm[]">
			 <option value="am">a.m.</option>
			 <option value="pm">p.m.</option>
			</select>
</div>

		<form action="<?php echo site_url();?>/medicamento/modificar_datos/<?php echo $id_paciente;?>" method="post" id="formulario" style="width:100%" target="contenido">
		<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
		<fieldset>
		<legend>Medicamento/Suplemento</legend>
		<?php if(isset($medicamentos)&&$medicamentos){$i=0;$num=sizeof($medicamentos);?>
		<?php
			foreach($medicamentos as $medicamento){?>
			<div id="div_<?php echo $i;?>" class="lineal">
						<input type="hidden" name="id_medicamento[]" value="<?php echo $medicamento->id;?>" />
						<label>Tipo:</label>
						<select name="tipo_med[]">
							<option value="Medicamento" <?php echo (($medicamento->tipo_med=='Medicamento'))?'selected="selected"':'';?>>Medicamento</option>
							<option value="Suplemento" <?php echo (($medicamento->tipo_med=='Suplemento'))?'selected="selected"':'';?>>Suplemento</option>
						</select>
						<label>Nombre:</label><input type="text" size="15" name="nombre[]" value="<?php echo $medicamento->nombre;?>" />
						<label>Frec.:</label>
						<input type="text" name="valor_frec[]" readonly="readonly" addHorario($(this))" size="2" value="<?php echo $medicamento->valor_frec;?>" />
						<select name="tipo_frec[]">
							<option value="Diario" <?php echo (($medicamento->tipo_frec=='Diario'))?'selected="selected"':'';?>>Al D&iacute;a</option>
							<option value="Semanal" <?php echo (($medicamento->tipo_frec=='Semanal'))?'selected="selected"':'';?>>A la Semana</option>
						</select>
						<label>Causa:</label><input type="text" name="causa[]" value="<?php echo $medicamento->causa;?>" />
						<label>F.Inicio:</label>
						<label>Mes</label>
					<select name="fecha_ini_mes[]">
						<option value="" <?php echo (($medicamento->fecha_ini_mes==''))?'selected="selected"':'';?>></option>
						<option value="Ene" <?php echo (($medicamento->fecha_ini_mes=='Ene'))?'selected="selected"':'';?>>Enero</option>
						<option value="Feb" <?php echo (($medicamento->fecha_ini_mes=='Feb'))?'selected="selected"':'';?>>Febrero</option>
						<option value="Mar" <?php echo (($medicamento->fecha_ini_mes=='Mar'))?'selected="selected"':'';?>>Marzo</option>
						<option value="Abr" <?php echo (($medicamento->fecha_ini_mes=='Abr'))?'selected="selected"':'';?>>Abril</option>
						<option value="May" <?php echo (($medicamento->fecha_ini_mes=='May'))?'selected="selected"':'';?>>Mayo</option>
						<option value="Jun" <?php echo (($medicamento->fecha_ini_mes=='Jun'))?'selected="selected"':'';?>>Junio</option>
						<option value="Jul" <?php echo (($medicamento->fecha_ini_mes=='Jul'))?'selected="selected"':'';?>>Julio</option>
						<option value="Ago" <?php echo (($medicamento->fecha_ini_mes=='Ago'))?'selected="selected"':'';?>>Agosto</option>
						<option value="Sep" <?php echo (($medicamento->fecha_ini_mes=='Sep'))?'selected="selected"':'';?>>Septiembre</option>
						<option value="Oct" <?php echo (($medicamento->fecha_ini_mes=='Oct'))?'selected="selected"':'';?>>Octubre</option>
						<option value="Nov" <?php echo (($medicamento->fecha_ini_mes=='Nov'))?'selected="selected"':'';?>>Noviembre</option>
						<option value="Dic" <?php echo (($medicamento->fecha_ini_mes=='Dic'))?'selected="selected"':'';?>>Diciembre</option>
					</select>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="fecha_ini_a[]" value="<?php echo $medicamento->fecha_ini_a;?>"/>
						<label>Edo.:</label>
						<select name="status[]">
							<option <?php echo (($medicamento->status=='Activo'))?'selected="selected"':'';?> value="Activo">S&iacute; Consume</option>
							<option <?php echo (($medicamento->status=='Inactivo'))?'selected="selected"':'';?> value="Inactivo">No Consume</option>
						</select>
					<!--	<?php if($i+1 < $num){?>
							<input id="<?php echo $i;?>" type="button" value="-" class="bt_menos" />
						<?php }else{?>
							<input id="<?php echo $i;?>" type="button" value="+" class="bt_mas" />
						<?php }?>-->
					
					<div id="horarios_<?php echo $i;?>">
					<?php
						$j = 0;
						foreach($horarios as $horario){
							
							if($horario->medicamento == $medicamento->id){
					?>
						<input type="hidden" name="id_horario[]" value="<?php echo $horario->id;?>" />
						<div id="horario_<?php echo $j+1;?>">
							<label>Horario <?php echo $j+1;?>:</label>
							<select name="horas[]">
								<option value="01" <?php echo ($horario->horas=='01')?'selected="selected"':'';?>>01</option>
								<option value="02" <?php echo ($horario->horas=='02')?'selected="selected"':'';?>>02</option>
								<option value="03" <?php echo ($horario->horas=='03')?'selected="selected"':'';?>>03</option>
								<option value="04" <?php echo ($horario->horas=='04')?'selected="selected"':'';?>>04</option>
								<option value="05" <?php echo ($horario->horas=='05')?'selected="selected"':'';?>>05</option>
								<option value="06" <?php echo ($horario->horas=='06')?'selected="selected"':'';?>>06</option>
								<option value="07" <?php echo ($horario->horas=='07')?'selected="selected"':'';?>>07</option>
								<option value="08" <?php echo ($horario->horas=='08')?'selected="selected"':'';?>>08</option>
								<option value="09" <?php echo ($horario->horas=='09')?'selected="selected"':'';?>>09</option>
								<option value="10" <?php echo ($horario->horas=='10')?'selected="selected"':'';?>>10</option>
								<option value="11" <?php echo ($horario->horas=='11')?'selected="selected"':'';?>>11</option>
								<option value="12" <?php echo ($horario->horas=='12')?'selected="selected"':'';?>>12</option>
							</select>:
							<select name="minutos[]">
								<option value="00" <?php echo ($horario->minutos=='00')?'selected="selected"':'';?>>00</option>
								<option value="05" <?php echo ($horario->minutos=='05')?'selected="selected"':'';?>>05</option>
								<option value="10" <?php echo ($horario->minutos=='10')?'selected="selected"':'';?>>10</option>
								<option value="15" <?php echo ($horario->minutos=='15')?'selected="selected"':'';?>>15</option>
								<option value="20" <?php echo ($horario->minutos=='20')?'selected="selected"':'';?>>20</option>
								<option value="25" <?php echo ($horario->minutos=='25')?'selected="selected"':'';?>>25</option>
								<option value="30" <?php echo ($horario->minutos=='30')?'selected="selected"':'';?>>30</option>
								<option value="35" <?php echo ($horario->minutos=='35')?'selected="selected"':'';?>>35</option>
								<option value="40" <?php echo ($horario->minutos=='40')?'selected="selected"':'';?>>40</option>
								<option value="45" <?php echo ($horario->minutos=='45')?'selected="selected"':'';?>>45</option>
								<option value="50" <?php echo ($horario->minutos=='50')?'selected="selected"':'';?>>50</option>
								<option value="55" <?php echo ($horario->minutos=='55')?'selected="selected"':'';?>>55</option>
							</select>
							<select name="ampm[]">
								<option value="am" <?php echo ($horario->ampm=='am')?'selected="selected"':'';?>>a.m.</option>
								<option value="pm" <?php echo ($horario->ampm=='pm')?'selected="selected"':'';?>>p.m.</option>
							</select>
					<?php $j++;}}
					
					?>
					</div>
				</div>
				</div>
				<?php $i++;} ?>
			<!--
			<?php }else {$num = (isset($nombre))?sizeof($nombre):0;//Obtenemos el valor de campos que agregamos?>
			
				<div id="div_0" class="lineal">
					<label>Tipo:</label>
					<select name="tipo_med[]">
						<option value="Medicamento" <?php echo ((isset($tipo_med))&&($tipo_med[0]=='Medicamento'))?'selected="selected"':'';?>>Medicamento</option>
						<option value="Suplemento" <?php echo ((isset($tipo_med))&&($tipo_med[0]=='Suplemento'))?'selected="selected"':'';?>>Suplemento</option>
					</select>
					<label>Nombre:</label><input type="text" size="15" name="nombre[]" value="<?php echo (isset($nombre))?$nombre[0]:'';?>" />
					<label>Frec.:</label>
					<input type="text" name="valor_frec[]" onchange="addHorario($(this))" size="2" value="<?php echo (isset($nombre))?$valor_frec[0]:'';?>" />
					<select name="tipo_frec[]">
						<option value="Diario" <?php echo ((isset($tipo_frec))&&($tipo_frec[0]=='Diario'))?'selected="selected"':'';?>>Al D&iacute;a</option>
						<option value="Semanal" <?php echo ((isset($tipo_frec))&&($tipo_frec[0]=='Semanal'))?'selected="selected"':'';?>>A la Semana</option>
					</select>
					<label>Causa:</label><input type="text" name="causa[]" value="<?php echo (isset($causa))?$causa[0]:'';?>" />
					<label>F.Inicio:</label>
					<label>Mes</label>
					<select name="fecha_ini_mes[]">
						<option value="" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]==''))?'selected="selected"':'';?>></option>
						<option value="Ene" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Ene'))?'selected="selected"':'';?>>Enero</option>
						<option value="Feb" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Feb'))?'selected="selected"':'';?>>Febrero</option>
						<option value="Mar" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Mar'))?'selected="selected"':'';?>>Marzo</option>
						<option value="Abr" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Abr'))?'selected="selected"':'';?>>Abril</option>
						<option value="May" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='May'))?'selected="selected"':'';?>>Mayo</option>
						<option value="Jun" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Jun'))?'selected="selected"':'';?>>Junio</option>
						<option value="Jul" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Jul'))?'selected="selected"':'';?>>Julio</option>
						<option value="Ago" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Ago'))?'selected="selected"':'';?>>Agosto</option>
						<option value="Sep" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Sep'))?'selected="selected"':'';?>>Septiembre</option>
						<option value="Oct" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Oct'))?'selected="selected"':'';?>>Octubre</option>
						<option value="Nov" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Nov'))?'selected="selected"':'';?>>Noviembre</option>
						<option value="Dic" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[0]=='Dic'))?'selected="selected"':'';?>>Diciembre</option>
					</select>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="fecha_ini_a[]" value="<?php echo (isset($fecha_ini_a))?$fecha_ini_a[0]:'';?>"/>
					<label>Edo.:</label>
					<select name="status[]">
						<option <?php echo ((isset($status))&&($status[0]=='Activo'))?'selected="selected"':'';?> value="Activo">S&iacute; Consume</option>
						<option <?php echo ((isset($status))&&($status[0]=='Inactivo'))?'selected="selected"':'';?> value="Inactivo">No Consume</option>
					</select>
					<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
					
					<div id="horarios_0">
					<?php 
						$veces_aux = $veces = (isset($horas))?$valor_frec[0]:0;
						for($j=0; $j < $veces; $j++){
					?>
						<div id="horario_<?php echo $j+1;?>">
							<label>Horario <?php echo $j+1;?>:</label>
							<select name="horas[]">
								<option value="01" <?php echo (isset($horas)&&($horas[$j]=='01'))?'selected="selected"':'';?>>01</option>
								<option value="02" <?php echo (isset($horas)&&($horas[$j]=='02'))?'selected="selected"':'';?>>02</option>
								<option value="03" <?php echo (isset($horas)&&($horas[$j]=='03'))?'selected="selected"':'';?>>03</option>
								<option value="04" <?php echo (isset($horas)&&($horas[$j]=='04'))?'selected="selected"':'';?>>04</option>
								<option value="05" <?php echo (isset($horas)&&($horas[$j]=='05'))?'selected="selected"':'';?>>05</option>
								<option value="06" <?php echo (isset($horas)&&($horas[$j]=='06'))?'selected="selected"':'';?>>06</option>
								<option value="07" <?php echo (isset($horas)&&($horas[$j]=='07'))?'selected="selected"':'';?>>07</option>
								<option value="08" <?php echo (isset($horas)&&($horas[$j]=='08'))?'selected="selected"':'';?>>08</option>
								<option value="09" <?php echo (isset($horas)&&($horas[$j]=='09'))?'selected="selected"':'';?>>09</option>
								<option value="10" <?php echo (isset($horas)&&($horas[$j]=='10'))?'selected="selected"':'';?>>10</option>
								<option value="11" <?php echo (isset($horas)&&($horas[$j]=='11'))?'selected="selected"':'';?>>11</option>
								<option value="12" <?php echo (isset($horas)&&($horas[$j]=='12'))?'selected="selected"':'';?>>12</option>
							</select>:
							<select name="minutos[]">
								<option value="00" <?php echo (isset($minutos)&&($minutos[$j]=='00'))?'selected="selected"':'';?>>00</option>
								<option value="05" <?php echo (isset($minutos)&&($minutos[$j]=='05'))?'selected="selected"':'';?>>05</option>
								<option value="10" <?php echo (isset($minutos)&&($minutos[$j]=='10'))?'selected="selected"':'';?>>10</option>
								<option value="15" <?php echo (isset($minutos)&&($minutos[$j]=='15'))?'selected="selected"':'';?>>15</option>
								<option value="20" <?php echo (isset($minutos)&&($minutos[$j]=='20'))?'selected="selected"':'';?>>20</option>
								<option value="25" <?php echo (isset($minutos)&&($minutos[$j]=='25'))?'selected="selected"':'';?>>25</option>
								<option value="30" <?php echo (isset($minutos)&&($minutos[$j]=='30'))?'selected="selected"':'';?>>30</option>
								<option value="35" <?php echo (isset($minutos)&&($minutos[$j]=='35'))?'selected="selected"':'';?>>35</option>
								<option value="40" <?php echo (isset($minutos)&&($minutos[$j]=='40'))?'selected="selected"':'';?>>40</option>
								<option value="45" <?php echo (isset($minutos)&&($minutos[$j]=='45'))?'selected="selected"':'';?>>45</option>
								<option value="50" <?php echo (isset($minutos)&&($minutos[$j]=='50'))?'selected="selected"':'';?>>50</option>
								<option value="55" <?php echo (isset($minutos)&&($minutos[$j]=='55'))?'selected="selected"':'';?>>55</option>
							</select>
							<select name="ampm[]">
								<option value="am" <?php echo (isset($ampm)&&($ampm[$j]=='am'))?'selected="selected"':'';?>>a.m.</option>
								<option value="pm" <?php echo (isset($ampm)&&($ampm[$j]=='pm'))?'selected="selected"':'';?>>p.m.</option>
							</select>
					<?php }?>
					</div>
				</div>
				</div>
				<?php for($i=1; $i < $num; $i++){?>
					<div id="div_<?php echo $i;?>" class="lineal">
						<label>Tipo:</label>
						<select name="tipo_med[]">
							<option value="Medicamento" <?php echo ((isset($tipo_med))&&($tipo_med[$i]=='Medicamento'))?'selected="selected"':'';?>>Medicamento</option>
							<option value="Suplemento" <?php echo ((isset($tipo_med))&&($tipo_med[$i]=='Suplemento'))?'selected="selected"':'';?>>Suplemento</option>
						</select>
						<label>Nombre:</label><input type="text" size="15" name="nombre[]" value="<?php echo (isset($nombre))?$nombre[$i]:'';?>" />
						<label>Frec.:</label>
						<input type="text" name="valor_frec[]" size="2" value="<?php echo (isset($nombre))?$valor_frec[$i]:'';?>" />
						<select name="tipo_frec[]">
							<option value="Diario" <?php echo ((isset($tipo_frec))&&($tipo_frec[$i]=='Diario'))?'selected="selected"':'';?>>Al D&iacute;a</option>
							<option value="Semanal" <?php echo ((isset($tipo_frec))&&($tipo_frec[$i]=='Semanal'))?'selected="selected"':'';?>>A la Semana</option>
						</select>
						<label>Causa:</label><input type="text" name="causa[]" value="<?php echo (isset($causa))?$causa[$i]:'';?>" />
						<label>F.Inicio:</label>
						<label>Mes</label>
					<select name="fecha_ini_mes[]">
						<option value="" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]==''))?'selected="selected"':'';?>></option>
						<option value="Ene" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Ene'))?'selected="selected"':'';?>>Enero</option>
						<option value="Feb" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Feb'))?'selected="selected"':'';?>>Febrero</option>
						<option value="Mar" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Mar'))?'selected="selected"':'';?>>Marzo</option>
						<option value="Abr" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Abr'))?'selected="selected"':'';?>>Abril</option>
						<option value="May" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='May'))?'selected="selected"':'';?>>Mayo</option>
						<option value="Jun" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Jun'))?'selected="selected"':'';?>>Junio</option>
						<option value="Jul" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Jul'))?'selected="selected"':'';?>>Julio</option>
						<option value="Ago" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Ago'))?'selected="selected"':'';?>>Agosto</option>
						<option value="Sep" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Sep'))?'selected="selected"':'';?>>Septiembre</option>
						<option value="Oct" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Oct'))?'selected="selected"':'';?>>Octubre</option>
						<option value="Nov" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Nov'))?'selected="selected"':'';?>>Noviembre</option>
						<option value="Dic" <?php echo ((isset($fecha_ini_mes))&&($fecha_ini_mes[$i]=='Dic'))?'selected="selected"':'';?>>Diciembre</option>
					</select>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="fecha_ini_a[]" value="<?php echo (isset($fecha_ini_a))?$fecha_ini_a[$i]:'';?>"/>
						<label>Edo.:</label>
						<select name="status[]">
							<option <?php echo ((isset($status))&&($status[$i]=='Activo'))?'selected="selected"':'';?> value="Activo">S&iacute; Consume</option>
							<option <?php echo ((isset($status))&&($status[$i]=='Inactivo'))?'selected="selected"':'';?> value="Inactivo">No Consume</option>
						</select>
						<?php if($i+1 < $num){?>
							<input id="<?php echo $i;?>" type="button" value="-" class="bt_menos" />
						<?php }else{?>
							<input id="<?php echo $i;?>" type="button" value="+" class="bt_mas" />
						<?php }?>
					
					<div id="horarios_<?php echo $i;?>">
					<?php
						$veces = (isset($horas))?$valor_frec[$i]:0;
						for($j=0; $j < $veces; $j++){
					?>
						<div id="horario_<?php echo $j+1;?>">
							<label>Horario <?php echo $j+1;?>:</label>
							<select name="horas[]">
								<option value="01" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='01'))?'selected="selected"':'';?>>01</option>
								<option value="02" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='02'))?'selected="selected"':'';?>>02</option>
								<option value="03" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='03'))?'selected="selected"':'';?>>03</option>
								<option value="04" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='04'))?'selected="selected"':'';?>>04</option>
								<option value="05" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='05'))?'selected="selected"':'';?>>05</option>
								<option value="06" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='06'))?'selected="selected"':'';?>>06</option>
								<option value="07" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='07'))?'selected="selected"':'';?>>07</option>
								<option value="08" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='08'))?'selected="selected"':'';?>>08</option>
								<option value="09" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='09'))?'selected="selected"':'';?>>09</option>
								<option value="10" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='10'))?'selected="selected"':'';?>>10</option>
								<option value="11" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='11'))?'selected="selected"':'';?>>11</option>
								<option value="12" <?php echo (isset($horas)&&($horas[$j+$veces_aux]=='12'))?'selected="selected"':'';?>>12</option>
							</select>:
							<select name="minutos[]">
								<option value="00" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='00'))?'selected="selected"':'';?>>00</option>
								<option value="05" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='05'))?'selected="selected"':'';?>>05</option>
								<option value="10" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='10'))?'selected="selected"':'';?>>10</option>
								<option value="15" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='15'))?'selected="selected"':'';?>>15</option>
								<option value="20" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='20'))?'selected="selected"':'';?>>20</option>
								<option value="25" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='25'))?'selected="selected"':'';?>>25</option>
								<option value="30" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='30'))?'selected="selected"':'';?>>30</option>
								<option value="35" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='35'))?'selected="selected"':'';?>>35</option>
								<option value="40" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='40'))?'selected="selected"':'';?>>40</option>
								<option value="45" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='45'))?'selected="selected"':'';?>>45</option>
								<option value="50" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='50'))?'selected="selected"':'';?>>50</option>
								<option value="55" <?php echo (isset($minutos)&&($minutos[$j+$veces_aux]=='55'))?'selected="selected"':'';?>>55</option>
							</select>
							<select name="ampm[]">
								<option value="am" <?php echo (isset($ampm)&&($ampm[$j+$veces_aux]=='am'))?'selected="selected"':'';?>>a.m.</option>
								<option value="pm" <?php echo (isset($ampm)&&($ampm[$j+$veces_aux]=='pm'))?'selected="selected"':'';?>>p.m.</option>
							</select>
					<?php }
						  $veces_aux += $veces;
					?>
					</div>
				</div>
				</div>
				<?php }
				} ?>-->
			</fieldset>
				<div class="botones" align="center">
				<input type="submit" value="Guardar" />
				<input type="reset" value="Restaurar" />
			</div>
		</form>
		</div>
		<script>
		$('#formulario').submit(function(){setTimeout(function(){
				parent.listado_mini.location='<?php echo site_url()?>/medicamento/listado_mini/<?php echo $id_paciente;?>';
			},300);});
		</script>
	</body>
</html>