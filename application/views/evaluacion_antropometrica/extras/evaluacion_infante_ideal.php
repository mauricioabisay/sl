<fieldset>
	<legend>Criterios Waterlow<input type="button" value="+" onclick='$("#cw").toggle(200);' /></legend>
	<div class="lineal_oculto" id="cw">
		<table class="listado_oculto" style="display:block">
			<thead>
				<tr>
					<th>F&oacute;rmula</th>
					<th>Ideal</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Peso/Edad</td>
					<td><?php echo $ideal_waterlow['peso_edad'];?></td>
				</tr>
				<tr>
					<td>Estatura/Edad</td>
					<td><?php echo $ideal_waterlow['estatura_edad'];?></td>
				</tr>
				<tr>
					<td>Peso/Estatura</td>
					<td><?php echo $ideal_waterlow['peso_estatura'];?></td>
				</tr>
			</tbody>
		</table>
	</div>
</fieldset>
<fieldset>
	<legend>Criterios Puntaci&oacute;n Z<input type="button" value="+" onclick='$("#cw").toggle(200);' /></legend>
	<div class="lineal_oculto" id="cw">
		<table class="listado_oculto" style="display:block">
			<thead>
				<tr>
					<th>F&oacute;rmula</th>
					<th>Ideal</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Peso/Edad</td>
					<td><?php echo $ideal_z['peso_edad'];?></td>
				</tr>
				<tr>
					<td>Estatura/Edad</td>
					<td><?php echo $ideal_z['estatura_edad'];?></td>
				</tr>
				<tr>
					<td>Peso/Estatura</td>
					<td><?php echo $ideal_z['peso_estatura'];?></td>
				</tr>
			</tbody>
		</table>
	</div>
</fieldset>
<fieldset>
	<legend>IMC<input type="button" value="+" onclick='$("#imc").toggle(200);' /></legend>
	<table class="listado_oculto" id="imc">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Ideal</th>
			</tr>
		</thead>
		<tbody>
			<td>IMC</td>
			<td>Peso/Estatura&sup2;</td>
			<td><?php echo $ideal_imc;?></td>
		</tbody>
	</table>
</fieldset>
<?php if(($evaluacion->c_brazo>0)||($evaluacion->perim_cefalico>0)){?>
<fieldset>
	<legend>Circunferencias<input type="button" value="+" onclick='$("#circ").toggle(200);' /></legend>
	<table class="listado_oculto" id="circ">
		<thead>
			<tr>
				<th>&Iacute;ndice</th>
				<th>F&oacute;rmula</th>
				<th>Ideal</th>
			</tr>
		</thead>
		<tbody>
			<?php if($evaluacion->perim_cefalico>0){?>
			<tr>
				<td>&Iacute;ndice Circ. Cef&aacute;lica/Edad</td>
				<td>Circ. Cef&aacute;lica/Edad</td>
				<td><?php echo $ideal_circ_cefalica;?></td>
			</tr>
			<?php }?>
			<?php if($evaluacion->c_brazo>0){?>
			<tr>
				<td>&Iacute;ndice Circ. Brazo/Edad</td>
				<td>Circ. Brazo/Edad</td>
				<td><?php echo $ideal_circ_brazo;?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</fieldset>
<?php }?>