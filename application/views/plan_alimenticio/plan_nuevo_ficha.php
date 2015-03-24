<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
		
		<script language="JavaScript" type="text/javascript">

		//Se llama a la función consultar del controlador

		function modificar(){

			$("#form").load('modificar_plan');

		}

	</script>
	</head>
	<body>

<form id="formulario" method = "post" action="<?php echo site_url();?>/plan_alimenticio/ficha_plan_nuevo/<?php echo $id_plan;?>/<?php echo $sexo;?>" />
    <?php foreach($plan as $plan)?>
	<fieldset>
		<legend>Nuevo Plan Alimenticio</legend>
		<div class="columnaizq">
		<div id="agregar">
		<fieldset>
			<legend>Género</legend>
			<div id= "genero">
				<span class="lineal">
					<label><?php echo ($sexo == 'mujeres')?'Femenino':'Masculino';?></label>
				</span>
			</div>
		</fieldset>
		<fieldset >
			<legend>Distribución</legend>
			<div id="distribucion">
				<span class="lineal">
					<label>Calorías: </label>
					<strong><?php echo $plan->calorias;?></strong>
				</span>
				<span class="lineal">
					<label>Carbohidratos:</label><strong><?php echo $plan->carbohidratos;?></strong>
					<label>Proteinas</label><strong><?php echo $plan->proteinas;?></strong>
					<label>Lípidos</label><strong><?php echo $plan->lipidos;?></strong>
				</span>
			</div>
		</fieldset>
		<fieldset>
			<legend>Propiedades Alimentos</legend>
			<div id="alimentos">
				<span class="lineal">
					<label>Azúcar:</label>
					<strong><?php echo $plan->azucar;?></strong>
				</span>
			</div>
		</fieldset>
		<fieldset >
			<legend>Tiempos</legend>
			<!--<select name = "tiempos">
				<option value="3">3</option>
				<option value="5">5</option>
				<option value="3CoM">3CoM</option>
				<option value="3CoT">3CoT</option>
			</select>-->
			<?php if($plan->desayuno == 'Si'){?>
			<span class="lineal">
				<label>Desayuno</label>
			</span>
			<?php }if($plan->co1 == 'Si'){?>
			<span class="lineal">
				<label>Colación Mañana</label>
			</span>
			<?php }if($plan->comida == 'Si'){?>
			<span class="lineal">
				<label>Comida</label>
			</span>
			<?php }if($plan->co2 == 'Si'){?>
			<span class="lineal">
				<label>Colación Tarde</label>
			</span>
			<?php }if($plan->cena == 'Si'){?>
			<span class="lineal">
				<label>Cena</label>
			</span>
			<?php }?>
			<span class="lineal">	
				<label>Prioridad en:</label>
			    <?php if($plan->p_desayuno== 'Si'){?>
			    <strong>Desayuno</strong>
			    <?php }if($plan->p_co1== 'Si'){?>
			    <strong>Colación Mañana</strong>
			    <?php }if($plan->p_comida== 'Si'){?>
			    <strong>Comida</strong>
			    <?php }if($plan->p_co2== 'Si'){?>
			    <strong>Colación Tarde</strong>
			    <?php }if($plan->p_cena== 'Si'){?>
			    <strong>Cena</strong>
			    <?php } ?>
			</span>
			
	
			</fieldset>
		    </div>
		    <div  id="tabla" class="columnaizq">
			<fieldset>
				<legend>Men&uacute;</legend>
				<table class="tabla_formulario">
					<tr>
						<th>Tipo de Alimento</th><th>Grupo</th><th>Total</th>
						<th>Des</th><th>CoM</th><th>Com</th><th>CoT</th><th>Cen</th>
					</tr>
					<?php foreach ($resultados  as $plan){?>
					<tr>
					<td><?php echo $plan->nombre;?></td>	
					<td><?php 
							switch($plan->recomendacion){
								case 'General': echo 'a';break;
								case 'Recomendado': echo 'b';break;
								case 'Prohibido': echo 'c';break;
								case 'Enfermedad': echo 'd';break;
							}
						?>
					</td>
					<td><?php echo $plan->total_tiempos;?></td>
					<td><?php echo $plan->desayuno;?></td>
					<td><?php echo $plan->co1;?></td>
					<td><?php echo $plan->comida;?></td>
					<td><?php echo $plan->co2?></td>
					<td><?php echo $plan->cena;?></td>
					</tr>
					<?php }?>
				</table>
			</fieldset>
		    </div>
			<div class="lineal" align="center">		
			<input type="button" value="Modificar" onclick="document.location.href='<?php echo site_url();?>/plan_alimenticio/modificar_plan_nuevo/<?php echo $id_plan;?>/<?php echo $sexo;?>'"/>
			<input type="button" value="Eliminar"  onclick="document.location.href='<?php echo site_url();?>/plan_alimenticio/eliminar/<?php echo $id_plan;?>/<?php echo $sexo;?>'"/>
		</div>
		</fieldset>
		
			
</form>
</body>
</html>