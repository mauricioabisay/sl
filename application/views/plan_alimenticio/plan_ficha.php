<table class="listado">
	<thead>
		<tr>
			<th>Carb.</th>
			<th>Prot.</th>
			<th>Líp.</th>
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
		if(isset($resultados) && $resultados != FALSE){foreach ($resultados as $plan){?>
		<tr>
			
			<td><a href="<?php echo site_url();?>/plan_alimenticio/agregar/<?php echo $plan->id.'/'.$consumo_energetico->id;?>">
				<?php echo $plan->carbohidratos;?>%
			</a></td>
			<td><a href="<?php echo site_url();?>/plan_alimenticio/agregar/<?php echo $plan->id.'/'.$consumo_energetico->id;?>">
				<?php echo $plan->proteinas;?>%
			</a></td>
			<td><a href="<?php echo site_url();?>/plan_alimenticio/agregar/<?php echo $plan->id.'/'.$consumo_energetico->id;?>">
				<?php echo $plan->lipidos;?>%
			</a></td>
			<td>
				<?php echo $plan->azucar;?>
			</td>
			<td <?php echo ($plan->p_desayuno=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->desayuno;?></td>
			<td <?php echo ($plan->p_co1=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->co1;?></td>
			<td <?php echo ($plan->p_comida=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->comida;?></td>
			<td <?php echo ($plan->p_co2=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->co2;?></td>
			<td <?php echo ($plan->p_cena=="Si")?'style="font-weight:bold"':''?>><?php echo $plan->cena;?></td>
		</tr>
	<?php }}?>
	</tbody>
</table>