<fieldset>
	<legend>Preguntas generales</legend>
	<div class="lineal">
		<label>&iquest;Qu&eacute; expectativa de evoluci&oacute;n tiene?</label>
		<input type="radio" name="evolucion" value="Rapida" <?php echo set_radio('evolucion','Rapida');?>/>
		<label>R&aacute;pida</label>
		<input type="radio" name="evolucion" value="Moderada" <?php echo set_radio('evolucion','Moderada');?>/>
		<label>Moderada</label>
		<input type="radio" name="evolucion" value="Lenta" <?php echo set_radio('evolucion','Lenta');?>/>
		<label>Lenta</label>
		<?php echo form_error('evolucion');?>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 el nivel de desgaste o irritabilidad que le genera el tema</label>
		<select name="desgaste">
			<option value="1" <?php echo set_select('desgaste','1');?>>1</option>
			<option value="2" <?php echo set_select('desgaste','2');?>>2</option>
			<option value="3" <?php echo set_select('desgaste','3');?>>3</option>
			<option value="4" <?php echo set_select('desgaste','4');?>>4</option>
			<option value="5" <?php echo set_select('desgaste','5');?>>5</option>
			<option value="6" <?php echo set_select('desgaste','6');?>>6</option>
			<option value="7" <?php echo set_select('desgaste','7');?>>7</option>
			<option value="8" <?php echo set_select('desgaste','8');?>>8</option>
			<option value="9" <?php echo set_select('desgaste','9');?>>9</option>
			<option value="10" <?php echo set_select('desgaste','10');?>>10</option>
		</select>
		<?php echo form_error('desgaste');?>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 la motivaci&oacute;n con la que llega</label>
		<select name="motivacion">
			<option value="1" <?php echo set_select('motivacion','1');?>>1</option>
			<option value="2" <?php echo set_select('motivacion','2');?>>2</option>
			<option value="3" <?php echo set_select('motivacion','3');?>>3</option>
			<option value="4" <?php echo set_select('motivacion','4');?>>4</option>
			<option value="5" <?php echo set_select('motivacion','5');?>>5</option>
			<option value="6" <?php echo set_select('motivacion','6');?>>6</option>
			<option value="7" <?php echo set_select('motivacion','7');?>>7</option>
			<option value="8" <?php echo set_select('motivacion','8');?>>8</option>
			<option value="9" <?php echo set_select('motivacion','9');?>>9</option>
			<option value="10" <?php echo set_select('motivacion','10');?>>10</option>
		</select>
		<?php echo form_error('motivacion');?>
	</div>
	<div class="lineal">
		<label>&iquest;Por qu&eacute;?</label>
		<input type="text" size="50" name="razon_motivacion" value="<?php echo set_value('razon_motivacion');?>" >
		<?php echo form_error('razon_motivacion');?>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 qu&eacute; tan capaz se cree usted de lograr los resultados</label>
		<select name="capacidad">
			<option value="" <?php echo set_select('capacidad','');?>></option>
			<option value="1" <?php echo set_select('capacidad','1');?>>1</option>
			<option value="2" <?php echo set_select('capacidad','2');?>>2</option>
			<option value="3" <?php echo set_select('capacidad','3');?>>3</option>
			<option value="4" <?php echo set_select('capacidad','4');?>>4</option>
			<option value="5" <?php echo set_select('capacidad','5');?>>5</option>
			<option value="6" <?php echo set_select('capacidad','6');?>>6</option>
			<option value="7" <?php echo set_select('capacidad','7');?>>7</option>
			<option value="8" <?php echo set_select('capacidad','8');?>>8</option>
			<option value="9" <?php echo set_select('capacidad','9');?>>9</option>
			<option value="10" <?php echo set_select('capacidad','10');?>>10</option>
		</select>
		<?php echo form_error('capacidad');?>
	</div>
</fieldset>