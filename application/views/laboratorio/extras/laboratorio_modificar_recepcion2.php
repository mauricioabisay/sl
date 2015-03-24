<fieldset>
	<legend>Recepci&oacute;n de Laboratorios</legend>
	<div class="lineal">
		<label>Fecha de solicitiud de laboratorios:</label>
		<input type="text" class="date_fecha" disabled="disabled" value="<?php echo set_value('fecha_solicitud',$fecha_solicitud->format('d-m-Y'));?>" />
		<input type="hidden" name="fecha_solicitud" value="<?php echo set_value('fecha_solicitud',$fecha_solicitud->format('d-m-Y'));?>" />
	</div>
	<div class="lineal">
		<label>Fecha de realizaci&oacute;n de laboratorios:</label>
		<input type="text" class="date_fecha" name="fecha_laboratorio" value="<?php echo set_value('fecha_laboratorio',$fecha_laboratorio->format('d-m-Y'));?>" />
	</div>
	<div class="columnaizq">
		<div id="bh" <?php echo (stristr($especificacion, 'bh'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>BH</label>
				<input type="radio" name="bh_status" value="Normal" onclick="$('#bh_desc').css('display','none')" <?php echo set_radio('bh_status','Normal',($laboratorio->bh_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="bh_status" value="Alterado" onclick="$('#bh_desc').css('display','block')"<?php echo set_radio('bh_status','Alterado',($laboratorio->bh_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('bh_status');?>
				<?php echo form_error('bh');?>
			</span>
			<div id="bh_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="bh"><?php echo set_value('bh',((stristr($especificacion, 'bh'))?$laboratorio->bh:''));?></textarea></div>
		</div> 
<div id="qs_trigliceridos" <?php echo (stristr($especificacion, 'qs_trigliceridos'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>QS con triglic&eacute;ridos</label>
				<input type="radio" name="qs_trigliceridos_status" value="Normal" onclick="$('#qs_trigliceridos_desc').css('display','none')" <?php echo set_radio('qs_trigliceridos_status','Normal',($laboratorio->qs_trigliceridos_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="qs_trigliceridos_status" value="Alterado" onclick="$('#qs_trigliceridos_desc').css('display','block')"<?php echo set_radio('qs_trigliceridos_status','Alterado',($laboratorio->qs_trigliceridos_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('qs_trigliceridos_status');?>
				<?php echo form_error('qs_trigliceridos');?>
			</span>
			<div id="qs_trigliceridos_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="qs_trigliceridos"><?php echo set_value('qs_trigliceridos',((stristr($especificacion, 'qs_trigliceridos'))?$laboratorio->qs_trigliceridos:''));?></textarea></div>
		</div> 
<div id="p_lipidos" <?php echo (stristr($especificacion, 'p_lipidos'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Perfil de l&iacute;pidos</label>
				<input type="radio" name="p_lipidos_status" value="Normal" onclick="$('#p_lipidos_desc').css('display','none')" <?php echo set_radio('p_lipidos_status','Normal',($laboratorio->p_lipidos_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="p_lipidos_status" value="Alterado" onclick="$('#p_lipidos_desc').css('display','block')"<?php echo set_radio('p_lipidos_status','Alterado',($laboratorio->p_lipidos_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('p_lipidos_status');?>
				<?php echo form_error('p_lipidos');?>
			</span>
			<div id="p_lipidos_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="p_lipidos"><?php echo set_value('p_lipidos',((stristr($especificacion, 'p_lipidos'))?$laboratorio->p_lipidos:''));?></textarea></div>
		</div> 
<div id="p_hepatico" <?php echo (stristr($especificacion, 'p_hepatico'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Perfil hep&aacute;tico</label>
				<input type="radio" name="p_hepatico_status" value="Normal" onclick="$('#p_hepatico_desc').css('display','none')" <?php echo set_radio('p_hepatico_status','Normal',($laboratorio->p_hepatico_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="p_hepatico_status" value="Alterado" onclick="$('#p_hepatico_desc').css('display','block')"<?php echo set_radio('p_hepatico_status','Alterado',($laboratorio->p_hepatico_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('p_hepatico_status');?>
				<?php echo form_error('p_hepatico');?>
			</span>
			<div id="p_hepatico_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="p_hepatico"><?php echo set_value('p_hepatico',((stristr($especificacion, 'p_hepatico'))?$laboratorio->p_hepatico:''));?></textarea></div>
		</div> 
<div id="p_tiroideo" <?php echo (stristr($especificacion, 'p_tiroideo'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Perfil tiroideo</label>
				<input type="radio" name="p_tiroideo_status" value="Normal" onclick="$('#p_tiroideo_desc').css('display','none')" <?php echo set_radio('p_tiroideo_status','Normal',($laboratorio->p_tiroideo_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="p_tiroideo_status" value="Alterado" onclick="$('#p_tiroideo_desc').css('display','block')"<?php echo set_radio('p_tiroideo_status','Alterado',($laboratorio->p_tiroideo_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('p_tiroideo_status');?>
				<?php echo form_error('p_tiroideo');?>
			</span>
			<div id="p_tiroideo_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="p_tiroideo"><?php echo set_value('p_tiroideo',((stristr($especificacion, 'p_tiroideo'))?$laboratorio->p_tiroideo:''));?></textarea></div>
		</div> 
<div id="p_tiroideo_anticuerpos" <?php echo (stristr($especificacion, 'p_tiroideo_anticuerpos'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Perfil tiroideo con anticuerpos</label>
				<input type="radio" name="p_tiroideo_anticuerpos_status" value="Normal" onclick="$('#p_tiroideo_anticuerpos_desc').css('display','none')" <?php echo set_radio('p_tiroideo_anticuerpos_status','Normal',($laboratorio->p_tiroideo_anticuerpos_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="p_tiroideo_anticuerpos_status" value="Alterado" onclick="$('#p_tiroideo_anticuerpos_desc').css('display','block')"<?php echo set_radio('p_tiroideo_anticuerpos_status','Alterado',($laboratorio->p_tiroideo_anticuerpos_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('p_tiroideo_anticuerpos_status');?>
				<?php echo form_error('p_tiroideo_anticuerpos');?>
			</span>
			<div id="p_tiroideo_anticuerpos_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="p_tiroideo_anticuerpos"><?php echo set_value('p_tiroideo_anticuerpos',((stristr($especificacion, 'p_tiroideo_anticuerpos'))?$laboratorio->p_tiroideo_anticuerpos:''));?></textarea></div>
		</div> 
<div id="p_hormonal" <?php echo (stristr($especificacion, 'p_hormonal'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Perfil hormonal</label>
				<input type="radio" name="p_hormonal_status" value="Normal" onclick="$('#p_hormonal_desc').css('display','none')" <?php echo set_radio('p_hormonal_status','Normal',($laboratorio->p_hormonal_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="p_hormonal_status" value="Alterado" onclick="$('#p_hormonal_desc').css('display','block')"<?php echo set_radio('p_hormonal_status','Alterado',($laboratorio->p_hormonal_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('p_hormonal_status');?>
				<?php echo form_error('p_hormonal');?>
			</span>
			<div id="p_hormonal_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="p_hormonal"><?php echo set_value('p_hormonal',((stristr($especificacion, 'p_hormonal'))?$laboratorio->p_hormonal:''));?></textarea></div>
		</div> 
<div id="tsh" <?php echo (stristr($especificacion, 'tsh'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>TSH</label>
				<input type="radio" name="tsh_status" value="Normal" onclick="$('#tsh_desc').css('display','none')" <?php echo set_radio('tsh_status','Normal',($laboratorio->tsh_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="tsh_status" value="Alterado" onclick="$('#tsh_desc').css('display','block')"<?php echo set_radio('tsh_status','Alterado',($laboratorio->tsh_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('tsh_status');?>
				<?php echo form_error('tsh');?>
			</span>
			<div id="tsh_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="tsh"><?php echo set_value('tsh',((stristr($especificacion, 'tsh'))?$laboratorio->tsh:''));?></textarea></div>
		</div> 
<div id="cortisol" <?php echo (stristr($especificacion, 'cortisol'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Cortisol</label>
				<input type="radio" name="cortisol_status" value="Normal" onclick="$('#cortisol_desc').css('display','none')" <?php echo set_radio('cortisol_status','Normal',($laboratorio->cortisol_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="cortisol_status" value="Alterado" onclick="$('#cortisol_desc').css('display','block')"<?php echo set_radio('cortisol_status','Alterado',($laboratorio->cortisol_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('cortisol_status');?>
				<?php echo form_error('cortisol');?>
			</span>
			<div id="cortisol_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="cortisol"><?php echo set_value('cortisol',((stristr($especificacion, 'cortisol'))?$laboratorio->cortisol:''));?></textarea></div>
		</div>
	</div>
	<div class="columnader">
<div id="ant_prostatico" <?php echo (stristr($especificacion, 'ant_prostatico'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Ant&iacute;geno prost&aacute;tico</label>
				<input type="radio" name="ant_prostatico_status" value="Normal" onclick="$('#ant_prostatico_desc').css('display','none')" <?php echo set_radio('ant_prostatico_status','Normal',($laboratorio->ant_prostatico_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="ant_prostatico_status" value="Alterado" onclick="$('#ant_prostatico_desc').css('display','block')"<?php echo set_radio('ant_prostatico_status','Alterado',($laboratorio->ant_prostatico_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('ant_prostatico_status');?>
				<?php echo form_error('ant_prostatico');?>
			</span>
			<div id="ant_prostatico_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="ant_prostatico"><?php echo set_value('ant_prostatico',((stristr($especificacion, 'ant_prostatico'))?$laboratorio->ant_prostatico:''));?></textarea></div>
		</div> 
<div id="ego" <?php echo (stristr($especificacion, 'ego'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>EGO</label>
				<input type="radio" name="ego_status" value="Normal" onclick="$('#ego_desc').css('display','none')" <?php echo set_radio('ego_status','Normal',($laboratorio->ego_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="ego_status" value="Alterado" onclick="$('#ego_desc').css('display','block')"<?php echo set_radio('ego_status','Alterado',($laboratorio->ego_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('ego_status');?>
				<?php echo form_error('ego');?>
			</span>
			<div id="ego_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="ego"><?php echo set_value('ego',((stristr($especificacion, 'ego'))?$laboratorio->ego:''));?></textarea></div>
		</div> 
<div id="fact_reumatoide" <?php echo (stristr($especificacion, 'fact_reumatoide'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Factor reumatoide</label>
				<input type="radio" name="fact_reumatoide_status" value="Normal" onclick="$('#fact_reumatoide_desc').css('display','none')" <?php echo set_radio('fact_reumatoide_status','Normal',($laboratorio->fact_reumatoide_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="fact_reumatoide_status" value="Alterado" onclick="$('#fact_reumatoide_desc').css('display','block')"<?php echo set_radio('fact_reumatoide_status','Alterado',($laboratorio->fact_reumatoide_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('fact_reumatoide_status');?>
				<?php echo form_error('fact_reumatoide');?>
			</span>
			<div id="fact_reumatoide_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="fact_reumatoide"><?php echo set_value('fact_reumatoide',((stristr($especificacion, 'fact_reumatoide'))?$laboratorio->fact_reumatoide:''));?></textarea></div>
		</div> 
<div id="curva_tolerancia" <?php echo (stristr($especificacion, 'curva_tolerancia'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Curva de tolerancia de 4 horas</label>
				<input type="radio" name="curva_tolerancia_status" value="Normal" onclick="$('#curva_tolerancia_desc').css('display','none')" <?php echo set_radio('curva_tolerancia_status','Normal',($laboratorio->curva_tolerancia_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="curva_tolerancia_status" value="Alterado" onclick="$('#curva_tolerancia_desc').css('display','block')"<?php echo set_radio('curva_tolerancia_status','Alterado',($laboratorio->curva_tolerancia_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('curva_tolerancia_status');?>
				<?php echo form_error('curva_tolerancia');?>
			</span>
			<div id="curva_tolerancia_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="curva_tolerancia"><?php echo set_value('curva_tolerancia',((stristr($especificacion, 'curva_tolerancia'))?$laboratorio->curva_tolerancia:''));?></textarea></div>
		</div> 
<div id="insulina" <?php echo (stristr($especificacion, 'insulina'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Insulina</label>
				<input type="radio" name="insulina_status" value="Normal" onclick="$('#insulina_desc').css('display','none')" <?php echo set_radio('insulina_status','Normal',($laboratorio->insulina_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="insulina_status" value="Alterado" onclick="$('#insulina_desc').css('display','block')"<?php echo set_radio('insulina_status','Alterado',($laboratorio->insulina_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('insulina_status');?>
				<?php echo form_error('insulina');?>
			</span>
			<div id="insulina_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="insulina"><?php echo set_value('insulina',((stristr($especificacion, 'insulina'))?$laboratorio->insulina:''));?></textarea></div>
		</div> 
<div id="glucosa_basal" <?php echo (stristr($especificacion, 'glucosa_basal'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Glucosa basal y post-carga</label>
				<input type="radio" name="glucosa_basal_status" value="Normal" onclick="$('#glucosa_basal_desc').css('display','none')" <?php echo set_radio('glucosa_basal_status','Normal',($laboratorio->glucosa_basal_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="glucosa_basal_status" value="Alterado" onclick="$('#glucosa_basal_desc').css('display','block')"<?php echo set_radio('glucosa_basal_status','Alterado',($laboratorio->glucosa_basal_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('glucosa_basal_status');?>
				<?php echo form_error('glucosa_basal');?>
			</span>
			<div id="glucosa_basal_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="glucosa_basal"><?php echo set_value('glucosa_basal',((stristr($especificacion, 'glucosa_basal'))?$laboratorio->glucosa_basal:''));?></textarea></div>
		</div> 
<div id="insulina_basal" <?php echo (stristr($especificacion, 'insulina_basal'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Insulina basal y post-carga</label>
				<input type="radio" name="insulina_basal_status" value="Normal" onclick="$('#insulina_basal_desc').css('display','none')" <?php echo set_radio('insulina_basal_status','Normal',($laboratorio->insulina_basal_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="insulina_basal_status" value="Alterado" onclick="$('#insulina_basal_desc').css('display','block')"<?php echo set_radio('insulina_basal_status','Alterado',($laboratorio->insulina_basal_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('insulina_basal_status');?>
				<?php echo form_error('insulina_basal');?>
			</span>
			<div id="insulina_basal_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="insulina_basal"><?php echo set_value('insulina_basal',((stristr($especificacion, 'insulina_basal'))?$laboratorio->insulina_basal:''));?></textarea></div>
		</div> 
<div id="h_crecimiento" <?php echo (stristr($especificacion, 'h_crecimiento'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Hormona del crecimiento</label>
				<input type="radio" name="h_crecimiento_status" value="Normal" onclick="$('#h_crecimiento_desc').css('display','none')" <?php echo set_radio('h_crecimiento_status','Normal',($laboratorio->h_crecimiento_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="h_crecimiento_status" value="Alterado" onclick="$('#h_crecimiento_desc').css('display','block')"<?php echo set_radio('h_crecimiento_status','Alterado',($laboratorio->h_crecimiento_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('h_crecimiento_status');?>
				<?php echo form_error('h_crecimiento');?>
			</span>
			<div id="h_crecimiento_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="h_crecimiento"><?php echo set_value('h_crecimiento',((stristr($especificacion, 'h_crecimiento'))?$laboratorio->h_crecimiento:''));?></textarea></div>
		</div> 
<div id="otros" <?php echo (stristr($especificacion, 'otros'))?'':'style="display:none"';?>>
			<span class="lineal">
				<label>Otros</label>
				<input type="radio" name="otros_status" value="Normal" onclick="$('#otros_desc').css('display','none')" <?php echo set_radio('otros_status','Normal',($laboratorio->otros_status=='Normal')?TRUE:FALSE)?> /><label>Normal</label> 
				<input type="radio" name="otros_status" value="Alterado" onclick="$('#otros_desc').css('display','block')"<?php echo set_radio('otros_status','Alterado',($laboratorio->otros_status=='Alterado')?TRUE:FALSE)?> /><label>Alterado</label>
				<?php echo form_error('otros_status');?>
				<?php echo form_error('otros');?>
			</span>
			<div id="otros_desc" <?php echo ($laboratorio->bh=='Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="otros"><?php echo set_value('otros',((stristr($especificacion, 'otros'))?$laboratorio->otros:''));?></textarea></div>
		</div>
	</div>
</fieldset>
<?php echo form_error('bh');?>
<?php echo form_error('qs_trigliceridos');?>
<?php echo form_error('p_lipidos');?>
<?php echo form_error('p_hepatico');?>
<?php echo form_error('p_tiroideo');?>
<?php echo form_error('p_tiroideo_anticuerpos');?>
<?php echo form_error('tsh');?>
<?php echo form_error('cortisol');?>
<?php echo form_error('ant_prostatico');?>
<?php echo form_error('ego');?>
<?php echo form_error('fact_reumatoide');?>
<?php echo form_error('glucosa_basal');?>
<?php echo form_error('insulina_basal');?>
<?php echo form_error('h_crecimiento');?>
<?php echo form_error('curva_tolerancia');?>
<?php echo form_error('otros');?>