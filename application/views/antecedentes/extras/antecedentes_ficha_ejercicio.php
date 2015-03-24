<fieldset>
<legend>Ejercicio</legend>
<div class="lineal">
	<label>&iquest;Realiza ejercicio?</label>
	<span><?php echo $antecedentes->ejercicio;?><span>
</div>
<div id="ocultar_ejercicio" <?php echo ($antecedentes->ejercicio=="Si")?'':'style="display:none"'?>>
	<?php if(isset($ejercicios) && $ejercicios != FALSE){?>
	<table class="listado">
		<thead>
			<tr><th>Nombre</th><th>Tipo</th><th>Frecuencia</th><th>Duraci&oacute;n</th><th>F. Inicio</th><th>F. Fin</th></tr>
		</thead>
		<tbody>
	<?php foreach($ejercicios as $ejercicio){?>
	<tr id="ejercicio">
		<td><?php echo $ejercicio->nombre;?></td>
		<td><?php echo $ejercicio->tipo;?></td>
		<td>
			<?php echo $ejercicio->valor_frec;?>
			<?php echo ($ejercicio->valor_frec>1)?' veces':' vez';?>
			<?php
				switch ($ejercicio->tipo_frec) {
					case 'diario':{
						echo 'al D&iacute;a';
						break;
					}
					case 'semanal':{
						echo 'a la Semana';
						break;
					}
					case 'mensual':{
						echo 'al Mes';
						break;
					}
					case 'anual':{
						echo 'al A&ntilde;o';
						break;
					}
				}
			?>
		</td>
		<td><?php echo $ejercicio->duracion;?> minutos</td>
		<td><?php $fecha=DateTime::createFromFormat('Y-m-d',$ejercicio->fecha_ini);echo $fecha->format('d-m-Y');?></td>
		<td><?php $fecha=DateTime::createFromFormat('Y-m-d',$ejercicio->fecha_fin);echo ($fecha)?$fecha->format('d-m-Y'):'Sin definir';?></td>
	</tr>
	<?php }}?>
		</tbody>
	</table>			
</div>
</fieldset>