<fieldset>
	<legend>Peso y Longitud</legend>
	<div class="lineal_eval"><label>Longitud:</label><input type="text" size="6" name="estatura" value="<?php echo set_value('estatura',((isset($evaluacion))&&($evaluacion))?$evaluacion->estatura:'');?>" /><strong>mts.</strong></div>
	<div class="lineal_eval"><label>Peso:</label><input type="text" size="6" name="peso" value="<?php echo set_value('peso',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso:'');?>" /><strong>kgs.</strong></div>
</fieldset>
<fieldset>
	<legend>Per&iacute;metros y Circunferencias</legend>
	<div class="lineal_eval"><label>Per&iacute;m. Cef&aacute;lico:</label><input type="text" size="6" name="perim_cefalico" value="<?php echo set_value('perim_cefalico',((isset($evaluacion))&&($evaluacion))?$evaluacion->perim_cefalico:'');?>" /><strong>cms.</strong></div>
	<div class="lineal_eval"><label>Circ. Brazo:</label><input type="text" size="5" name="c_brazo" value="<?php echo set_value('c_brazo',((isset($evaluacion))&&($evaluacion))?$evaluacion->c_brazo:'');?>" /><strong>cms.</strong></div>
</fieldset>
<input type="hidden" name="embarazo" value="No" />
<input type="hidden" name="lactancia" value="No" />