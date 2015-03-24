<fieldset>		
	<legend>Consumo de cigarro</legend>
	<div class="lineal">
		<label>&iquest;Fuma?</label><span><?php echo $antecedentes->fuma;?></span>
	</div>
	<?php 
	if($antecedentes->fuma=='Si'){
	?>
	<div class="lineal">
		<label>&iquest;Desde cu&aacute;ndo fuma?</label>
		<span>
			<?php echo ' '.$antecedentes->fuma_valor.' ';?>
			<?php
			switch($antecedentes->fuma_tiempo){
				case 'd':{
					echo 'D&iacute;as';
					break;
				}
				case 'm':{
					echo 'Meses';
					break;
				}
				case 'd':{
					echo 'A&ntilde;os';
					break;
				}
			}
			?>
		</span>
	</div>
	<div class="lineal">
		<label>&iquest;Cu&aacute;ntos cigarros fuma?</label>
		<span>
			<?php echo ' '.$antecedentes->cigarros.' cigarros ';?>
			<?php
			switch ($antecedentes->fuma_tipo_frec) {
				case 'diario':{
					echo 'por D&iacute;a';
					break;
				}
				case 'semanal':{
					echo 'por Semana';
					break;
				}
				case 'diario':{
					echo 'por Mes';
					break;
				}
			}
			?>
		</span>
	</div>
	<?php	
	}
	?>	
</fieldset>