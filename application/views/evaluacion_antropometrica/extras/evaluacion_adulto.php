<fieldset style="padding:0em">
	<legend style="margin:0.5em">IMC = <?php echo $imc;?><input type="button" value="+" onclick='$("#imc").toggle(200);' /></legend>
	<table id="imc" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<td>IMC</td> 
		<td>Peso/Estatura&sup2;</td>
		<td><?php echo ''.$evaluacion->peso.'/'.$evaluacion->estatura.'&sup2;';?></td>
		<td><?php $imc_val = (float)$evaluacion->peso/($evaluacion->estatura*$evaluacion->estatura);echo round($imc_val,2);?></td>
		<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/adultos_evaluacion/imc/0','aux_imc','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=200')" style="font-size:85%" /></td>
		</tbody>
	</table>
</fieldset>
<fieldset style="padding:0em">
	<legend style="margin:0.5em">&Iacute;ndice de Cintura y Cadera = <?php echo $indice_cintura_cadera;?><input type="button" value="+" onclick='$("#icc").toggle(200);' /></legend>
	<table id="icc" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<td>&Iacute;ndice de Cintura y Cadera</td>
		<td>Circ. Cintura/Circ. Cadera</td>
		<td><?php echo ''.$evaluacion->c_cintura.'/'.$evaluacion->c_cadera.'';?></td>
		<td><?php echo ($evaluacion->c_cadera>0)?number_format($evaluacion->c_cintura/$evaluacion->c_cadera,3):0.000;?></td>
		<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/adultos_evaluacion/cintura_cadera/<?php echo ($mujer)?"Femenino":"Masculino";?>','aux_cintura_cadera','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=120')" style="font-size:85%" /></td>
		<!--<strong><?php echo $indice_cintura_cadera;?></strong>-->
		</tbody>
	</table>
</fieldset>
<fieldset style="padding:0em">
	<legend style="margin:0.5em">Complexi&oacute;n = <?php echo $complexion;?><input type="button" value="+" onclick='$("#com").toggle(200);' /></legend>
	<table id="com" class="listado_oculto">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<td>Complexi&oacute;n</td> 
		<td>Estatura/Circ. Mu&ntilde;eca</td>
		<td><?php echo ''.($evaluacion->estatura*100).'/'.$evaluacion->c_muneca.'';?></td>
		<td><?php echo ($evaluacion->c_muneca>0)?number_format(($evaluacion->estatura*100)/$evaluacion->c_muneca,3):0.000;?></td>
		<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/adultos_evaluacion/complexion/<?php echo ($mujer)?"Femenino":"Masculino";?>','aux_complexion','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=120')" style="font-size:85%" /></td>
		<!--<strong><?php echo $complexion;?></strong>-->
		</tbody>
	</table>
</fieldset>