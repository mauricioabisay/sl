<fieldset>
	<legend>Consumo Energ&eacute;tico por Calorimetr&iacute;a Indirecta</legend>
	<div class="lineal">
		<label>Consumo Energético:</label>
		<input type="text" name="calorimetro" onchange="$('#calorimetro').text($(this).val())" size="6" maxlength="7" value="<?php echo set_value('calorimetro');?>" />
		<?php echo form_error('calorimetro');?>
	</div>
</fieldset>
<fieldset>
	<legend>Consumo Energ&eacute;tico Sugerido</legend>
	<table class="listado">
		<thead>
			<tr>
				<th>Harris-Benedict</th>
				<th>Shanblogue</th>
				<th>Mifflin</th>
				<th>Calorimetría Indirecta</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><b id="harris_resumen_total">0</b></td>
				<td><b id="shanblogue_resumen_total">0</b></td>
				<td><b><?php echo $mifflin_gasto_energetico_basal;?></b></td>
				<td><b id="calorimetro">0</b></td>
			</tr>
		</tbody>
	</table>
	<div class="lineal" style="margin-top:1em;">
		<label>Consumo Energ&eacute;tico Sugerido:</label>
		<input type="text" name="consumo_energetico" value="<?php echo set_value('consumo_energetico');?>" />
		<?php echo form_error('consumo_energetico');?>
	</div>
</fieldset>