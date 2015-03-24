<html>	<head>		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>	</head>	<body><a href="<?php echo site_url()?>/calculo/listado/<?php echo $id_paciente;?>">Regresar al Listado</a>
<form id="ficha" method="post" enctype="multipart/form-data" style="width:100%">
	<?php 
		if($menor){
			$this->load->view('calculo_energetico/extras/calculo_infante_ficha');
		}else{?>	<fieldset>		<legend>Consumo Energético = <?php echo $consumo_energetico->consumo_energetico;?> Calorías</legend>		<table class="listado">		<thead>			<tr>				<th>Harris-Benedict</th>				<th>Shanblogue</th>				<th>Mifflin</th>				<th>Calorimetría Indirecta</th>			</tr>		</thead>		<tbody>			<tr>				<td><?php echo $harris['total'];?> Kcal.</td>				<td><?php echo $shanblogue['total'];?> Kcal.</td>				<td><?php echo $mifflin['total'];?> Kcal.</td>				<td><?php echo $consumo_energetico->calorimetro;?> Kcal.</td>			</tr>		</tbody>		</table>	</fieldset>	<?php $this->load->view('calculo_energetico/extras/calculo_adulto_ficha');}?>
</form>
</body>
</html>