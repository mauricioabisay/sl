<html>	<head>		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />	</head>	<body><table class="listado">	<thead>		<tr><td class="nuevo" align="center"><a href="<?php echo site_url();?>/evdietetica/agregar/<?php echo $id_paciente;?>">Nueva Evaluaci&oacute;n</a></td></tr>		<tr>			<th>Fecha</th>			<th>Evolucion</th>			<th>Motivaci&oacute;n</th>			<th>Capacidad</th>			<th>Desgaste</th>			<th>Opciones</th>		</tr>	</thead>	<tbody>	<?php		if(isset($resultados) && $resultados != FALSE)		foreach ($resultados as $evaluacion) {?>		<tr>			<td><?php echo $evaluacion->fecha_id;?></td>			<td><?php echo $evaluacion->evolucion;?></td>			<td><?php echo $evaluacion->motivacion;?></td>			<td><?php echo $evaluacion->capacidad;?></td>			<td><?php echo $evaluacion->desgaste;?></td>			<td>				<a href="<?php echo site_url()?>/evdietetica/detalle/<?php echo $evaluacion->id;?>">Detalle</a>				<!--<a href="<?php echo site_url()?>/evdietetica/modificar/<?php echo $evaluacion->id;?>">Modificar</a>-->				<!--<a href="<?php echo site_url()?>/paciente/borrar/<?php echo $paciente->id;?>">Borrar</a>-->			</td>				</tr>	<?php }?>	</tbody></table></body></html>