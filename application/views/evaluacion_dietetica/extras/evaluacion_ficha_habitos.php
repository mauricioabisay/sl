<fieldset>
	<legend>Preguntas sobre h&aacute;bitos alimenticios</legend>
		<table class="tabla_formulario">
			<thead>
			<tr><th colspan="6">Comidas del d&iacute;a</th></tr>
			<tr align="center">
				<th></th>
				<th>Existe</th>
				<th width="20%">Lugar</th>
				<th width="20%">Horario</th>
				<th width="30%">&iquest;Qui&eacute;n cocina?</th>
			</tr>
			</thead>
			<tbody>
			<?php
				if(isset($habitos) && $habitos != FALSE)
				foreach($habitos as $habito){
			?>
			<tr>
				<td class="titulo">
					<?php
					switch($habito->tiempo){
						case 'Des':{echo 'Desayuno';break;}
						case 'Co1':{echo 'Colaci&oacute;n';break;}
						case 'Com':{echo 'Comida';break;}
						case 'Co2':{echo 'Colaci&oacute;n';break;}
						case 'Cen':{echo 'Cena';break;}
					}
					?>
				</td>
				<td><?php echo $habito->existe;?></td>
				<?php if($habito->existe=="Si"){?>
					<td><?php echo $habito->lugar;?></td>
					<td><?php $aux_hora = DateTime::createFromFormat('H:i:s',$habito->hora);echo $aux_hora->format('h:i a');?></td>
					<td><?php echo $habito->cocinero;?></td>
				<?php }?>
			<?php
				}
			?>
			</tbody>
		</table>
</fieldset>