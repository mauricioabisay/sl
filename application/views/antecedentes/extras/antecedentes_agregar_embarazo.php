<fieldset>
<legend>Embarazo y lactancia</legend>
	<div class="lineal">
		<label>Lactancia</label>
		<label>S&iacute;</label>
		<input type="radio" name="lactancia" value="Si"<?php echo set_radio('lactancia','Si');?> onclick="$('#embarazo_no').attr('checked',true);$('#ocultar_embarazo').css('display','none')" />
		<label>No</label>
		<input type="radio" id="lactancia_no" name="lactancia" value="No"<?php echo set_radio('lactancia','No');?> />
		<?php echo form_error('lactancia');?>	
	</div>
	<div class="lineal">
		<label>Embarazo:</label>
		<label>S&iacute;</label><input type="radio" name="embarazo" value="Si" onclick="$('#lactancia_no').attr('checked',true);$('#ocultar_embarazo').toggle(200)" <?php echo set_radio('embarazo','Si');?>/>
		<label>No</label><input type="radio" id="embarazo_no" name="embarazo"  value="No" onclick="$('#ocultar_embarazo').toggle(!200)" <?php echo set_radio('embarazo','No');?>/>
		<?php echo form_error('embarazo');?>	
	</div>
	<div id="ocultar_embarazo" <?php echo ($this->input->post('embarazo'))=='Si'?'':'style="display:none"'?>>
		<div class="lineal">
			<label>N&uacute;mero de gesta</label>
			<input type="text" size="3" name="gesta" value="<?php echo set_value('gesta');?>" />
			<?php echo form_error('gesta');?>
		</div>
		<div class="lineal">
			<label>N&uacute;mero de semanas de embarazo</label>
			<input type="text" size="3" name="semana" value="<?php echo set_value('semana');?>"/>
			<?php echo form_error('semana');?>
		</div>
		<!--
		<div class="lineal">
			<label>Peso total esperado</label>
			<input type="text" size="4" name="peso_total_esperado" value="<?php echo set_value('peso_total_esperado');?>"/>
			<label>Kg.</label>
			<?php echo form_error('peso_total_esperado');?>
		</div>
		-->
		<div class="lineal">
			<label>Peso pregestacional</label>
			<input type="text" size="4" name="peso_pregestacional" value="<?php echo set_value('peso_pregestacional');?>"/>
			<label>Kg.</label>
			<?php echo form_error('peso_pregestacional');?>
		</div>
	</div>	
	
</fieldset>