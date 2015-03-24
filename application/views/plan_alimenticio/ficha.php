<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
	<form id="ficha" method="post" enctype="multipart/form-data" style="width:100%">
		<?php 
		if($menor){
			$this->load->view('plan_alimenticio/extras/calculo_infante_ficha');
		}else{?>
	<fieldset>
		<legend>Consumo Energético = <?php echo $consumo_energetico->consumo_energetico;?> Calorías</legend>
		<table class="listado">
		<thead>
			<tr>
				<th>Plan Alimenticio</th>
				<th>I.M.C.</th>
				<th>Harris-Benedict</th>
				<th>Shanblogue</th>
				<th>Mifflin</th>
				<th>Calorimetría Indirecta</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<?php if(isset($plan) && $plan != FALSE){
						echo round($plan->carbohidratos,0);
						echo round($plan->proteinas,0);
						echo round($plan->lipidos,0);
						echo ' '.$plan->numero_comidas.' '.$plan->prioridad;
					}?>
				</td>
				<td><?php $imc_val = (float)$evaluacion->peso/($evaluacion->estatura*$evaluacion->estatura);echo round($imc_val,2);?></td>
				<td><?php echo $harris['total'];?> Kcal.</td>
				<td><?php echo $shanblogue['total'];?> Kcal.</td>
				<td><?php echo $mifflin['total'];?> Kcal.</td>
				<td><?php echo $consumo_energetico->calorimetro;?> Kcal.</td>
			</tr>
		</tbody>
		</table>
		<?php if(isset($patologias)&&$patologias){?>
		<table class="listado">
		<thead>
			<tr>
				<th>Patolog&iacute;a</th>
				<th>Recomendaciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($patologias as $patologia){?>
			<tr>
				<td><?php echo $patologia->nombre;?></td>
				<td align="justify">
					<ul style="margin-left:1em">
					<?php echo str_replace("-","</li><li>",$patologia->recomendacion);?>
					</li>
					</ul>
				</td>
			</tr>
			<?php }?>
		</tbody>
		</table>
		<?php }?>
	</fieldset>
	<?php }?>
	</form>
<table class="listado">
	<thead>
		<tr>
			<th colspan="2">Carbohidratos</th>
			<th colspan="2">Proteinas</th>
			<th colspan="2">Lípidos</th>
			<th colspan="6">Detalles</th>
		</tr>
		<tr>
			<th>%</th>
			<th>Gramos</th>
			<th>%</th>
			<th>Gramos</th>
			<th>%</th>
			<th>Gramos</th>
			<th>Azucar</th>
			<th>Desayuno</th>
			<th>Col.Mañana</th>
			<th>Comida</th>
			<th>Col.Tarde</th>
			<th>Cena</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($plan) && $plan != FALSE){?>
		<tr>
			<td><?php echo $plan->carbohidratos;?>%</td>
			<td><?php echo round((($consumo_energetico->consumo_energetico*($plan->carbohidratos/100))/4),1);?></td>
			<td><?php echo $plan->proteinas;?>%</td>
			<td><?php echo round((($consumo_energetico->consumo_energetico*($plan->proteinas/100))/4),1);?></td>
			<td><?php echo $plan->lipidos;?>%</td>
			<td><?php echo round((($consumo_energetico->consumo_energetico*($plan->lipidos/100))/9),1);?></td>
			<td><?php echo $plan->azucar;?></td>
			<td <?php echo ($plan->p_desayuno=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->desayuno;?></td>
			<td <?php echo ($plan->p_co1=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->co1;?></td>
			<td <?php echo ($plan->p_comida=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->comida;?></td>
			<td <?php echo ($plan->p_co2=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->co2;?></td>
			<td <?php echo ($plan->p_cena=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->cena;?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<table class="listado">
	<thead>
		<tr>
			<th>Alimento</th>
			<th>Recomendación</th>
			<th>Total</th>
			<th>Desayuno</th>
			<th>Col.Mañana</th>
			<th>Comida</th>
			<th>Col.Tarde</th>
			<th>Cena</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE){foreach ($resultados as $alimento){
			if($alimento->total_tiempos>0){
	?>
		<tr>
			<td>
				<?php echo $alimento->nombre;?>
			</td>
			<td>
				<?php echo $alimento->recomendacion;?>
			</td>
			<td><?php echo $alimento->total_tiempos;?></td>
			<td <?php echo ($plan->p_desayuno=="Si")?'style="font-weight:bold"':''?>><?php echo $alimento->desayuno;?></td>
			<td <?php echo ($plan->p_co1=="Si")?'style="font-weight:bold"':''?>><?php echo $alimento->co1;?></td>
			<td <?php echo ($plan->p_comida=="Si")?'style="font-weight:bold"':''?>><?php echo $alimento->comida;?></td>
			<td <?php echo ($plan->p_co2=="Si")?'style="font-weight:bold"':''?>><?php echo $alimento->co2;?></td>
			<td <?php echo ($plan->p_cena=="Si")?'style="font-weight:bold"':''?>><?php echo $alimento->cena;?></td>
		</tr>
	<?php }}}?>
	</tbody>
</table>
	</body>
</html>