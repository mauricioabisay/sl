<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado_mini">
	<thead>
		<tr><td class="nuevo" align="center"><a href="<?php echo site_url();?>/evdietetica/agregar/<?php echo $id_paciente;?>" target="contenido">Nueva Evaluaci&oacute;n</a></td></tr>
		<tr>
			<th>Fecha</th>
			<th>Opc.</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $evaluacion) {
	?>
		<tr>
			<td><a target="contenido" href="<?php echo site_url()?>/evdietetica/detalle/<?php echo $evaluacion->id;?>"><?php echo $evaluacion->fecha_id;?></a></td>
			<td>
				<a target="contenido" href="<?php echo site_url()?>/evdietetica/modificar/<?php echo $evaluacion->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/modificar.png"></a>
				<a target="listado_mini" href="<?php echo site_url()?>/evdietetica/borrar/<?php echo $evaluacion->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/borrar.png"></a>
			</td>		
		</tr>
	<?php
		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" align="center">
				<?php echo $this->pagination->create_links();?>
			</td>
		</tr>
	</tfoot>
</table>
</body>
</html>