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
<a href="<?php echo site_url()?>/evdietetica/listado/<?php echo $id_paciente;?>" target="contenido">Regresar al Listado</a>
<form action="<?php echo site_url();?>/evdietetica/agregar/<?php echo $id_paciente;?>" method="post" id="formulario" style="width:100%" target="contenido">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<fieldset>
	<legend>Evaluaci&oacute;n Diet&eacute;tica</legend>		
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_agregar_recordatorio');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_agregar_frecuencia_alimentos');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_agregar_historial');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_agregar_habitos');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_agregar_generales');?>
</fieldset>
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar"/>
	</div>
</form>
<script>
$('#formulario').submit(function(){setTimeout(function(){
		parent.listado_mini.location='<?php echo site_url()?>/evdietetica/listado_mini/<?php echo $id_paciente;?>';
	},300);});
</script>
</body>
</html>