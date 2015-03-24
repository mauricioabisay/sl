<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>
	</head>
	<body>
<a href="<?php echo site_url()?>/evaluacion/listado/<?php echo $id_paciente;?>">Regresar al Listado</a>
<?php if(!$preguntas_seguimiento){?>
		<a target="contenido" href="<?php echo site_url()?>/preguntas_seguimiento/agregar/<?php echo ''.$id_paciente.'/'.$evaluacion->id.'';?>">Agregar Preguntas de Seguimiento</a>
<?php }else{?>
		<a target="contenido" href="<?php echo site_url()?>/preguntas_seguimiento/detalle/<?php echo ''.$id_paciente.'/'.$evaluacion->id.'';?>">Ver Preguntas de Seguimiento</a>
<?php }?>
<form id="ficha" method="post" enctype="multipart/form-data" style="width: 100%">
	
	<fieldset class="columnaizq" style="padding:0.2em">
		<legend>M&eacute;tricas Evaluaci&oacute;n Antropom&eacute;trica</legend>
		<fieldset>
		<legend>Peso y <?php echo ($evaluacion->estatura>1)?'Estatura':'Longitud';?></legend>
			<div class="lineal"><label>Peso:</label><span><?php echo $evaluacion->peso;?></span><strong>kgs.</strong></div>
			<div class="lineal"><label><?php echo ($evaluacion->estatura>1)?'Estatura':'Longitud';?>:</label><span><?php echo $evaluacion->estatura;?></span><strong>mts.</strong></div>
		</fieldset>
		<?php if(7<=$edad){?>
		<fieldset>
			<legend>Grasa Corporal</legend>
			<div class="lineal"><label>% Grasa Corporal(medici&oacute;n tanita):</label><span><?php echo $evaluacion->grasa;?></span><strong>%</strong></div>
			<div class="lineal"><label>Kgs. Grasa Corporal(medici&oacute;n tanita):</label><span><?php echo number_format(($evaluacion->peso*($evaluacion->grasa/100)),2);?></span><strong>Kgs.</strong></div>
			<?php if($grasa_pliegues){?>
				<div class="lineal"><label>% Grasa Corporal(medici&oacute;n plicómetro):</label><span><?php echo $grasa_pliegues;?></span><strong>%</strong></div>
				<div class="lineal"><label>Kgs. Grasa Corporal(medici&oacute;n plicómetro):</label><span><?php echo number_format(($evaluacion->peso*($grasa_pliegues/100)),2);?></span><strong>Kgs.</strong></div>
			<?php }?>
			<?php if(17<=$edad){?>
			<fieldset>
				<legend>Pliegues<input type="button" value="+" onclick='$("#pliegues").toggle(200);' style="display: inline" /></legend>
				<div id="pliegues" style="display: none">
					<div class="lineal"><label>P. Biciptal:</label><span><?php echo $evaluacion->p_biciptal;?></span>mm.</div>
					<div class="lineal"><label>P. Triciptal:</label><span><?php echo $evaluacion->p_triciptal;?></span>mm.</div>
					<div class="lineal"><label>P. Subescapular:</label><span><?php echo $evaluacion->p_subescapular;?></span>mm.</div>
					<div class="lineal"><label>P. Suprailiaco:</label><span><?php echo $evaluacion->p_suprailiaco;?></span>mm.</div>
					<div class="lineal"><strong><label>Sumatoria:</label><span><?php echo ($evaluacion->p_biciptal+$evaluacion->p_triciptal+$evaluacion->p_subescapular+$evaluacion->p_suprailiaco);?></span>mm.</strong></div>
					<?php if($grasa_pliegues){?>
						<div class="lineal"><strong><label>% Grasa Corporal(medici&oacute;n plicómetro):</label><span><?php echo $grasa_pliegues;?></span>%</strong></div>
					<?php }?>
				</div>
			</fieldset>
			<?php }?>
		</fieldset>
		<?php }?>
		<?php
			if(7<=$edad){
				$this->load->view('evaluacion_antropometrica/tanita_ficha');	
			}
		?>
		<fieldset>
			<legend>Per&iacute;metros y Circunferencias</legend>
			<?php if(12<=$edad){?>
				<div class="lineal"><label>Circ. Cintura:</label><span><?php echo $evaluacion->c_cintura;?></span><strong>cms.</strong></div>
				<div class="lineal"><label>Circ. Cadera:</label><span><?php echo $evaluacion->c_cadera;?></span><strong>cms.</strong></div>
			<?php }?>
			<?php if($evaluacion->c_muneca>0){?>
				<div class="lineal"><label>Circ. Mu&ntilde;eca:</label><span><?php echo $evaluacion->c_muneca;?></span><strong>cms.</strong></div>
			<?php }?>
			<?php if($evaluacion->c_brazo>0){?>
				<?php if($evaluacion->perim_cefalico>0){?>
						<div class="lineal"><label>Per&iacute;m. Cef&aacute;lico:</label><span><?php echo $evaluacion->perim_cefalico;?></span><strong>cms.</strong></div>
				<?php }?>
				<div class="lineal"><label>Circ. Brazo:</label><span><?php echo $evaluacion->c_brazo;?></span><strong>cms.</strong></div>
			<?php }?>
		</fieldset>
		<?php if($mujer){?>
		<fieldset>
			<legend>Datos Embarazo</legend>
			<div class="lineal"><label>Embarazo:</label><?php echo (isset($embarazo))?'Si':'No';?></div>
			<div id="ocultar" <?php echo (isset($embarazo))?'':'style="display: none;"'?>>
				<div class="lineal"><label>Peso previo a la gestaci&oacute;n:</label><span><?php echo $evaluacion->peso_pre_gesta;?></span><strong>kgs.</strong></div>
				<div class="lineal"><label>Fondo uterino:</label><span><?php echo $evaluacion->fondo_uterino; $aux=$evaluacion->fondo_uterino;?></span><strong>cms.</strong></div>
				<fieldset>
					<legend>Edad gestacional</legend>
					<div class="lineal" >
						<label>F&oacute;rmula de ALFEHLD: </label>
						<span><?php echo ($aux+4)/4;?></span><strong>meses</strong>
					</div>
					<div class="lineal" >
						<label>M&eacute;todo de McDonald: </label>
						<span><?php $aux2=$evaluacion->fondo_uterino;
								echo ($aux2>=20 && $aux2<=31)?$aux2:'N/A'?></span><strong>semanas</strong>
					</div>
				</fieldset>
			</div>	
		</fieldset>
		<?php }?>
		<fieldset>
		<legend>Presión y Glucosa</legend>
		<div class="lineal">
			<label>Presi&oacute;n:</label>
		<span><?php echo $evaluacion->presion;?></span>
			<strong>mm Hg</strong>
		</div>
		<div class="lineal">
			<label>Glucosa:</label>
			<span><?php echo $evaluacion->glucosa;?></span>
			<strong>mg/dl</strong>
		</div>
		
	</fieldset>
		
	</fieldset>
	
	<fieldset class="columnader" style="padding:0.2em">
		<legend>Evaluaci&oacute;n<input type="button" value="Ver todos" onclick='$(".listado_oculto").toggle(200);$(".lineal_oculto").toggle(200);' style="display: inline" /></legend>
		<?php
			if($menor){
		?>
				<div class="columnaizq">
					<?php $this->load->view('evaluacion_antropometrica/extras/evaluacion_infante');?>
				</div>
				<div class="columnaizq">
					<?php $this->load->view('evaluacion_antropometrica/extras/evaluacion_infante_ideal');;?>
				</div>
		<?php
			}else if(($mujer)&&(isset($embarazo))){
				$this->load->view('evaluacion_antropometrica/extras/evaluacion_embarazo');
			}else{?>
				<div class="columnaizq" style="width:50%">
					<?php $this->load->view('evaluacion_antropometrica/extras/evaluacion_adulto');?>
				</div>
				<div class="columnader" style="width:50%">
					<?php $this->load->view('evaluacion_antropometrica/extras/evaluacion_adulto_ideal');?>
				</div>
		<?php
			}
		?>
	</fieldset>
</form>
</body>
</html>