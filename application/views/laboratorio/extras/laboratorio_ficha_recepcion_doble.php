<fieldset>
	<legend>Resultados de Laboratorios</legend>
<div id="laboratorio_resultados">
	<div class="lineal">
		<label>Fecha de realizaci&oacute;n (Fecha en que el paciente acudió a realizarse los estudios):</label>
		<?php $fecha_l = DateTime::createFromFormat('Y-m-d',$laboratorio_res->fecha_laboratorio);echo ($fecha_l)?$fecha_l->format('d-m-Y'):'';?>
	</div>
	<div class="lineal">
		<label>Fecha de captura (Fecha en que el paciente proporcionó los resultados de los estudios):</label>
		<?php $fecha_c = DateTime::createFromFormat('Y-m-d',$laboratorio_res->fecha_captura);echo ($fecha_c)?$fecha_c->format('d-m-Y'):'';?>
	</div>
	<table class="listado">
		<thead>
			<tr>
				<th>Estudio</th><th>Resultado</th><th>Comentarios</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($estudios as $estudio){?>
			<tr>
				<td><?php echo $estudio->nombre;?></td>
				<td><?php echo $estudio->status;?></td>
				<td><?php echo (($estudio->status=='Alterado')&&(isset($estudio->nota)))?$estudio->nota:'Sin comentarios.';?></td>
			</tr>
	<?php }?>	
		</tbody>
	</table>
</div>
</fieldset>