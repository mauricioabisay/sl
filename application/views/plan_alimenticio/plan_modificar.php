<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	</head>
	<body>

<form id="formulario" method = "post" action="<?php echo site_url();?>/plan_alimenticio/modificar_plan_nuevo/<?php echo $id_plan;?>/<?php echo $sexo;?>">
	<fieldset>
		<?php foreach($plan as $plan)?>
		<legend>Modificar Plan Alimenticio</legend>
		<div class="columnaizq">
		<div id="modificar">
		<fieldset>
			<legend>Género</legend>
			<div id= "genero">
				<span class="lineal">
					<?php echo ($sexo == 'mujeres')?'Femenino':'Masculino';?>
					
				</span>
			</div>
		</fieldset>
		<fieldset >
			<legend>Distribución</legend>
			<div id="distribucion">
				<span class="lineal">
					<label>Calorías</label>
					<input name="calorias" type="text" value="<?php echo $plan->calorias;?>" />
				</span>
				<span class="lineal">
					<label>Carbohidratos:</label><input type="text" size="2" name="carbohidratos" value="<?php echo $plan->carbohidratos;?>"/>
					<label>Proteinas</label><input type="text" size="2" name="proteinas" value="<?php echo $plan->proteinas;?>" />
					<label>Lípidos</label><input type="text" size="2" name="lipidos" value="<?php echo $plan->lipidos;?>"/>
				</span>
			</div>
		</fieldset>
		<fieldset>
			<legend>Propiedades Alimentos</legend>
			<div id="alimentos">
				<span class="lineal">
					<label>Azúcar:</label>
					<input type="radio" value="Si" name="azucar" <?php echo set_radio('azucar','Si',($plan->azucar == 'Si')?TRUE:FALSE);?>/><label>Sí</label>
					<input type="radio" value="No" name="azucar" <?php echo set_radio('azucar','No',($plan->azucar == 'No')?TRUE:FALSE);?>/><label>No</label>
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
			
			<span class="lineal">
				<input type="checkbox" value="Si" name="desayuno" <?php echo set_checkbox('desayuno','Si',($plan->desayuno == 'Si')?TRUE:FALSE);?>/>
				<label>Desayuno</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="co1" value="Si" <?php echo set_checkbox('co1','Si',($plan->co1 == 'Si')?TRUE:FALSE);?>/>
				<label>Colación Mañana</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="comida" value="Si" <?php echo set_checkbox('comida','Si',($plan->comida == 'Si')?TRUE:FALSE);?> />
				<label>Comida</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="co2" value="Si" <?php echo set_checkbox('co2','Si',($plan->co2 == 'Si')?TRUE:FALSE);?>/>
				<label>Colación Tarde</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="cena" value="Si"  <?php echo set_checkbox('cena','Si',($plan->cena == 'Si')?TRUE:FALSE);?>/>
				<label>Cena</label>
			</span>
			<span class="lineal">	
				<label>Prioridad en:</label>
			<select name="prioridad">
				<option value="desayuno" <?php echo set_select('prioridad','desayuno',($plan->p_desayuno == 'Si')?TRUE:FALSE);?>>Desayuno</option>
				<option value="co1" <?php echo set_select('prioridad','co1',($plan->p_co1 == 'Si')?TRUE:FALSE);?>>Colaci&oacute;n Ma&ntilde;ana</option>
				<option value="comida" <?php echo set_select('prioridad','comida',($plan->p_comida == 'Si')?TRUE:FALSE);?>>Comida</option>
				<option value="co2" <?php echo set_select('prioridad','co2',($plan->p_co2 == 'Si')?TRUE:FALSE);?>>Colaci&oacute;n Tarde</option>
				<option value="cena" <?php echo set_select('prioridad','cena',($plan->p_cena == 'Si')?TRUE:FALSE);?>>Cena</option>
			</select>
			</span>
			
	
			</fieldset>
		    </div>
		    <div  id="tabla" class="columnaizq">
			<fieldset>
				<?php $this->load->view('plan_alimenticio/extras/tabla_plan_alimenticio_modificar');?>
			</fieldset>
		    </div>
			<div class="lineal" align="center">		
				<input type="submit" value="Guardar" />
				<input type="button" value="Cancelar" onclick="document.location.href='<?php echo site_url();?>/plan_alimenticio/agregar_plan_nuevo'"/>
			</div>
		</fieldset>
</form>
</body>
</html>