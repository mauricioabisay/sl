<fieldset>
	<legend>Peso y Estatura</legend>
	<div class="lineal_eval"><label>Estatura:</label><input type="text" size="6" name="estatura" value="<?php echo set_value('estatura',(isset($evaluacion)&&($evaluacion))?$evaluacion->estatura:'');?>" /><strong>mts.</strong></div>
	<div class="lineal_eval"><label>Peso:</label><input type="text" size="6" name="peso" value="<?php echo set_value('peso');?>" /><strong>kgs.</strong></div>
</fieldset>
<fieldset>
	<legend>Grasa Corporal</legend>
	<div class="lineal_eval"><label>% Grasa Corporal:</label><input type="text" size="5" name="grasa" value="<?php echo set_value('grasa');?>" /><strong>%</strong></div>
	<fieldset>
		<legend>Pliegues<input type="button" value="+" onclick='$("#pliegues").toggle(200);' style="display: inline" /></legend>
		<div id="pliegues" style="display: none">
			<div class="lineal_eval"><label>P. Biciptal:</label><input type="text" size="6" name="p_biciptal" value="<?php echo set_value('p_biciptal');?>" /><strong>mm.</strong></div>
			<div class="lineal_eval"><label>P. Triciptal:</label><input type="text" size="6" name="p_triciptal" value="<?php echo set_value('triciptal');?>" /><strong>mm.</strong></div>
			<div class="lineal_eval"><label>P. Subescapular:</label><input type="text" size="6" name="p_subescapular" value="<?php echo set_value('p_subescapular');?>" /><strong>mm.</strong></div>
			<div class="lineal_eval"><label>P. Suprailiaco:</label><input type="text" size="6" name="p_suprailiaco" value="<?php echo set_value('p_suprailiaco');?>" /><strong>mm.</strong></div>
		</div>
	</fieldset>
	<div class="columnader">
		<input type="button" value="Llenar ficha tanita" onclick="$('#tanita').toggle(200);($('#tanita_boolean').val()=='No')?$('#tanita_boolean').val('Si'):$('#tanita_boolean').val('No')"/>
	</div>
</fieldset>
<fieldset>
	<legend>Per&iacute;metros y Circunferencias</legend>
	<div class="lineal_eval"><label>Circ. Mu&ntilde;eca:</label><input type="text" size="5" name="c_muneca" value="<?php echo set_value('c_muneca');?>" /><strong>cms.</strong></div>
	<!--<div class="lineal_eval"><label>Circ. Brazo:</label><input type="text" size="5" name="c_brazo" value="<?php echo set_value('c_brazo');?>" /><strong>cms.</strong></div>-->		
</fieldset>
<input type="hidden" name="embarazo" value="No" />