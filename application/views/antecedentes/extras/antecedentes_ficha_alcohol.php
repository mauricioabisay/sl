<fieldset>
	<legend>Consumo de alcohol</legend>
	<div class="lineal">
		<label>&iquest;Consume alcohol?</label>
		<span><?php echo $antecedentes->alcohol;?></span>
	</div>
	<?php if($antecedentes->alcohol=='Si'){?>
			<div class="lineal">
				<label>&iquest;Con qu&eacute; frecuencia?</label>
				<span>
				<?php echo ' '.$antecedentes->alcohol_valor_frec.' veces ';?>
				<?php
					switch ($antecedentes->alcohol_tipo_frec) {
						case 'semanal':{
							echo 'por Semana';
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
			</div>
			<div class="lineal">
				<label>&iquest;Cu&aacute;ntas copas consume por salida?</label>
				<span><?php echo ' '.$antecedentes->copas.' copas ';?></span>
			</div>
			<div class="lineal">
				<label>&iquest;Qu&eacute; tipo de alcohol consume?</label>
				<span><?php echo str_replace('Otro', $antecedentes->alcohol_otro, $antecedentes->alcohol_tipo);?></span>		
			</div>
	<?php }?> 						
</fieldset>