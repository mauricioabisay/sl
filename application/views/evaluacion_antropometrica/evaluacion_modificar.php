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
	<script> 
		function calcula(){ 
		   	var fondo = parseInt(document.formulario.fondo_uterino.value); 
		   	var result = (fondo + 4)/4;
		   	if (fondo >=20 && fondo <= 31)
		   		var result2 = fondo;
		   	else
		   		var result2 = 'N/A';
		   	
			document.formulario.meses_gesta.value = result;
			document.formulario.semanas_gesta.value = result2;
			
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
<a href="<?php echo site_url()?>/evaluacion/listado/<?php echo $id_paciente;?>">Regresar al Listado</a>
<?php echo validation_errors();?>
<form id="formulario" name="formulario" action="<?php echo site_url();?>/evaluacion/modificar/<?php echo $id_evaluacion;?>" method="post" enctype="multipart/form-data" style="width: 100%">
	<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
	<div class="columnaizq">
	<fieldset>
		<legend>Evaluaci&oacute;n Antropom&eacute;trica</legend>
		<?php 
			if($edad<2){
				$this->load->view('evaluacion_antropometrica/extras/evaluacion_modificar_0a2');
			}else if($edad<5){
				$this->load->view('evaluacion_antropometrica/extras/evaluacion_modificar_2a5');
			}else if($edad<7){
				$this->load->view('evaluacion_antropometrica/extras/evaluacion_modificar_5a7');
			}else if($edad<12){
				$this->load->view('evaluacion_antropometrica/extras/evaluacion_modificar_7a12');
			}else{
				$this->load->view('evaluacion_antropometrica/extras/evaluacion_modificar_12a18');
			}
		?>
	</fieldset>
	<fieldset>
		<legend>Presión y Glucosa</legend>
		<div class="lineal_eval">
			<label>Presi&oacute;n:</label>
			<input type="text" name="presion_sis" maxlength="3" size="3" value="<?php echo set_value('presion_sis',((isset($evaluacion))&&($evaluacion))?$evaluacion->presion_sis:'');?>"/>
			<strong>/</strong>
			<input type="text" name="presion_dia" maxlength="3" size="3" value="<?php echo set_value('presion_dia',((isset($evaluacion))&&($evaluacion))?$evaluacion->presion_dia:'');?>"/>
			<strong>mm Hg</strong>
			<?php echo form_error('presion_sis');?>
			<?php echo form_error('presion_dia');?>
		</div>
		<div class="lineal_eval">
			<label>Glucosa:</label>
			<input type="text" name="glucosa" maxlength="3" size="3" value="<?php echo set_value('glucosa',((isset($evaluacion))&&($evaluacion))?$evaluacion->glucosa:'');?>"/>
			<strong>mg/dl</strong>
			<?php echo form_error('glucosa');?>
		</div>
		
	</fieldset>
	<fieldset>
		<legend>Peso Saludable y Peso Meta</legend>
		<div class="lineal_eval">
			<label>Peso Saludable:</label>
			<input type="text" name="peso_saludable" maxlength="6" size="5" value="<?php echo set_value('peso_saludable',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso_saludable:'');?>" />
			<strong>kgs.</strong>
			<?php echo form_error('peso_saludable');?>
		</div>
		<div class="lineal_eval">
			<label>Peso Meta:</label>
			<input type="text" name="peso_meta" maxlength="6" size="5" value="<?php echo set_value('peso_meta',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso_meta:'');?>" />
			<strong>kgs.</strong>
			<?php echo form_error('peso_meta');?>
		</div>
	</fieldset>
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar" />
	</div>
	</div>
	<?php if($edad >= 7){?>
	<div id="tanita" class="columnader" style="margin-left:5em; <?php echo (($this->input->post())&&($this->input->post('tanita'))=='Si')||(isset($tanita_general)&&$tanita_general)?'': 'display: none;';?>">
		<input type="hidden" id="tanita_boolean" name="tanita" value="<?php echo set_value('tanita',(isset($tanita_general)&&$tanita_general)?'Si':'No');?>" />
		<?php $this->load->view('evaluacion_antropometrica/extras/evaluacion_modificar_tanita');?>
	</div>
	<?php }?>
</form>
<script>
$('#formulario').submit(function(){setTimeout(function(){
		parent.listado_mini.location='<?php echo site_url()?>/evaluacion/listado_mini/<?php echo $id_paciente;?>';
	},150);});
</script>
</body>
</html>