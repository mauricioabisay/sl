<fieldset>
<legend>Embarazo</legend>
	<div class="lineal">
		<label>Embarazo:</label><span><?php echo $antecedentes->embarazo;?></span>
	</div>
	<div class="lineal">
		<label>Lactancia:</label>
		<span><?php echo $antecedentes->lactancia;?></span>
	</div>
	<?php 
	if($antecedentes->embarazo=='Si'){
	?>
	<div class="lineal">
			<label>N&uacute;mero de gesta:</label><span><?php echo $antecedentes->gesta;?></span>
	</div>
	<div class="lineal">
		<label>N&uacute;mero de semanas de embarazo:</label><span><?php echo $antecedentes->semana;?></span>
	</div>
	<!--
	<div class="lineal">
		<label>Peso total esperado:</label><span><?php echo $antecedentes->peso_total_esperado;?></span>
	</div>
	-->
	<div class="lineal">
		<label>Peso pregestacional</label><span><?php echo $antecedentes->peso_pregestacional;?></span>
	</div>
	<?php
	}
	?>
</fieldset>