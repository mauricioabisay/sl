<fieldset>
		<legend>Solicitud de Laboratorios</legend>
		<div class="lineal">
			<label>&iquest;Tiene s&iacute;ntomas de debilidad, fatiga, angustia,
					cansancio, mareo, necesidad de consumir az&uacute;car,
					visi&oacute;n borrosa?</label>
			<label>S&iacute;</label><input type="radio" name="sintomas" value="Si" onclick='$("#ocultar_sintomas").toggle(200)' <?php echo set_radio('sintomas','Si');?>/>
			<label>No</label><input type="radio" name="sintomas" value="No" onclick='$("#ocultar_sintomas").toggle(!200)' <?php echo set_radio('sintomas','No');?>/>
			<?php echo form_error('sintomas');?>
		</div>
		<div class="lineal" id="ocultar_sintomas" <?php echo ($this->input->post('sintomas'))=='Si'?'':'style="display:none"'?>>
			<label>&iquest;Cu&aacute;ntos s&iacute;ntomas?</label>
			<select name="cuantos_sintomas">
				<option <?php echo set_select('cuantos_sintomas','1');?>value="1">1</option>
				<option <?php echo set_select('cuantos_sintomas','2');?>value="2">2</option>
				<option <?php echo set_select('cuantos_sintomas','3');?>value="3">3</option>
				<option <?php echo set_select('cuantos_sintomas','4');?>value="4">4</option>
				<option <?php echo set_select('cuantos_sintomas','5');?>value="5">5</option>
				<option <?php echo set_select('cuantos_sintomas','6');?>value="6">6</option>
				<option <?php echo set_select('cuantos_sintomas','7');?>value="7">7</option>
			</select>
			<?php echo form_error('cuantos_sintomas');?>
		</div>
		<table>
			<tr>
				<td align="left" colspan="2">Especifique los estudios a realizar:<?php echo form_error('laboratorios');?></td>
			</tr>
			<tr>
				<td align="right">BH</td><td><input type="checkbox" name="laboratorios[]" value="bh" <?php echo set_checkbox('laboratorios','bh');?>/></td>
				<td align="right">Ant&iacute;geno prost&aacute;tico</td><td><input type="checkbox" name="laboratorios[]" value="ant_prostatico" <?php echo set_checkbox('laboratorios','ant_prostatico');?>/></td>
			</tr>
			<tr>
				<td align="right">QS con triglic&eacute;ridos</td><td><input type="checkbox" name="laboratorios[]" value="qs_trigliceridos" <?php echo set_checkbox('laboratorios','qs_trigliceridos');?>/></td>
				<td align="right">EGO</td><td><input type="checkbox" name="laboratorios[]" value="ego" <?php echo set_checkbox('laboratorios','ego');?>/></td>
			</tr>
			<tr>
				<td align="right">Perfil de l&iacute;pidos</td><td><input type="checkbox" name="laboratorios[]" value="p_lipidos" <?php echo set_checkbox('laboratorios','p_lipidos');?>/></td>
				<td align="right">Factor reumatoide</td><td><input type="checkbox" name="laboratorios[]" value="fact_reumatoide" <?php echo set_checkbox('laboratorios','fact_reumatoide');?>/></td>
			</tr>
			<tr>
				<td align="right">Perfil hep&aacute;tico</td><td><input type="checkbox" name="laboratorios[]" value="p_hepatico" <?php echo set_checkbox('laboratorios','p_hepatico');?>/></td>
				<td align="right">Curva de tolerancia de 4 horas</td><td><input type="checkbox" name="laboratorios[]" value="curva_tolerancia" <?php echo set_checkbox('laboratorios','curva_tolerancia');?>/></td>
			</tr>
			<tr>
				<td align="right">Perfil tiroideo</td><td><input type="checkbox" name="laboratorios[]" value="p_tiroideo" <?php echo set_checkbox('laboratorios','p_tiroideo');?>/></td>
				<td align="right">Insulina</td><td><input type="checkbox" name="laboratorios[]" value="insulina" <?php echo set_checkbox('laboratorios','insulina');?>/></td>
			</tr>
			<tr>
				<td align="right">Perfil tiroideo con anticuerpos</td><td><input type="checkbox" name="laboratorios[]" value="p_tiroideo_anticuerpos" <?php echo set_checkbox('laboratorios','p_tiroideo_anticuerpos');?>/></td>
				<td align="right">Glucosa basal y post-carga</td><td><input type="checkbox" name="laboratorios[]" value="glucosa_basal" <?php echo set_checkbox('laboratorios','glucosa_basal');?>/></td>
			</tr>
			<tr>
				<td align="right">Perfil Hormonal</td><td><input type="checkbox" name="laboratorios[]" value="p_hormonal" <?php echo set_checkbox('laboratorios','p_hormonal');?>/></td>
				<td align="right">Insulina basal y post-carga</td><td><input type="checkbox" name="laboratorios[]" value="insulina_basal" <?php echo set_checkbox('laboratorios','insulina_basal');?>/></td>
			</tr>
			<tr>
				<td align="right">TSH</td><td><input type="checkbox" name="laboratorios[]" value="tsh" <?php echo set_checkbox('laboratorios','tsh');?>/></td>
				<td align="right">Hormona del crecimiento</td><td><input type="checkbox" name="laboratorios[]" value="h_crecimiento" <?php echo set_checkbox('laboratorios','h_crecimiento');?>/></td>
			</tr>
			<tr>
				<td align="right">Cortisol</td><td><input type="checkbox" name="laboratorios[]" value="cortisol" <?php echo set_checkbox('laboratorios','cortisol');?>/></td>
				<td align="right">Otros</td>
				<td>
					<input type="checkbox" name="laboratorios[]" value="otros" onclick='$("#otro").toggle(200)' <?php echo set_checkbox('laboratorios','otros');?>  />
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td><td>&nbsp;</td>
				<td align="right"><input type="text" name="otros" value="<?php echo set_value('otros');?>" id="otro" size="33"
				<?php 
				$aux = $this->input->post('alcohol_tipo');
				for($i=0;$i<sizeof($aux);$i++){
					if ($aux[$i]== 'otros')echo 'style="display: inline"';
					else echo 'style="display:none"';
				}
				?>
				/>
				<?php echo form_error('otros');?>				
			</td>
			</tr>
		</table>
</fieldset>