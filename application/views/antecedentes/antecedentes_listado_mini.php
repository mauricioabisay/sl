<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado_mini">
	<thead>
		<tr><td class="nuevo" align="center"><a target="contenido" href="<?php echo site_url();?>/antecedentes/agregar/<?php echo $id_paciente;?>">Nuevos Antecedentes</a></td></tr>
		<tr>
			<th>Fecha</th>
			<th>Opc.</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $antecedentes) {
	?>
		<tr>
			<td><a target="contenido" href="<?php echo site_url()?>/antecedentes/detalle/<?php echo $antecedentes->id;?>"><?php echo $antecedentes->fecha_id;?></a></td>
			<td>
				<a target="listado_mini" href="<?php echo site_url()?>/antecedentes/borrar/<?php echo $antecedentes->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/borrar.png"></a>
				<a target="contenido" href="<?php echo site_url()?>/antecedentes/modificar/<?php echo $antecedentes->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/modificar.png"></a>
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