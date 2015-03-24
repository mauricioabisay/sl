<fieldset>
	<legend>Frecuencia de consumo de alimentos</legend>
	<label>Narre cu&aacute;ntos d&iacute;as a la semana consume los siguientes alimentos</label>
	<table>
		<tr align="right">
			<td>Verduras</td>
			<td align="left"><input type="text" size="3" name="verduras" value="<?php echo set_value('verduras')?>" /></td><td>/7<?php echo form_error('verduras');?></td>
			<td>Grasas sp (aceite vegetal)</td>
			<td align="left"><input type="text" size="3" name="grasa_sp" value="<?php echo set_value('grasa_sp')?>" /></td><td>/7<?php echo form_error('frutas');?></td>
		</tr>
		<tr align="right">
			<td>Frutas</td>
			<td align="left"><input type="text" size="3" name="frutas" value="<?php echo set_value('frutas')?>" /></td><td>/7<?php echo form_error('car_sg');?></td>
			<td>Grasas cp (almendra, nuez,etc.)</td>
			<td align="left"><input type="text" size="3" name="grasa_cp" value="<?php echo set_value('grasa_cp')?>" /></td><td>/7<?php echo form_error('car_cg');?></td>
		</tr>
		<tr align="right">
			<td>CyTsg (pan,tortilla,papa,pasta)</td>
			<td align="left"><input type="text" size="3" name="car_sg" value="<?php echo set_value('car_sg')?>" /></td><td>/7<?php echo form_error('grasa_sp');?></td>
			<td>Leche</td>
			<td align="left"><input type="text" size="3" name="leche" value="<?php echo set_value('leche')?>" /></td><td>/7<?php echo form_error('grasa_cp');?></td>
		</tr>
		<tr align="right">
			<td>CyTcg (pan dulce, galletas)</td>
			<td align="left"><input type="text" size="3" name="car_cg" value="<?php echo set_value('car_cg')?>" /></td><td>/7<?php echo form_error('leche');?></td>
			<td>Az&uacute;car</td>
			<td align="left"><input type="text" size="3" name="azucar" value="<?php echo set_value('azucar')?>" /></td><td>/7<?php echo form_error('azucar');?></td>
		</tr>
		<tr align="right">
			<td>Leguminosas (frijol, haba, lentejas)</td>
			<td align="left"><input type="text" size="3" name="leguminosas" value="<?php echo set_value('leguminosas')?>" /></td><td>/7<?php echo form_error('leguminosas');?></td>
			<td>Productos de origen animal (pollo,carne,queso)</td>
			<td align="left"><input type="text" size="3" name="origen_animal" value="<?php echo set_value('origen_animal')?>" /></td><td>/7<?php echo form_error('origen_animal');?></td>
		</tr>
	</table>
</fieldset>