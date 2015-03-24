<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	</head>
	<body>

<form id="formulario" method = "post" action="<?php echo site_url();?>/plan_alimenticio/agregar_plan_nuevo";?>
	<fieldset>
		<legend>Agregar Plan Alimenticio</legend>
		<div class="columnaizq">
		<div id="agregar">
		<fieldset>
			<legend>Género</legend>
			<div id= "genero">
				<span class="lineal">
					<input type="radio" value="mujeres" name="genero" <?php echo set_radio('genero','mujeres');?>/><label>Mujeres</label>
					<input type="radio" value="hombres" name="genero" <?php echo set_radio('genero','hombres');?>/><label>Hombres</label>
				</span>
			</div>
		</fieldset>
		<fieldset >
			<legend>Distribución</legend>
			<div id="distribucion">
				<span class="lineal">
					<label>Calorías</label>
					<input name="calorias" type="text" value="<?php echo set_value('calorias');?>" />
				</span>
				<span class="lineal">
					<label>Carbohidratos:</label><input type="text" size="2" name="carbohidratos" value="<?php echo set_value('carbohidratos');?>"/>
					<label>Proteinas</label><input type="text" size="2" name="proteinas" value="<?php echo set_value('proteinas');?>" />
					<label>Lípidos</label><input type="text" size="2" name="lipidos" value="<?php echo set_value('lipidos');?>"/>
				</span>
			</div>
		</fieldset>
		<fieldset>
			<legend>Propiedades Alimentos</legend>
			<div id="alimentos">
				<span class="lineal">
					<label>Azúcar:</label>
					<input type="radio" value="Si" name="azucar" <?php echo set_radio('azucar','Si');?>/><label>Sí</label>
					<input type="radio" value="No" name="azucar" <?php echo set_radio('azucar','No');?>/><label>No</label>
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
				<input type="checkbox" value="Si" name="desayuno" <?php echo set_checkbox('desayuno','Si');?>/>
				<label>Desayuno</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="co1" value="Si" <?php echo set_checkbox('co1','Si');?>/>
				<label>Colación Mañana</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="comida" value="Si" <?php echo set_checkbox('comida','Si');?> />
				<label>Comida</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="co2" value="Si" <?php echo set_checkbox('co2','Si');?>/>
				<label>Colación Tarde</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="cena" value="Si"  <?php echo set_checkbox('cena','Si');?>/>
				<label>Cena</label>
			</span>
			<span class="lineal">	
				<label>Prioridad en:</label>
			<select name="prioridad">
				<option value="desayuno" <?php echo set_select('prioridad','desayuno');?>>Desayuno</option>
				<option value="co1" <?php echo set_select('prioridad','co1');?>>Colaci&oacute;n Ma&ntilde;ana</option>
				<option value="comida" <?php echo set_select('prioridad','comida');?>>Comida</option>
				<option value="co2" <?php echo set_select('prioridad','co2');?>>Colaci&oacute;n Tarde</option>
				<option value="cena" <?php echo set_select('prioridad','cena');?>>Cena</option>
			</select>
			</span>
			
	
			</fieldset>
		    </div>
		    <div  id="tabla" class="columnaizq">
			<fieldset>
				<?php $this->load->view('plan_alimenticio/extras/tabla_plan_alimenticio');?>
			</fieldset>
		    </div>
			<div class="lineal" align="center">		
				<input type="submit" value="Agregar" />
				<input type="reset" value="Restaurar" />
			</div>
		</fieldset>
</form>
</body>
</html>