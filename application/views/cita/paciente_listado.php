<?php $this->load->view('cita/paciente_buscar');?>

<table class="listado">
	<thead>
		<tr><td class="nuevo" align="center"><a href="<?php echo site_url();?>/paciente/agregar">Nuevo Paciente</a></td></tr>
		<tr>
			<th>Nombre</th>
			<th>Ap. Paterno</th>
			<th>Ap. Materno</th>
			<th>Tipo</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $paciente) {
	?>
		<tr>
			<td><?php echo $paciente->nombre;?></td>
			<td><?php echo $paciente->ap;?></td>
			<td><?php echo $paciente->am;?></td>
			<td><?php echo $paciente->tipo;?></td>
			<td>
				<a href="<?php echo site_url()?>/cita/agendar/<?php echo $paciente->id;?>">
					<img src="<?php echo base_url();?>/assets/img/agregar.png" width="16" height="16" id="detalle">
				</a>
			</td>		
		</tr>
	<?php
		}
	?>
	</tbody>
</table>
