<fieldset>
	<legend>Requerimientos Nutricios</legend>
	<table class="listado">
		<thead>
			<tr>
				<td colspan="5" style="border-bottom: 0px">&nbsp;</td>				
				<th colspan="2">Estimado (Peso Act. x Kcal.Diarias por Kg.)</th>
			</tr>
		</thead>
		<tbody>			<tr>				<th>Edad</th>				<th>Peso</th>				<th>Energ&iacute;a Diaria</th>				<th>Kcal por D&iacute;a</th>				<th>Kcal Diarias por Kg</th>				<th>Sustituci&oacute;n</th>				<th>Resultado</th>			</tr>		<tr>
			<td><?php echo $tabla->anios;?>a&ntilde;os, <?php echo $tabla->meses;?> meses</td>
			<td><?php echo $tabla->peso;?></td>
			<td><?php echo $tabla->energia_diaria;?></td>						<td><?php echo $tabla->kcal_dia;?></td>
			<td><?php echo $tabla->kcal_kg;?></td>
			<td><?php echo $evaluacion->peso.'x'.$tabla->kcal_kg;?></td>			<td><?php echo number_format(($tabla->kcal_kg*$evaluacion->peso),2);?></td>		</tr>
		</tbody>
	</table>	<div class="lineal" style="margin-top:1em;">		<label>Consumo Energ&eacute;tico Sugerido:</label>		<input type="text" name="consumo_energetico" value="<?php echo set_value('consumo_energetico');?>" />		<?php echo form_error('consumo_energetico');?>	</div>
</fieldset>