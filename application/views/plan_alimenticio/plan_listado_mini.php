<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado_mini">
	<thead>
		<!--<tr>
			<td class="nuevo" align="center"><a href="<?php echo site_url();?>/calculo/agregar/<?php echo $id_paciente;?>" target="contenido">Nuevo Cálculo Energético</a></td>
		</tr>-->
		<tr>
			<th>Fecha</th>
			<th>Opc.</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $plan) {
	?>
		<tr>
			<td>
				<a target="contenido" href="<?php echo site_url()?>/plan_alimenticio/detalle/<?php echo $plan->id;?>">
					<?php echo $plan->fecha;?>
				</a>
			</td>
			<td>
				<a target="listado_mini" href="<?php echo site_url();?>/plan_alimenticio/borrar/<?php echo $plan->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/borrar.png"></a>
				<!--<a target="contenido" href="<?php echo site_url();?>/calculo/modificar/<?php echo $plan->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/modificar.png"></a>-->
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