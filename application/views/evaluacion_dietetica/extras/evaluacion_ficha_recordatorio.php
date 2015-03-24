<fieldset>
	<legend>Recordatorio de 24 horas</legend>
	<label>Narre lo que comi&oacute; el d&iacute;a anterior(si fue ordinario)</label>
	<table class="tabla_formulario">
		<thead>
			<tr>
				<th>Alimento</th>
				<th>Cantidad</th>
				<th>Calorias</th>
			</tr>
		</thead>
	<?php $tiempo_actual = ''?>
	<?php foreach($alimentos as $alimento){?>
			<?php
				switch($alimento->tiempo){
					case 'Des':{$alimento_tiempo = 'Desayuno';break;}
					case 'Co1':{$alimento_tiempo = 'Colaci&oacute;n';break;}
					case 'Com':{$alimento_tiempo = 'Comida';break;}
					case 'Co2':{$alimento_tiempo = 'Colaci&oacute;n';break;}
					case 'Cen':{$alimento_tiempo = 'Cena';break;}
				}
			?>
			<?php if($tiempo_actual != $alimento_tiempo){?>
					<tr><th colspan="3"><?php echo $alimento_tiempo;?></th></tr>
			<?php }?>
			<tr>
				<td><?php echo $alimento->alimento;?></td>
				<td><?php echo $alimento->cantidad;?></td>
				<td><?php echo $alimento->calorias;?></td>
			</tr>
			<?php $tiempo_actual = $alimento_tiempo?>
	<?php }?>
	</table>
</fieldset>