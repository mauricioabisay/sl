<fieldset>
<legend>Ejercicio</legend>
<table class="listado" style="font-size:80%">
	<thead><tr>
		<th>Nombre</th>
		<th>Tipo</th>
		<th>Frec.</th>
		<th>Dur.</th>
	</tr></thead>
	<tbody>
	<?php if(isset($ejercicios) && $ejercicios != FALSE){?>
	<?php foreach($ejercicios as $ejercicio){?>
			<tr>
				<td><?php echo $ejercicio->nombre;?></td>
				<td><?php echo $ejercicio->tipo;?></td>
				<td><?php echo $ejercicio->valor_frec;?>
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
			</tr>
	<?php }}else{?>
			<label>El paciente no hace ejercicio.</label>
	<?php }?>			
</tbody>
</table>
</fieldset>