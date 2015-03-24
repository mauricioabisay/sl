<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<div align="center">
<form method="post" id="ficha" style="width:100%">
<fieldset class="columnaizq">
	<legend>Inf. <?php echo $medicamento->tipo_med;?></legend>		
	<p><label>Nombre:</label><?php echo $medicamento->nombre;?></p>
	<p><label>Tipo:</label><?php echo $medicamento->tipo_med;?></p>
	<p>
		<label>Frecuencia:</label>
		<?php echo ''.$medicamento->valor_frec.' veces ';?>
		<?php echo ($medicamento->tipo_frec=="Diario")?'al d&iacute;a':'por semana';?>
	</p>
	<p><label>Causa:</label><?php echo $medicamento->causa;?></p>
	<p>
	<label>Consumo:</label>
	<?php
	switch($medicamento->status){
		case 'Activo':{echo 'S&iacute; Consume';break;}
		case 'Suspendido':{echo 'S&iacute; Consume';break;}
		case 'Inactivo':{echo 'S&iacute; Consume';break;}
	}
	?>
	</p>
</fieldset>
<fieldset class="columnader">
	<legend>Horarios</legend>
	<table class="listado_mini" style="margin-top:0em;padding-top:0em;font-size:90%">
		<thead>
			<tr><th>Hora</th></tr>
		</thead>
		<tbody>
	<?php if(isset($horarios)&&$horarios){foreach($horarios as $horario){?>
		<tr><td><?php echo $horario->horario;?></td></tr>
	<?php }}?>
		</tbody>
	</table>
</fieldset>
<!--
<div class="botones" align="center">
		<input type="submit" value="Guardar y Salir" />
		<input type="reset" value="Limpiar"/>
</div>
-->
</form>
</div>
</body>
</html>