<fieldset>
	<legend>IMC = <?php echo $imc;?><input type="button" value="+" onclick='$("#imc").toggle(200);' /></legend>
	<table id="imc" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>IMC</td>
				<td>Peso/Estatura&sup2;</td>
				<td><?php echo ''.$evaluacion->peso.'/'.$evaluacion->estatura.'&sup2;';?></td>
				<td><?php echo number_format(round($evaluacion->peso/($evaluacion->estatura*$evaluacion->estatura)),3);?></td>
			</tr>
		</tbody>
	</table>
</fieldset>
<fieldset>
	<legend>Ganancia de Peso por IMC = <?php echo $eval_embarazo['imc'];?> = <?php echo $eval_embarazo['peso_ganancia'];?> kgs.<input type="button" value="+" onclick='$("#ganancia_imc").toggle(200);' /></legend>
	<table id="ganancia_imc" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>IMC</td>
				<td>Peso Pregestacional/Estatura&sup2;</td>
				<td><?php echo ''.$embarazo->peso_pre_gesta.'/'.$evaluacion->estatura.'&sup2;';?></td>
				<td><?php echo number_format(round($eval_embarazo['valor_imc'],3));?></td>
			</tr>
		</tbody>
	</table>
</fieldset>
<fieldset>
	<legend>Peso esperado de acuerdo a edad gestacional = <?php echo $eval_embarazo['peso_esperado'];?> kgs.<input type="button" value="+" onclick='$("#ganancia_edad_gestacional").toggle(200);' /></legend>
	<table id="ganancia_edad_gestacional" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Peso Esperado</td>
				<td>Peso Pregestacional + Edad Gestacional</td> 
				<td><?php echo ''.$embarazo->peso_pre_gesta.'kg + '.round($embarazo->semana_gesta,0).' semanas';?></td>
				<td><?php echo number_format(round($eval_embarazo['peso_esperado'],3));?></td>
		</tbody>
	</table>
</fieldset>
<fieldset>
	<legend>Peso esperado de acuerdo a edad gestacional (ALFEHLD) = <?php echo $eval_embarazo['peso_esperado_alfehld'];?> kgs.<input type="button" value="+" onclick='$("#ganancia_edad_gestacional_alfehld").toggle(200);' /></legend>
	<table id="ganancia_edad_gestacional_alfehld" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Peso Esperado</td>
				<td>Peso Pregestacional + Edad Gestacional</td> 
				<td><?php echo ''.$embarazo->peso_pre_gesta.'kg + '.round(($embarazo->fondo_uterino+4),0).' semanas';?></td>
				<td><?php echo number_format(round($eval_embarazo['peso_esperado_alfehld'],3));?></td>
		</tbody>
	</table>
</fieldset>
<fieldset>
	<legend>Peso esperado de acuerdo a edad gestacional (McDonald) = <?php echo $eval_embarazo['peso_esperado_mcdonald'];?> kgs.<input type="button" value="+" onclick='$("#ganancia_edad_gestacional_mcdonald").toggle(200);' /></legend>
	<table id="ganancia_edad_gestacional_mcdonald" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Peso Esperado</td>
				<td>Peso Pregestacional + Edad Gestacional</td> 
				<td><?php echo ''.$embarazo->peso_pre_gesta.'kg + '.round(($embarazo->fondo_uterino),0).' semanas';?></td>
				<td><?php echo ($eval_embarazo['peso_esperado_mcdonald']!='N/A')?number_format(round($eval_embarazo['peso_esperado_mcdonald'],3)):'N/A';?></td>
		</tbody>
	</table>
</fieldset>