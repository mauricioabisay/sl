<fieldset>
	<legend>Consumo de alcohol</legend>
	<div class="lineal">
		<label>&iquest;Consume alcohol?</label>
			<label>S&iacute;</label>
			<input type="radio" name="alcohol" value="Si"  onclick='$("#ocultar_alcohol").toggle(200);' <?php echo set_radio('alcohol','Si',(isset($antecedentes)&&($antecedentes->alcohol=="Si"))?TRUE:FALSE);?>//>
			<label>No</label>
			<input type="radio" name="alcohol" value="No"  onclick='$("#ocultar_alcohol").toggle(!200);'<?php echo set_radio('alcohol','No',(isset($antecedentes)&&($antecedentes->alcohol=="No"))?TRUE:FALSE);?>/>
			<?php echo form_error('alcohol');?>
	</div>
	<div id="ocultar_alcohol" <?php echo (isset($antecedentes)&&($antecedentes->alcohol=='Si'))||($this->input->post('alcohol')=='Si')?'':'style="display: none"'?>>
		<div class="lineal">
			<label>&iquest;Con qu&eacute; frecuencia?</label>
			<input type="text" size="4" name="alcohol_valor_frec" value="<?php echo set_value('alcohol_valor_frec',(isset($antecedentes))?$antecedentes->alcohol_valor_frec:'');?>"/>
			<?php echo form_error('alcohol_valor_frec');?>
			<select name="alcohol_tipo_frec">
				<option value="semanal" <?php echo set_select('alcohol_tipo_frec','semanal',(isset($antecedentes)&&($antecedentes->alcohol_tipo_frec=="semanal"))?TRUE:FALSE);?>>Por semana</option> 
				<option value="mensual" <?php echo set_select('alcohol_tipo_frec','mensual',(isset($antecedentes)&&($antecedentes->alcohol_tipo_frec=="mensual"))?TRUE:FALSE);?>>Por mes</option> 
				<option value="anual" <?php echo set_select('alcohol_tipo_frec','anual',(isset($antecedentes)&&($antecedentes->alcohol_tipo_frec=="anual"))?TRUE:FALSE);?>>Por a&ntilde;o</option> 
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
				<td><input type="radio" name="copas" value="1-3"<?php echo set_radio('copas','1-3',(isset($antecedentes)&&($antecedentes->copas=="1-3"))?TRUE:FALSE);?> /></td>
			</tr>
			<tr>
				<td><label>De 4 a 8 copas</label></td>
				<td><input type="radio" name="copas" value="4-8"<?php echo set_radio('copas','4-8',(isset($antecedentes)&&($antecedentes->copas=="4-8"))?TRUE:FALSE);?> /></td>
			</tr>
			<tr>
				<td><label>De 9 a 15 copas</label></td>
				<td><input type="radio" name="copas" value="9-15"<?php echo set_radio('copas','9-15',(isset($antecedentes)&&($antecedentes->copas=="9-15"))?TRUE:FALSE);?> /></td>
			</tr>
			<tr>
				<td><label>M&aacute;s de 15 copas</label></td>
				<td><input type="radio" name="copas" value="+15"<?php echo set_radio('copas','+15',(isset($antecedentes)&&($antecedentes->copas=="+15"))?TRUE:FALSE);?> /></td>
			</tr>
		</table>
		<div class="lineal">	
			<label>&iquest;Qu&eacute; tipo de alcohol consume?</label>
			<?php echo form_error('alcohol_tipo');?>
		</div>
		
		<table>
			<tr>
				<td><label>Vodka</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="vodka" <?php echo set_checkbox('alcohol_tipo','vodka',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"vodka")))?FALSE:TRUE);?> /></td>
				<td><label>Brandy</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="brandy" <?php echo set_checkbox('alcohol_tipo','brandy',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"brandy")))?FALSE:TRUE);?> /></td>
			</tr>
			<tr>
				<td><label>Ron</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="ron" <?php echo set_checkbox('alcohol_tipo','ron',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"ron")))?FALSE:TRUE);?> /></td>
				<td><label>Tequila</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="tequila" <?php echo set_checkbox('alcohol_tipo','tequila',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"tequila")))?FALSE:TRUE);?> /></td>
			</tr>
			<tr>
				<td><label>Cerveza</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="cerveza" <?php echo set_checkbox('alcohol_tipo','cerveza',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"cerveza")))?FALSE:TRUE);?> /></td>
				<td><label>Vino</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="vino" <?php echo set_checkbox('alcohol_tipo','vino',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"vino")))?FALSE:TRUE);?> /></td>
			</tr>
			<tr>
				<td><label>Cockteler&iacute;a</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="cockteleria" <?php echo set_checkbox('alcohol_tipo','cockteleria',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"cockteleria")))?FALSE:TRUE);?> /></td>
				<td><label>Otro</label></td>
				<td><input type="checkbox" name="alcohol_tipo[]" value="otro" onclick='$("#otro_alcohol").toggle(200)'<?php echo set_checkbox('alcohol_tipo','otro',(isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"otro")))?FALSE:TRUE);?>/></td>
				<td>
					<div id="otro_alcohol"   
									<?php
										if($this->input->post('alcohol_tipo')){
											$aux= $this->input->post('alcohol_tipo');
											for($i=0;$i<sizeof($aux);$i++){
												if ($aux[$i]== 'otro')
													echo '';
												else
													echo 'style="display:none"';
											}
										}else{
											echo (isset($antecedentes)&&(!stristr($antecedentes->alcohol_tipo,"otro")))?'style="display:none"':'';
										} 
									?>>
						<label>Especifique:</label>
						<div class="lineal">
							<input type="text" name="alcohol_otro" value="<?php echo set_value('alcohol_otro',(isset($antecedentes))?$antecedentes->alcohol_otro:'');?>" />
							<?php echo form_error('alcohol_otro');?>
						</div>
					</div>	
				</td>
			</tr>
		</table> 						
</fieldset>