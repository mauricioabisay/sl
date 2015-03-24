<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado">
	<thead>
		<tr><td class="nuevo" align="center"><a href="<?php echo site_url();?>/laboratorio/agregar/<?php echo $id_paciente;?>">Nuevo Estudio de Laboratorio</a></td></tr>
		<tr>
			<th>Fecha Solicitud</th>
			<th>Estado</th>
			<th>Fecha Captura</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $laboratorio) {
	?>
		<tr>
			<td><?php echo $laboratorio->fecha_solicitud;?></td>
			<td><?php echo $laboratorio->status;?></td>
			<td><?php echo $laboratorio->fecha_captura;?></td>
			<td>
				<a href="<?php echo site_url()?>/laboratorio/detalle/<?php echo $laboratorio->id;?>">Detalle</a>
				<a href="<?php echo site_url()?>/laboratorio/modificar/<?php echo $laboratorio->id;?>">Modificar</a>
				<!--<a href="<?php echo site_url()?>/paciente/borrar/<?php echo $paciente->id;?>">Borrar</a>-->
			</td>		
		</tr>
	<?php
		}
	?>
	</tbody>
</table>
</body>
</html>
