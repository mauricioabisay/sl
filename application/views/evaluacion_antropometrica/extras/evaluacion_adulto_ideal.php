<fieldset>
	<legend>IMC Ideal = <?php echo $ideal_imc;?></legend>
	<!--<table id="imc" class="listado_oculto">
	<input type="button" value="+" onclick='$("#imc").toggle(200);' />
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
		<td>IMC</td>
		<td>Peso/Estatura&sup2;</td>
		<td><?php echo ''.$evaluacion->peso.'/'.$evaluacion->estatura.'&sup2;';?></td>
		<td><?php $imc_val = (float)$evaluacion->peso/($evaluacion->estatura*$evaluacion->estatura);echo round($imc_val,2);?></td>
		</tbody>
	</table>-->
</fieldset>
<fieldset>
	<legend>&Iacute;ndice de Cintura y Cadera Ideal = <?php echo $ideal_indice_cintura_cadera;?></legend>
	<!--<table id="icc" class="listado_oculto">
	<input type="button" value="+" onclick='$("#icc").toggle(200);' />
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
		<td>&Iacute;ndice de Cintura y Cadera</td>
		<td>Circ. Cintura/Circ. Cadera</td>
		<td><?php echo ''.$evaluacion->c_cintura.'/'.$evaluacion->c_cadera.'';?></td>
		<td><?php echo number_format($evaluacion->c_cintura/$evaluacion->c_cadera,3);?></td>
		<!--<strong><?php echo $indice_cintura_cadera;?></strong>
		</tbody>
	</table>-->
</fieldset>
<!--<fieldset>
	<legend>Complexi&oacute;n = <?php echo $ideal_complexion;?><input type="button" value="+" onclick='$("#com").toggle(200);' /></legend>
	<!--<table id="com" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
		<td>Complexi&oacute;n</td> 
		<td>Estatura/Circ. Mu&ntilde;eca</td>
		<td><?php echo ''.$evaluacion->estatura.'/'.$evaluacion->c_muneca.'';?></td>
		<td><?php echo number_format($evaluacion->estatura/$evaluacion->c_muneca,3);?></td>
		<!--<strong><?php echo $complexion;?></strong>
		</tbody>
	</table>
</fieldset>-->
<fieldset>
	<legend>Porcentaje de Grasa Coporal Ideal = <?php echo $ideal_porcentaje_grasa;?></legend>
	<!--<table id="icc" class="listado_oculto">
	<input type="button" value="+" onclick='$("#icc").toggle(200);' />
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
		<td>&Iacute;ndice de Cintura y Cadera</td>
		<td>Circ. Cintura/Circ. Cadera</td>
		<td><?php echo ''.$evaluacion->c_cintura.'/'.$evaluacion->c_cadera.'';?></td>
		<td><?php echo number_format($evaluacion->c_cintura/$evaluacion->c_cadera,3);?></td>
		<!--<strong><?php echo $indice_cintura_cadera;?></strong>
		</tbody>
	</table>-->
</fieldset>
<fieldset>
	<legend>Peso Ideal por Complexi&oacute;n = <?php echo $ideal_complexion;?></legend>
</fieldset>