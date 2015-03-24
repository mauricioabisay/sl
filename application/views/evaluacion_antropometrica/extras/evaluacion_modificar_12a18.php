<fieldset>
	<legend>Peso y Estatura</legend>
	<div class="lineal_eval"><label>Estatura:</label><input type="text" size="6" name="estatura" value="<?php echo set_value('estatura',((isset($evaluacion))&&($evaluacion))?$evaluacion->estatura:'');?>" /><strong>mts.</strong></div>
	<div class="lineal_eval"><label>Peso:</label><input type="text" size="6" name="peso" value="<?php echo set_value('peso',((isset($evaluacion))&&($evaluacion))?$evaluacion->peso:'');?>" /><strong>kgs.</strong></div>
</fieldset>
<fieldset>
	<legend>Grasa Corporal</legend>
	<div class="lineal_eval"><label>% Grasa Corporal:</label><input type="text" size="5" name="grasa" value="<?php echo set_value('grasa',((isset($evaluacion))&&($evaluacion))?$evaluacion->grasa:'');?>" /><strong>%</strong></div>
	<fieldset>
		<legend>Pliegues<input type="button" value="+" onclick='$("#pliegues").toggle(200);' style="display: inline" /></legend>
		<div id="pliegues" style="display: none">
			<div class="lineal_eval"><label>P. Biciptal:</label><input type="text" size="6" name="p_biciptal" value="<?php echo set_value('p_biciptal',((isset($evaluacion))&&($evaluacion))?$evaluacion->p_biciptal:'');?>" /><strong>mm.</strong></div>
			<div class="lineal_eval"><label>P. Triciptal:</label><input type="text" size="6" name="p_triciptal" value="<?php echo set_value('p_triciptal',((isset($evaluacion))&&($evaluacion))?$evaluacion->p_triciptal:'');?>" /><strong>mm.</strong></div>
			<div class="lineal_eval"><label>P. Subescapular:</label><input type="text" size="6" name="p_subescapular" value="<?php echo set_value('p_subescapular',((isset($evaluacion))&&($evaluacion))?$evaluacion->p_subescapular:'');?>" /><strong>mm.</strong></div>
			<div class="lineal_eval"><label>P. Suprailiaco:</label><input type="text" size="6" name="p_suprailiaco" value="<?php echo set_value('p_suprailiaco',((isset($evaluacion))&&($evaluacion))?$evaluacion->p_suprailiaco:'');?>" /><strong>mm.</strong></div>
		</div>
	</fieldset>
	<div class="columnader">
		<input type="button" value="Llenar ficha tanita" onclick="$('#tanita').toggle(200);"/>
	</div>
</fieldset>
<?php if(!isset($embarazo)){?>
<fieldset>
	<legend>Per&iacute;metros y Circunferencias</legend>
	<div class="lineal_eval"><label>Circ. Cintura:</label><input type="text" size="6" name="c_cintura" value="<?php echo set_value('c_cintura',((isset($evaluacion))&&($evaluacion))?$evaluacion->c_cintura:'');?>" /><strong>cms.</strong></div>
	<div class="lineal_eval"><label>Circ. Cadera:</label><input type="text" size="6" name="c_cadera" value="<?php echo set_value('c_cadera',((isset($evaluacion))&&($evaluacion))?$evaluacion->c_cadera:'');?>" /><strong>cms.</strong></div>
	<div class="lineal_eval"><label>Circ. Mu&ntilde;eca:</label><input type="text" size="5" name="c_muneca" value="<?php echo set_value('c_muneca',((isset($evaluacion))&&($evaluacion))?$evaluacion->c_muneca:'');?>" /><strong>cms.</strong></div>
</fieldset>
<?php }?>
<?php if($mujer){?>
<fieldset>
	<legend>Datos Embarazo</legend>
	<div class="lineal">
		<div class="lineal_eval"><label>Embarazo:</label></div>
		<label>Si</label><input type="radio" name="embarazo" value="Si" onclick='$("#ocultar").css("display","block");' <?php echo set_checkbox('embarazo','Si',isset($embarazo));?> />
		<label>No</label><input type="radio" name="embarazo" value="No" onclick='$("#ocultar").css("display","none");' <?php echo set_checkbox('embarazo','No',!isset($embarazo));?> />
	</div>
	<div id="ocultar" <?php echo (isset($embarazo))?'':'style="display: none;"'?>>
		<div class="lineal_eval">
			<label>Peso previo a la gestaci&oacute;n:</label>
			<?php if(isset($embarazo)){?>
					<input type="text" size="6" value="<?php echo $embarazo->peso_pre_gesta;?>" disabled="disabled" /><strong>kgs.</strong>
					<input type="hidden" name="peso_pre_gesta" value="<?php echo $embarazo->peso_pre_gesta;?>" />
			<?php }else{?>
					<input type="text" size="6" name="peso_pre_gesta" value="<?php echo set_value('peso_pre_gesta');?>" /><strong>kgs.</strong>
			<?php }?>
		</div>
		<div class="lineal_eval">
			<label>Semanas de Embarazo:</label>
			<?php if(isset($embarazo)){?>
					<?php
						$aux_semana_ini = DateTime::createFromFormat('Y-m-d',$embarazo->fecha);
						$aux_intervalo = date_diff($aux_semana_ini,DateTime::createFromFormat('Y-m-d',$evaluacion->fecha));
						$aux_semana_gesta = ($embarazo->semana_gesta)?$embarazo->semana_gesta:0;
						$aux_semana_gesta = $aux_semana_gesta+($aux_intervalo->days/7);
						$aux_semana_gesta = round($aux_semana_gesta,2);
					?>
					<input type="text" size="2" value="<?php echo $aux_semana_gesta;?>" disabled="disabled" /><strong>semanas</strong>
					<input type="hidden" name="semana_gesta" value="<?php echo $aux_semana_gesta;?>" />
			<?php }else{?>
					<input type="text" size="2" name="semana_gesta" value="<?php echo set_value('semana_gesta');?>" /><strong>semanas.</strong>
			<?php }?>
		</div>
		<div class="lineal_eval">
			<label>Fondo uterino:</label>
			<?php if(isset($embarazo)){?>
					<input type="text" size="5"  name="fondo_uterino"  onchange='calcula()' value="<?php echo set_value('fondo_uterino',$evaluacion->fondo_uterino);?>" /><strong>cms.</strong>
			<?php }else{?>
					<input type="text" size="5"  name="fondo_uterino"  onchange='calcula()' value="<?php echo set_value('fondo_uterino');?>"/><strong>cms.</strong>
			<?php }?>
		</div>
		<fieldset>
			<legend>Edad gestacional</legend>
			<div class="lineal_eval" 
				<label>F&oacute;rmula de ALFEHLD: </label>
				<input type="text" disabled="true" size="5" name="meses_gesta" /><strong>meses</strong>
			</div>
			<div class="lineal_eval" 
				<label>M&eacute;todo de McDonald: </label>
				<input type="text" disabled="true" size="5" name="semanas_gesta" /><strong>semanas</strong>
			</div>
		</fieldset>
		
	</div>	
</fieldset>
<?php }else{?>
		<input type="hidden" name="embarazo" value="No" />
<?php }?>

