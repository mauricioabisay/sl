<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<a href="<?php echo site_url()?>/evdietetica/listado/<?php echo $id_paciente;?>" target="contenido">Regresar al Listado</a>
<form method="post" id="ficha" style="width:53%">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<fieldset>
	<legend>Evaluaci&oacute;n Diet&eacute;tica</legend>		
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_ficha_recordatorio');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_ficha_frecuencia_alimentos');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_ficha_historial');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_ficha_habitos');?>
	<?php $this->load->view('evaluacion_dietetica/extras/evaluacion_ficha_generales');?>
</fieldset>
<!--
<div class="botones" align="center">
		<input type="submit" value="Guardar y Salir" />
		<input type="reset" value="Limpiar"/>
</div>
-->
</form>
</body>
</html>