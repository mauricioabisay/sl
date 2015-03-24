<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado_mini">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Opc.</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados_mini) && $resultados_mini != FALSE)
		foreach ($resultados_mini as $medicamento_mini) {
	?>
		<tr>
			<td><a target="contenido" href="<?php echo site_url();?>/medicamento/listado_fecha/<?php echo ''.$medicamento_mini->paciente.'/'.$medicamento_mini->fecha_id.'';?>"><?php echo $medicamento_mini->fecha_id;?></a></td>
			<td>
				<a target="contenido" href="<?php echo site_url();?>/medicamento/modificar_datos/<?php echo ''.$medicamento_mini->paciente;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/modificar.png"></a>
				<a target="_parent" href="<?php echo site_url();?>/medicamento/borrar/<?php echo ''.$medicamento_mini->fecha_id.'/'.$medicamento_mini->paciente.'';?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/borrar.png"></a>
				<!--<a href="<?php echo site_url()?>/evdietetica/modificar/<?php echo $evaluacion->id;?>">Modificar</a>-->
				<!--<a href="<?php echo site_url()?>/paciente/borrar/<?php echo $paciente->id;?>">Borrar</a>-->
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