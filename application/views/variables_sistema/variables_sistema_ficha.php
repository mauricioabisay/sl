<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>	
		
	</head>
	<body>

	<?php 
		if(isset($tipo)){
			echo '<div><span id="'.$tipo.'">';
			echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
			echo '</span></div>';
		}
		?>
	<div id="form">
	<form action="" method="post" name="formulario" id="formulario" style="width: 70%">	
	<div class="columnaizq">
		<fieldset>
			<legend>Horario general</legend>
			<table class="tabla_formulario">
				<tr>
					<th>D&iacute;as</th><th>Hora de entrada:</th><th>Hora de salida:</th>
				</tr>
				<?php   if ($resultados != NULL)
						foreach ($resultados as $datos){
						    if ($datos['hora_ini']!= NULL){?>
				<tr><td><?php echo $datos['dias'];?></td>
					<td><?php echo $datos['hora_ini'];?></td>
					<td><?php echo $datos['hora_fin'];?></td>
				</tr>
				<?php }}?>
		
			</table>
		</fieldset>
	</div>
	<div class="columnader">
		<fieldset>
			<legend>D&iacute;as no laborales</legend>
			<table class="tabla_formulario">
				<tr>
					<th>Fecha inicio:</th><th>Fecha fin:</th>
				</tr>
				<?php   if ($resultados != NULL)
						foreach ($resultados as $datos){
					     	if ($datos['fecha_ini']!= NULL){	?>
				<tr><td><?php echo $datos['fecha_ini'];?></td>
					<td><?php echo $datos['fecha_fin'];?></td>
				</tr>
				<?php } }?>
		
			</table>
		</fieldset>
		<div class="botones" align="left" >
		<input type="button" value="Modificar" onclick='document.location.href = "<?php echo site_url();?>/variables_sistema/modificar"'/>
		<input type="button" value="Cerrar"  onclick='document.location.href = "<?php echo site_url();?>/variables_sistema/cerrar"' />
		</div>
	</div>
	
	
	</form>
	</div>
	</body>
</html>