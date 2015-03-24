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
<a href="<?php echo site_url()?>/laboratorio/listado/<?php echo $id_paciente;?>" target="contenido">Regresar al Listado</a>
<form action="<?php echo site_url()?>/laboratorio/solicitar/<?php echo $id_paciente;?>" method="post" id="formulario" name="formulario">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
	<fieldset>
		<legend>Laboratorio</legend>
		<?php $this->load->view('laboratorio/extras/laboratorio_solicitar_solicitud');?>
		<?php //$this->load->view('laboratorio/laboratorio_agregar_recepcion');?>
	</fieldset>
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar"/>
	</div>
</form>
<script>
$('#formulario').submit(function(){setTimeout(function(){
		parent.listado_mini.location='<?php echo site_url()?>/laboratorio/listado_mini/<?php echo $id_paciente;?>';
	},100);});
</script>
</body>
</html>