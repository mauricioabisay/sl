<fieldset>
	<legend>Solicitud de Laboratorios</legend>
	<div class="lineal">
		<label>&iquest;Tiene s&iacute;ntomas de debilidad, fatiga, angustia,
			cansancio, mareo, necesidad de consumir az&uacute;car,
			visi&oacute;n borrosa?</label>
		<label>S&iacute;</label><input type="radio" name="sintomas" value="Si" onclick='$("#ocultar_sintomas").toggle(200)' <?php echo set_radio('sintomas','Si',($laboratorio->sintomas>0)?TRUE:FALSE);?>/>
		<label>No</label><input type="radio" name="sintomas" value="No" onclick='$("#ocultar_sintomas").toggle(!200)' <?php echo set_radio('sintomas','No',($laboratorio->sintomas==0)?TRUE:FALSE);?>/>
		<?php echo form_error('sintomas');?>
	</div>
	<div class="lineal" id="ocultar_sintomas" <?php echo (($this->input->post('sintomas')=='Si')||($laboratorio->sintomas>0))?'':'style="display:none"';?>>
		<label>&iquest;Cu&aacute;ntos s&iacute;ntomas?</label>
		<select name="cuantos_sintomas">
			<option <?php echo set_select('cuantos_sintomas','');?> value=""></option>
			<option <?php echo set_select('cuantos_sintomas','1',($laboratorio->sintomas==1)?TRUE:FALSE);?> value="1">1</option>
			<option <?php echo set_select('cuantos_sintomas','2',($laboratorio->sintomas==2)?TRUE:FALSE);?> value="2">2</option>
			<option <?php echo set_select('cuantos_sintomas','3',($laboratorio->sintomas==3)?TRUE:FALSE);?> value="3">3</option>
			<option <?php echo set_select('cuantos_sintomas','4',($laboratorio->sintomas==4)?TRUE:FALSE);?> value="4">4</option>
			<option <?php echo set_select('cuantos_sintomas','5',($laboratorio->sintomas==5)?TRUE:FALSE);?> value="5">5</option>
			<option <?php echo set_select('cuantos_sintomas','6',($laboratorio->sintomas==6)?TRUE:FALSE);?> value="6">6</option>
			<option <?php echo set_select('cuantos_sintomas','7',($laboratorio->sintomas==7)?TRUE:FALSE);?> value="7">7</option>
		</select>
		<?php echo form_error('cuantos_sintomas');?>
	</div>
	<label>Especifique los estudios a realizar:<?php echo form_error('laboratorios');?></label>
	<div class="columnaizq" style="width: 50%;float: left">
		<div class="lineal_eval">
			<label style="width:85%">BH</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="bh" <?php echo set_checkbox('laboratorios','bh',(stristr($laboratorio->especificacion, 'bh'))?TRUE:FALSE);?> onclick='$("#bh").toggle(200);' />
		</div>
		<div class="lineal_eval">
			<label style="width:85%">QS con triglic&eacute;ridos</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="qs_trigliceridos" <?php echo set_checkbox('laboratorios','qs_trigliceridos',(stristr($laboratorio->especificacion, 'qs_trigliceridos'))?TRUE:FALSE);?> onclick='$("#qs_trigliceridos").toggle(200);' />
		</div>
		<div class="lineal_eval"> 
			<label style="width:85%">Perfil de l&iacute;pidos</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="p_lipidos" <?php echo set_checkbox('laboratorios','p_lipidos',(stristr($laboratorio->especificacion, 'p_lipidos'))?TRUE:FALSE);?> onclick='$("#p_lipidos").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Perfil hep&aacute;tico</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="p_hepatico" <?php echo set_checkbox('laboratorios','p_hepatico',(stristr($laboratorio->especificacion, 'p_hepatico'))?TRUE:FALSE);?> onclick='$("#p_hepatico").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Perfil tiroideo</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="p_tiroideo" <?php echo set_checkbox('laboratorios','p_tiroideo',(stristr($laboratorio->especificacion, 'p_tiroideo'))?TRUE:FALSE);?> onclick='$("#p_tiroideo").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Perfil tiroideo con anticuerpos</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="p_tiroideo_anticuerpos" <?php echo set_checkbox('laboratorios','p_tiroideo_anticuerpos',(stristr($laboratorio->especificacion, 'p_tiroideo_anticuerpos'))?TRUE:FALSE);?> onclick='$("#p_tiroideo_anticuerpos").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Perfil hormonal</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="p_hormonal" <?php echo set_checkbox('laboratorios','p_hormonal',(stristr($laboratorio->especificacion, 'p_hormonal'))?TRUE:FALSE);?> onclick='$("#p_hormonal").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">TSH</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="tsh" <?php echo set_checkbox('laboratorios','tsh',(stristr($laboratorio->especificacion, 'tsh'))?TRUE:FALSE);?> onclick='$("#tsh").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Cortisol</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="cortisol" <?php echo set_checkbox('laboratorios','cortisol',(stristr($laboratorio->especificacion, 'cortisol'))?TRUE:FALSE);?> onclick='$("#cortisol").toggle(200);' />
		</div>
	</div>
	<div class="columnader" style="width: 50%;float: left">
		<div class="lineal_eval">
			<label style="width:85%">Ant&iacute;geno prost&aacute;tico</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="ant_prostatico" <?php echo set_checkbox('laboratorios','ant_prostatico',(stristr($laboratorio->especificacion, 'ant_prostatico'))?TRUE:FALSE);?> onclick='$("#ant_prostatico").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">EGO</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="ego" <?php echo set_checkbox('laboratorios','ego',(stristr($laboratorio->especificacion, 'ego'))?TRUE:FALSE);?> onclick='$("#ego").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Factor reumatoide</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="fact_reumatoide" <?php echo set_checkbox('laboratorios','fact_reumatoide',(stristr($laboratorio->especificacion, 'fact_reumatoide'))?TRUE:FALSE);?> onclick='$("#fact_reumatoide").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Curva de tolerancia de 4 horas</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="curva_tolerancia" <?php echo set_checkbox('laboratorios','curva_tolerancia',(stristr($laboratorio->especificacion, 'curva_tolerancia'))?TRUE:FALSE);?> onclick='$("#curva_tolerancia").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Insulina</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="insulina" <?php echo set_checkbox('laboratorios','insulina',(stristr($laboratorio->especificacion, 'insulina'))?TRUE:FALSE);?> onclick='$("#insulina").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Glucosa basal y post-carga</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="glucosa_basal" <?php echo set_checkbox('laboratorios','glucosa_basal',(stristr($laboratorio->especificacion, 'glucosa_basal'))?TRUE:FALSE);?> onclick='$("#glucosa_basal").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Insulina basal y post-carga</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="insulina_basal" <?php echo set_checkbox('laboratorios','insulina_basal',(stristr($laboratorio->especificacion, 'insulina_basal'))?TRUE:FALSE);?> onclick='$("#insulina_basal").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Hormona del crecimiento</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="h_crecimiento" <?php echo set_checkbox('laboratorios','h_crecimiento',(stristr($laboratorio->especificacion, 'h_crecimiento'))?TRUE:FALSE);?> onclick='$("#h_crecimiento").toggle(200);' /> 
		</div>
		<div class="lineal_eval">
			<label style="width:85%">Otros</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="otros" <?php echo set_checkbox('laboratorios','otros',(stristr($laboratorio->especificacion, 'otros'))?TRUE:FALSE);?> onclick='$("#otros").toggle(200);' />
		</div>
	</div>
</fieldset>