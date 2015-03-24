<fieldset>
<legend>Embarazo y Lactancia</legend>
	<div class="lineal">
		<label>Lactancia</label>
		<label>S&iacute;</label>
		<input type="radio" name="lactancia" value="Si"<?php echo set_radio('lactancia','Si',(isset($antecedentes)&&($antecedentes->lactancia=="Si"))?TRUE:FALSE);?> onclick="$('#embarazo_no').attr('checked',true);$('#ocultar_embarazo').css('display','none')" />
		<label>No</label>
		<input type="radio" name="lactancia" id="lactancia_no" value="No"<?php echo set_radio('lactancia','No',(isset($antecedentes)&&($antecedentes->lactancia=="No"))?TRUE:FALSE);?> />
		<?php echo form_error('lactancia');?>
	</div>
	<div class="lineal">
		<label>Embarazo</label>
			<label>S&iacute;</label><input type="radio" name="embarazo" value="Si" onclick="$('#lactancia_no').attr('checked',true);$('#ocultar_embarazo').toggle(200)" <?php echo set_radio('embarazo','Si',(isset($antecedentes)&&($antecedentes->embarazo=="Si"))?TRUE:FALSE);?>/>
			<label>No</label><input type="radio" name="embarazo" id="embarazo_no" value="No" onclick='$("#ocultar_embarazo").toggle(!200)' <?php echo set_radio('embarazo','No',(isset($antecedentes)&&($antecedentes->embarazo=="No"))?TRUE:FALSE);?>/>
			<?php echo form_error('embarazo');?>
	</div>
	<div id="ocultar_embarazo" <?php echo (isset($antecedentes)&&($antecedentes->embarazo=='Si'))||($this->input->post('embarazo')=='Si')?'':'style="display:none"'?>>
		<div class="lineal">
			<label>N&uacute;mero de gesta</label>
			<input type="text" size="3" name="gesta" value="<?php echo set_value('gesta',(isset($antecedentes))?$antecedentes->gesta:'');?>" />
			<?php echo form_error('gesta');?>
		</div>
		<div class="lineal">
			<label>N&uacute;mero de semanas de embarazo</label>
			<input type="text" size="3" name="semana" value="<?php echo set_value('semana',(isset($antecedentes))?$antecedentes->semana:'');?>"/>
			<?php echo form_error('semana');?>
		</div>
		<!--
		<div class="lineal">
			<label>Peso total esperado</label>
			<input type="text" size="4" name="peso_total_esperado" value="<?php echo set_value('peso_total_esperado',$antecedentes->peso_total_esperado);?>"/>
			<label>Kg.</label>
			<?php echo form_error('peso_total_esperado');?>
		</div>
		-->
		<div class="lineal">
			<label>Peso pregestacional</label>
			<input type="text" size="4" name="peso_pregestacional" value="<?php echo set_value('peso_pregestacional',(isset($antecedentes))?$antecedentes->peso_pregestacional:'');?>"/>
			<label>Kg.</label>
			<?php echo form_error('peso_pregestacional');?>
		</div>
	</div>
</fieldset>