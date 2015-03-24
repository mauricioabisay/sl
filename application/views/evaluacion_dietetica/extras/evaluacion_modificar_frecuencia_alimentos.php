<fieldset>
	<legend>Frecuencia de consumo de alimentos</legend>
	<label>Narre cu&aacute;ntos d&iacute;as a la semana consume los siguientes alimentos</label>
	<table>
		<tr align="right">
			<td>Verduras</td>
			<td align="left"><input type="text" size="3" name="verduras" value="<?php echo set_value('verduras',(isset($frecuencia))?$frecuencia->verduras:'');?>" /></td><td>/7</td>
			<td>Grasas sp (aceite vegetal)</td>
			<td align="left"><input type="text" size="3" name="grasa_sp" value="<?php echo set_value('grasa_sp',(isset($frecuencia))?$frecuencia->grasa_sp:'');?>" /></td><td>/7</td>
		</tr>
		<tr align="right">
			<td>Frutas</td>
			<td align="left"><input type="text" size="3" name="frutas" value="<?php echo set_value('frutas',(isset($frecuencia))?$frecuencia->frutas:'');?>" /></td><td>/7</td>
			<td>Grasas cp (almendra, nuez,etc.)</td>
			<td align="left"><input type="text" size="3" name="grasa_cp" value="<?php echo set_value('grasa_cp',(isset($frecuencia))?$frecuencia->grasa_cp:'');?>" /></td><td>/7</td>
		</tr>
		<tr align="right">
			<td>CyTsg (pan,tortilla,papa,pasta)</td>
			<td align="left"><input type="text" size="3" name="car_sg" value="<?php echo set_value('car_sg',(isset($frecuencia))?$frecuencia->car_sg:'');?>" /></td><td>/7</td>
			<td>Leche</td>
			<td align="left"><input type="text" size="3" name="leche" value="<?php echo set_value('leche',(isset($frecuencia))?$frecuencia->leche:'');?>" /></td><td>/7</td>
		</tr>
		<tr align="right">
			<td>CyTcg (pan dulce, galletas)</td>
			<td align="left"><input type="text" size="3" name="car_cg" value="<?php echo set_value('car_cg',(isset($frecuencia))?$frecuencia->car_cg:'');?>" /></td><td>/7</td>
			<td>Az&uacute;car</td>
			<td align="left"><input type="text" size="3" name="azucar" value="<?php echo set_value('azucar',(isset($frecuencia))?$frecuencia->azucar:'');?>" /></td><td>/7</td>
		</tr>
		<tr align="right">
			<td>Leguminosas (frijol, haba, lentejas)</td>
			<td align="left"><input type="text" size="3" name="leguminosas" value="<?php echo set_value('leguminosas',(isset($frecuencia))?$frecuencia->leguminosas:'');?>" /></td><td>/7</td>
			<td>Productos de origen animal (pollo,carne,queso)</td>
			<td align="left"><input type="text" size="3" name="origen_animal" value="<?php echo set_value('origen_animal',(isset($frecuencia))?$frecuencia->origen_animal:'');?>" /></td><td>/7</td>
		</tr>
	</table>
</fieldset>	
<?php echo form_error('verduras');?>
<?php echo form_error('frutas');?>
<?php echo form_error('car_sg');?>
<?php echo form_error('car_cg');?>
<?php echo form_error('grasa_sp');?>
<?php echo form_error('grasa_cp');?>
<?php echo form_error('leche');?>
<?php echo form_error('azucar');?>
<?php echo form_error('leguminosas');?>
<?php echo form_error('origen_animal');?>