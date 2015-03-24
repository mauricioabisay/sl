<fieldset>
	<legend>Historial de Peso</legend>
	<fieldset>
	<legend>Peso M&aacute;ximo</legend>
	<div class="lineal">
		<label>1. &iquest;Cu&aacute;l es el peso m&aacute;ximo que ha alcanzado? </label>
		<span><?php echo $hist->peso_max;?></span><strong>Kg.</strong>
	</div>
	<div class="lineal">
		<label> 2. &iquest;En qu&eacute; fecha?</label>
		<span><?php $aux_fecha = DateTime::createFromFormat('Y-m-d',$hist->peso_max_fecha);echo $aux_fecha->format('d-m-Y');?></span>
	</div>
	</fieldset>
	<fieldset>
	<legend>Peso M&iacute;nimo</legend>
	<div class="lineal">
		<label>  3. &iquest;Cu&aacute;l es el m&iacute;nimo de peso que ha alcanzado?</label>
		<span><?php echo $hist->peso_min;?></span><strong>Kg.</strong>
	</div>
	<div class="lineal">
		<label> 4. &iquest;En qu&eacute; fecha?</label>
		<span><?php $aux_fecha = DateTime::createFromFormat('Y-m-d',$hist->peso_min_fecha);echo $aux_fecha->format('d-m-Y');?></span>
	</div>
	</fieldset>
	<fieldset>
	<legend>Historial</legend>
	<label> 5. Describa su historia de peso en los &uacute;ltimos 6 meses</label>
	<span><?php echo $hist->desc_hist;?></span>
	<div class="lineal">
		<label> 6. &iquest;Ha tomado medicamentos para bajar de peso? </label>
		<span><?php echo $hist->medicamento;?></span>
	</div>
	<?php if($hist->medicamento=='Si'){?>
			<div class="lineal">
				<label>&iquest;Cu&aacute;les?</label>
				<span><?php echo $hist->medicamento;?></span>
			</div>
	<?php }?>
	<div class="lineal">
		<label>7. &iquest;Ha acudido a otros tratamientos? </label>	
		<span><?php echo $hist->tratamiento;?></span>
	</div>
	<fieldset>
	<legend>Tratamientos</legend>
	<?php if($hist->tratamiento=='Si'){?>
	<?php foreach($tratamientos as $tratamiento){?>
			<div class="lineal">
				<label>Fecha:</label>
				<span><?php $aux_fecha = DateTime::createFromFormat('Y-m-d',$tratamiento->fecha);echo $aux_fecha->format('d-m-Y');?></span>
				<label>Resultado:</label>
				<span><?php echo $tratamiento->resultado;?></span>
			</div>
	<?php }}?>
	</fieldset>
	</fieldset>
</fieldset>