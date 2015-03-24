<fieldset>		
	<legend>Consumo de cigarro</legend>
	<div class="lineal">
		<label>&iquest;Fuma?</label>
			<label>S&iacute;</label><input type="radio" name="fuma" value="Si" onclick='$("#ocultar_fuma").toggle(200);' <?php echo set_radio('fuma','Si');?>/>
			<label>No</label><input type="radio" name="fuma" value="No" onclick='$("#ocultar_fuma").toggle(!200);' <?php echo set_radio('fuma','No');?>/>
			<?php echo form_error('fuma');?>
			
	</div>
	<div id="ocultar_fuma" <?php echo ($this->input->post('fuma'))=='Si'?'':'style="display:none"'?>>
		<div class="lineal">
			<label>&iquest;Desde cu&aacute;ndo fuma?</label>
			<input type="text" size="4" name="fuma_valor" value="<?php echo set_value('fuma_valor');?>" />
			<?php echo form_error('fuma_valor');?>
			<select name="fuma_tiempo" >
				<option value="d"<?php echo set_select('fuma_tiempo','d');?>>d&iacute;as</option>
				<option value="m"<?php echo set_select('fuma_tiempo','m');?>>meses</option>
				<option value="a"<?php echo set_select('fuma_tiempo','a');?>>a&ntilde;os</option>
			</select>
			<?php echo form_error('fuma_tiempo');?>
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;ntos cigarros fuma?</label>
			<input type="text" size="4" name="cigarros" value="<?php echo set_value('cigarros');?>"/>
			<?php echo form_error('cigarros');?>
			<select name="fuma_tipo_frec">
				<option value="diario"<?php echo set_select('fuma_tipo_frec','diario');?>>Por d&iacute;a</option>
				<option value="semanal"<?php echo set_select('fuma_tipo_frec','semanal');?>>Por semana</option> 
				<option value="mensual"<?php echo set_select('fuma_tipo_frec','mensual');?>>Por mes</option> 
			</select>
			<?php echo form_error('fuma_tipo_frec');?>
		</div>
	</div>	
</fieldset>