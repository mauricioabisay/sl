<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<a href="<?php echo site_url()?>/laboratorio/listado/<?php echo $id_paciente;?>" target="contenido">Regresar al Listado</a>
<form action="<?php echo site_url();?>/laboratorio/modificar/<?php echo $laboratorio->id;?>" method="post" id="ficha" style="width:100%">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<input type="hidden" name="id" value="<?php echo $id;?>" />
<fieldset>
		<legend>Laboratorio</legend>
		<div class="columnaizq" style="width: 45%">
			<?php 
			if(isset($laboratorio->fecha_solicitud)){
				$this->load->view('laboratorio/extras/laboratorio_ficha_solicitud');
			}else{?>
			<fieldset>
				<legend>Solicitud de Laboratorios</legend>
				<p>Estos Estudios de Laboratorio no fueron solicitados.</p>
			</fieldset>	
			<?php }?>	
		</div>
		<div class="columnader">
			<?php 
				if(isset($estudios)&&$estudios){
					$this->load->view('laboratorio/extras/laboratorio_ficha_recepcion');
			?>	
			<?php }else{?>
			<fieldset>
				<legend>Resultados de Laboratorios</legend>
				<p>Los Resultados de los Estudios de Laboratorio no han sido capturados.</p>
			</fieldset>
			<?php }?>
			
		</div>
</fieldset>
<div class="botones" align="center">
	<!--<input type="submit" value="Modificar" />-->
	<input type="button" value="Cancelar" onclick="document.location.href='<?php echo site_url();?>/laboratorio/listado/<?php echo $id_paciente;?>';" />
</div>			
</form>
</body>
</html>