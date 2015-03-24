<fieldset style="padding:0em">
	<legend style="margin:0.5em">Criterios Waterlow<input type="button" value="+" onclick='$("#cw").toggle(200);' /></legend>
	<div class="lineal_oculto" id="cw">
		<table class="listado_oculto" style="display:block">
			<thead>
				<tr>
					<th>F&oacute;rmula</th>
					<th>Sustituci&oacute;n</th>
					<th>Resultado</th>
					<th>Evaluaci&oacute;n</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Peso/Edad</td>
					<td><?php echo $waterlow['sustitucion_peso_edad'];/*''.$evaluacion->peso.'/'.number_format($edad,2).'';*/?></td>
					<td><?php echo number_format($waterlow['valor_peso_edad'],3);?></td>
					<td><?php echo $waterlow['peso_edad'];?></td>
					<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_waterlow_peso_edad','aux','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=255')" style="font-size:85%" /></td>
				</tr>
				<tr>
					<td>Estatura/Edad</td>
					<td><?php echo $waterlow['sustitucion_estatura_edad'];/*''.$evaluacion->estatura.'/'.number_format($edad,2).'';*/?></td>
					<td><?php echo number_format($waterlow['valor_estatura_edad'],3);?></td>
					<td><?php echo $waterlow['estatura_edad'];?></td>
					<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_waterlow_est_edad','aux','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=255')" style="font-size:85%" /></td>
				</tr>
				<tr>
					<td>Peso/Estatura</td>
					<td><?php echo $waterlow['sustitucion_peso_estatura'];/*''.$evaluacion->peso.'/'.$evaluacion->estatura.'';*/?></td>
					<td><?php echo number_format($waterlow['valor_peso_estatura'],3);?></td>
					<td><?php echo $waterlow['peso_estatura'];?></td>
					<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_waterlow_peso_est','aux','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=255')" style="font-size:85%" /></td>
				</tr>
			</tbody>
		</table>
	</div>
</fieldset>
<fieldset style="padding:0em">
	<legend style="margin:0.5em">Criterios Puntaci&oacute;n Z<input type="button" value="+" onclick='$("#cw").toggle(200);' /></legend>
	<div class="lineal_oculto" id="cw">
		<table class="listado_oculto" style="display:block">
			<thead>
				<tr>
					<th>F&oacute;rmula</th>
					<th>Sustituci&oacute;n</th>
					<th>Resultado</th>
					<th>Evaluaci&oacute;n</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Peso/Edad</td>
					<td><?php echo $z['sustitucion_peso_edad'];?></td>
					<td><?php echo number_format($z['valor_peso_edad'],3);?></td>
					<td><?php echo $z['peso_edad'];?></td>
					<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_puntuacion_z_peso_edad','aux_z','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=200')" style="font-size:85%" /></td>					
				</tr>
				<tr>
					<td>Estatura/Edad</td>
					<td><?php echo $z['sustitucion_estatura_edad'];?></td>
					<td><?php echo number_format($z['valor_estatura_edad'],3);?></td>
					<td><?php echo $z['estatura_edad'];?></td>
					<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_puntuacion_z_est_edad','aux_z','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=200')" style="font-size:85%" /></td>
				</tr>
				<tr>
					<td>Peso/Estatura</td>
					<td><?php echo $z['sustitucion_peso_estatura'];?></td>
					<td><?php echo number_format($z['valor_peso_estatura'],3);?></td>
					<td><?php echo $z['peso_estatura'];?></td>
					<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_puntuacion_z_peso_est','aux_z','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=200')" style="font-size:85%" /></td>
				</tr>
			</tbody>
		</table>
	</div>
</fieldset>
<fieldset style="padding:0em">
	<legend style="margin:0.5em">IMC<input type="button" value="+" onclick='$("#imc").toggle(200);' /></legend>
	<table class="listado_oculto" id="imc">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Resultado</th>
				<th>Evaluaci&oacute;n</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<td>IMC</td>
			<td>Peso/Estatura&sup2;</td>
			<td><?php echo ''.$evaluacion->peso.'/'.$evaluacion->estatura.'&sup2;';?></td>
			<td><?php echo number_format($evaluacion->peso/($evaluacion->estatura*$evaluacion->estatura),3);?></td>
			<td><?php echo $imc;?></td>
			<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_evaluacion/imc','aux_imc','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=150')" style="font-size:85%" /></td>
		</tbody>
	</table>
</fieldset>
<?php if(($evaluacion->c_brazo>0)||($evaluacion->perim_cefalico>0)){?>
<fieldset style="padding:0em">
	<legend style="margin:0.5em">Circunferencias<input type="button" value="+" onclick='$("#circ").toggle(200);' /></legend>
	<table class="listado_oculto" id="circ">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Evaluaci&oacute;n</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php if($evaluacion->perim_cefalico>0){?>
			<tr>
				<td>&Iacute;ndice Circ. Cef&aacute;lica/Edad</td>
				<td>Circ. Cef&aacute;lica/Edad</td>
				<td><?php echo ''.$evaluacion->perim_cefalico.'/'.number_format($edad,2).'';?></td>
				<td><?php echo $circ_cefalica;?></td>
				<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_evaluacion/cabeza_edad','aux_perim','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=130')" style="font-size:85%" /></td>
			</tr>
			<?php }?>
			<?php if($evaluacion->c_brazo>0){?>
			<tr>
				<td>&Iacute;ndice Circ. Brazo/Edad</td>
				<td>Circ. Brazo/Edad</td>
				<td><?php echo ''.$evaluacion->c_brazo.'/'.number_format($edad,2).'';?></td>
				<td><?php echo $circ_brazo;?></td>
				<td><input value="Tabla" type="button" onclick="open('<?php echo site_url();?>/tablas_evaluacion_antropometrica/ninos_evaluacion/brazo_edad','aux_perim','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=130')" style="font-size:85%" /></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</fieldset>
<?php }?>