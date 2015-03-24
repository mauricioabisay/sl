<fieldset>		
	<legend>Consumo de cigarro</legend>
	<div class="lineal">
		<label>&iquest;Fuma?</label>
			<label>S&iacute;</label><input type="radio" name="fuma" value="Si" onclick='$("#ocultar_fuma").toggle(200);' <?php echo set_radio('fuma','Si',(isset($antecedentes)&&($antecedentes->fuma=="Si"))?TRUE:FALSE);?>/>
			<label>No</label><input type="radio" name="fuma" value="No" onclick='$("#ocultar_fuma").toggle(!200);' <?php echo set_radio('fuma','No',(isset($antecedentes)&&($antecedentes->fuma=="No"))?TRUE:FALSE);?>/>
			<?php echo form_error('fuma');?>			
	</div>
	<div id="ocultar_fuma" <?php echo (isset($antecedentes)&&($antecedentes->fuma=='Si'))?'':'style="display:none"'?>>
		<div class="lineal">
			<label>&iquest;Desde cu&aacute;ndo fuma?</label>
			<input type="text" size="4" name="fuma_valor" value="<?php echo set_value('fuma_valor',(isset($antecedentes)&&($antecedentes->fuma_valor))?$antecedentes->fuma_valor:'');?>" />
			<?php echo form_error('fuma_valor');?>
			<select name="fuma_tiempo" >
				<option value="d"<?php echo set_select('fuma_tiempo','d',(isset($antecedentes)&&($antecedentes->fuma_tiempo=="d"))?TRUE:FALSE);?>>d&iacute;as</option>
				<option value="m"<?php echo set_select('fuma_tiempo','m',(isset($antecedentes)&&($antecedentes->fuma_tiempo=="m"))?TRUE:FALSE);?>>meses</option>
				<option value="a"<?php echo set_select('fuma_tiempo','a',(isset($antecedentes)&&($antecedentes->fuma_tiempo=="a"))?TRUE:FALSE);?>>a&ntilde;os</option>
			</select>
			<?php echo form_error('fuma_tiempo');?>
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;ntos cigarros fuma?</label>
			<input type="text" size="4" name="cigarros" value="<?php echo set_value('cigarros',(isset($antecedentes))?$antecedentes->cigarros:'');?>"/>
			<?php echo form_error('cigarros');?>
			<select name="fuma_tipo_frec">
				<option value="diario"<?php echo set_select('fuma_tipo_frec','diario',(isset($antecedentes)&&($antecedentes->fuma_tipo_frec=="diario")?TRUE:FALSE));?>>Por d&iacute;a</option>
				<option value="semanal"<?php echo set_select('fuma_tipo_frec','semanal',(isset($antecedentes)&&($antecedentes->fuma_tipo_frec=="semanal")?TRUE:FALSE));?>>Por semana</option> 
				<option value="mensual"<?php echo set_select('fuma_tipo_frec','mensual',(isset($antecedentes)&&($antecedentes->fuma_tipo_frec=="mensual")?TRUE:FALSE));?>>Por mes</option> 
			</select>
			<?php echo form_error('fuma_tipo_frec');?>
		</div>
	</div>	
</fieldset>