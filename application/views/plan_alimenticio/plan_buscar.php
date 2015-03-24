<form class="busqueda" method="post" action="<?php echo site_url();?>/plan_alimenticio/busqueda/<?php echo $id_paciente;?>">
	<fieldset>
		<legend>Buscar Plan Alimenticio <input type="button" value="+" onclick="$('#buscar').toggle(200)" /></legend>
		<div id="buscar">
		<fieldset>
			<legend>Distribución</legend>
			<div id="distribucion">
				<span class="lineal">
					<label>Calorías</label>
					<input name="calorias" type="text" value="<?php echo set_value('calorias',$consumo_energetico->consumo_energetico);?>" />
				</span>
				<span class="lineal">
					<label>Carbohidratos:</label><input type="text" size="2" name="carbohidratos" />
					<label>Proteinas</label><input type="text" size="2" name="proteinas" />
					<label>Lípidos</label><input type="text" size="2" name="lipidos" />
				</span>
			</div>
		</fieldset>
		<fieldset>
			<legend>Propiedades Alimentos</legend>
			<div id="alimentos">
				<span class="lineal">
					<label>Azúcar:</label>
					<input type="radio" value="Si" name="azucar" /><label>Sí</label>
					<input type="radio" value="No" name="azucar" /><label>No</label>
				</span>
			</div>
		</fieldset>
		<fieldset>
			<legend>Tiempos</legend>
			<span class="lineal">
				<input type="checkbox" value="Si" name="desayuno" checked="checked" />
				<label>Desayuno</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="co1" value="Si" checked="checked" />
				<label>Colación Mañana</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="comida" value="Si" checked="checked" />
				<label>Comida</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="co2" value="Si" checked="checked" />
				<label>Colación Tarde</label>
			</span>
			<span class="lineal">
				<input type="checkbox" name="cena" value="Si" checked="checked" />
				<label>Cena</label>
			</span>
			<span class="lineal">	
				<label>Prioridad en:</label>
			<select name="prioridad">
				<option value="desayuno">Desayuno</option>
				<option value="co1">Colaci&oacute;n Ma&ntilde;ana</option>
				<option value="comida">Comida</option>
				<option value="co2">Colaci&oacute;n Tarde</option>
				<option value="cena">Cena</option>
			</select>
			</span>
		</fieldset>
		<div align="center">		
			<input type="submit" value="Buscar" />
			<input type="reset" value="Restaurar" />
		</div>
	</fieldset>
	</div>
</form>