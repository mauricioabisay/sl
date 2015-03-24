<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado_mini">
	<thead>
		<tr><td class="nuevo" align="center" colspan="3">
			<a href="<?php echo site_url();?>/laboratorio/agregar/<?php echo $id_paciente;?>" target="contenido">Nuevo Laboratorio</a>
		</td></tr>
		<tr>
			<th>Fecha</th>
			<th>Edo.</th>
			<th>Opc.</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $laboratorio) {
	?>
		<tr>
			<!--<td>
				<a href="<?php echo site_url()?>/laboratorio/detalle/<?php echo $laboratorio->id;?>">
					<?php echo $laboratorio->fecha_solicitud;?>
				</a>
			</td>-->
			<td><a target="contenido" href="<?php echo site_url()?>/laboratorio/detalle/<?php echo $laboratorio->id;?>">
			<?php 
			if(isset($laboratorio->fecha_captura)){
				echo $laboratorio->fecha_captura;
			}else{
				if(isset($laboratorio->fecha_solicitud)){
					echo $laboratorio->fecha_solicitud;
				}else{
					echo $laboratorio->fecha_laboratorio;
				}
			}?></a></td>
			<td><a target="contenido" href="<?php echo site_url()?>/laboratorio/capturar_resultados/<?php echo $laboratorio->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/<?php echo ($laboratorio->status=='Capturado')?'signo_verde.png':'signo_amarillo.png';?>"></a></td>
			<td>
				<a target="listado_mini" href="<?php echo site_url()?>/laboratorio/borrar/<?php echo $laboratorio->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/borrar.png"></a>
				<a target="contenido" href="<?php echo site_url()?>/laboratorio/modificar/<?php echo $laboratorio->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/modificar.png"></a>
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