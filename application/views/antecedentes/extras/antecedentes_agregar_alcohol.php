<fieldset>
	<legend>Consumo de alcohol</legend>
	<div class="lineal">
		<label>&iquest;Consume alcohol?</label>
			<label>S&iacute;</label>
			<input type="radio" name="alcohol" value="Si"  onclick='$("#ocultar_alcohol").toggle(200);' <?php echo set_radio('alcohol','Si');?>//>
			<label>No</label>
			<input type="radio" name="alcohol" value="No"  onclick='$("#ocultar_alcohol").toggle(!200);' <?php echo set_radio('alcohol','No');?>/>
			<?php echo form_error('alcohol');?>
	</div>
	<div id="ocultar_alcohol" <?php echo ($this->input->post('alcohol'))=='Si'?'':'style="display:none"'?>>
		<div class="lineal">
			<label>&iquest;Con qu&eacute; frecuencia?</label>
				<input type="text" size="4" name="alcohol_valor_frec" value="<?php echo set_value('alcohol_valor_frec');?>"/>
				<?php echo form_error('alcohol_valor_frec');?>
				<select name="alcohol_tipo_frec" >
					<option <?php echo set_select('alcohol_tipo_frec','');?>></option>
					<option value="semanal" <?php echo set_select('alcohol_tipo_frec','semanal');?>>Por semana</option> 
					<option value="mensual" <?php echo set_select('alcohol_tipo_frec','mensual');?>>Por mes</option> 
					<option value="anual" <?php echo set_select('alcohol_tipo_frec','anual');?>>Por a&ntilde;o</option> 
				</select>
				<?php echo form_error('alcohol_tipo_frec');?>
		</div>
		<div class="lineal">
			<label>&iquest;Cu&aacute;ntas copas consume por salida?</label>
			<?php echo form_error('copas');?>
		</div>
		<table>
			<tr>
				<td><label>De 1 a 3 copas</label></td>
				<td><input type="radio" name="copas" value="1-3"<?php echo set_radio('copas','1-3');?> /></td>
			</tr>
			<tr>
				<td><label>De 4 a 8 copas</label></td>
				<td><input type="radio" name="copas" value="4-8"<?php echo set_radio('copas','4-8');?> /></td>
			</tr>
			<tr>
				<td><label>De 9 a 15 copas</label></td>
				<td><input type="radio" name="copas" value="9-15"<?php echo set_radio('copas','9-15');?> /></td>
			</tr>
			<tr>
				<td><label>M&aacute;s de 15 copas</label></td>
				<td><input type="radio" name="copas" value="+15"<?php echo set_radio('copas','+15');?> /></td>
			</tr>
		</table>
		<div class="lineal">
			<label>&iquest;Qu&eacute; tipo de alcohol consume?</label>
			<?php echo form_error('alcohol_tipo');?>
		</div>
		<table>
			<tr>
				<td><label>Vodka</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="vodka" <?php echo set_checkbox('alcohol_tipo','vodka');?> /></td>
				<td><label>Brandy</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="brandy" <?php echo set_checkbox('alcohol_tipo','brandy');?> /></td>
			</tr>
			<tr>
				<td><label>Ron</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="ron" <?php echo set_checkbox('alcohol_tipo','ron');?> /></td>
				<td><label>Tequila</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="tequila" <?php echo set_checkbox('alcohol_tipo','tequila');?> /></td>
			</tr>
			<tr>
				<td><label>Cerveza</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="cerveza" <?php echo set_checkbox('alcohol_tipo','cerveza');?> /></td>
				<td><label>Vino</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="vino" <?php echo set_checkbox('alcohol_tipo','vino');?> /></td>
			</tr>
			<tr>
				<td><label>Cockteler&iacute;a</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="cockteleria" <?php echo set_checkbox('alcohol_tipo','cockteleria');?> /></td>
				<td><label>Otro</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="otro" onclick='$("#otro_alcohol").toggle(200)'<?php echo set_checkbox('alcohol_tipo','otro');?>/></td>
				<td>
					<div id="otro_alcohol"   
									<?php 
										$aux= $this->input->post('alcohol_tipo');
										for($i=0;$i<sizeof($aux);$i++)
										{
											if ($aux[$i]== 'otro')
												echo '';
											else
												echo 'style="display:none"';
										}
									?>
					>
						<label>Especifique:</label>
						<div class="lineal">
							<input type="text" name="alcohol_otro" />
							<?php echo form_error('alcohol_otro');?>
						</div>
					</div>	
				</td>
			</tr>
		</table>		
</fieldset>