<fieldset>
	<legend>Peso y Estatura</legend>
	<div class="lineal_eval"><label>Longitud/Estatura:</label><input type="text" size="6" name="estatura" value="<?php echo set_value('estatura',((isset($evaluacion))&&($evaluacion))?$evaluacion->estatura:'');?>" /><strong>mts.</strong></div>
	<div class="lineal_eval"><label>Peso:</label><input type="text" size="6" name="peso" value="<?php echo set_value('peso',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso:'');?>" /><strong>kgs.</strong></div>
</fieldset>
<fieldset>
	<legend>Per&iacute;metros y Circunferencias</legend>
	<div class="lineal_eval"><label>Circ. Mu&ntilde;eca:</label><input type="text" size="5" name="c_muneca" value="<?php echo set_value('c_muneca',((isset($evaluacion))&&($evaluacion))?$evaluacion->c_muneca:'');?>" /><strong>cms.</strong></div>
</fieldset>
<input type="hidden" name="embarazo" value="No" />
<!--<fieldset>
	<legend>Peso Saludable y Peso Meta</legend>
	<div class="lineal_eval">
		<label>Peso Saludable:</label>
		<input type="text" name="peso_saludable" maxlength="6" size="5" value="<?php echo set_value('peso_saludable',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso_saludable:'');?>" />
		<strong>kgs.</strong>
		<?php echo form_error('peso_saludable');?>
	</div>
	<div class="lineal_eval">
		<label>Peso Meta:</label>
		<input type="text" name="peso_meta" maxlength="6" size="5" value="<?php echo set_value('peso_meta',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso_meta:'');?>" />
		<strong>kgs.</strong>
		<?php echo form_error('peso_meta');?>
	</div>
</fieldset>-->