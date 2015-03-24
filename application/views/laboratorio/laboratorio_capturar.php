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
echo validation_errors();
?>
<a href="<?php echo site_url()?>/laboratorio/listado/<?php echo $id_paciente;?>">Regresar al Listado</a>
<form action="<?php echo site_url()?>/laboratorio/capturar_resultados/<?php echo $id;?>" method="post" id="formulario" name="formulario" target="contenido" style="width: 100%">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<input type="hidden" name="id" value="<?php echo $id;?>" />
<?php if(isset($fecha_solicitud)&&($fecha_solicitud)){?>
	<input type="hidden" name="fecha_solicitud" value="<?php echo $fecha_solicitud->format('Y-m-d');?>" />
<?php }?>
<?php if(isset($fecha_captura)&&($fecha_captura)){?>
	<input type="hidden" name="fecha_captura" value="<?php echo $fecha_captura->format('Y-m-d');?>" />	
<?php }?>
	<fieldset>
		<legend>Laboratorio</legend>
		<div class="columnaizq" style="width: 45%">
			<?php 
			if(isset($fecha_solicitud)&&$fecha_solicitud){
				$this->load->view('laboratorio/extras/laboratorio_modificar_solicitud');
			}else{?>
			<fieldset>
				<legend>Solicitud de Laboratorios</legend>
				<input type="hidden" name="lab_sol" value="No" />
				<p>Estos Estudios de Laboratorio no fueron solicitados.</p>
			</fieldset>	
			<?php }?>	
		</div>
		<div class="columnader">
			<?php $this->load->view('laboratorio/extras/laboratorio_modificar_recepcion');?>
		</div>
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