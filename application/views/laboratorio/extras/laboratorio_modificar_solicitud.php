<fieldset>
	<legend>Solicitud de Laboratorios</legend>
	<div class="lineal">
		<label>¿Desea capturar ahora la solicitud de laboratorio?</label>
		<input type="radio" name="lab_sol" id="lab_sol_si" value="Si" onclick="$('#laboratorio_solicitud').css('display','block')" <?php echo set_radio('lab_sol','Si',(isset($fecha_solicitud)&&($fecha_solicitud))?TRUE:FALSE);?> /><label>Si</label>
		<input type="radio" name="lab_sol" id="lab_sol_no" value="No" onclick="$('#lab_res_si').attr('checked',true);$('#laboratorio_solicitud').css('display','none');$('#laboratorio_resultados').css('display','block')" <?php echo set_radio('lab_sol','No',(isset($fecha_solicitud)&&($fecha_solicitud))?FALSE:TRUE);?> /><label>No</label>
		<?php echo form_error('lab_sol');?>
	</div>
<div id="laboratorio_solicitud" style="<?php echo ((set_radio('lab_sol','Si'))||(isset($fecha_solicitud)&&($fecha_solicitud)))?'':'display:none';?>">
	<div class="lineal">
		<label>&iquest;Tiene s&iacute;ntomas de debilidad, fatiga, angustia,
			cansancio, mareo, necesidad de consumir az&uacute;car,
			visi&oacute;n borrosa?</label>
		<label>S&iacute;</label><input type="radio" name="sintomas" value="Si" onclick='$("#ocultar_sintomas").toggle(200)' <?php echo set_radio('sintomas','Si',(isset($laboratorio)&&($laboratorio->sintomas>0))?TRUE:FALSE);?>/>
		<label>No</label><input type="radio" name="sintomas" value="No" onclick='$("#ocultar_sintomas").toggle(!200)' <?php echo set_radio('sintomas','No',(isset($laboratorio)&&($laboratorio->sintomas==0))?TRUE:FALSE);?>/>
		<?php echo form_error('sintomas');?>
	</div>
	<div class="lineal" id="ocultar_sintomas" <?php echo ($this->input->post('sintomas')&&($this->input->post('sintomas')=='Si'))||(isset($laboratorio)&&($laboratorio->sintomas>0))?'':'style="display:none"';?>>
		<label>&iquest;Cu&aacute;ntos s&iacute;ntomas?</label>
		<select name="cuantos_sintomas">
			<option <?php echo set_select('cuantos_sintomas','');?> value=""></option>
			<option <?php echo set_select('cuantos_sintomas','1',(isset($laboratorio)&&($laboratorio->sintomas==1))?TRUE:FALSE);?> value="1">1</option>
			<option <?php echo set_select('cuantos_sintomas','2',(isset($laboratorio)&&($laboratorio->sintomas==2))?TRUE:FALSE);?> value="2">2</option>
			<option <?php echo set_select('cuantos_sintomas','3',(isset($laboratorio)&&($laboratorio->sintomas==3))?TRUE:FALSE);?> value="3">3</option>
			<option <?php echo set_select('cuantos_sintomas','4',(isset($laboratorio)&&($laboratorio->sintomas==4))?TRUE:FALSE);?> value="4">4</option>
			<option <?php echo set_select('cuantos_sintomas','5',(isset($laboratorio)&&($laboratorio->sintomas==5))?TRUE:FALSE);?> value="5">5</option>
			<option <?php echo set_select('cuantos_sintomas','6',(isset($laboratorio)&&($laboratorio->sintomas==6))?TRUE:FALSE);?> value="6">6</option>
			<option <?php echo set_select('cuantos_sintomas','7',(isset($laboratorio)&&($laboratorio->sintomas==7))?TRUE:FALSE);?> value="7">7</option>
		</select>
		<?php echo form_error('cuantos_sintomas');?>
	</div>
	<label>Especifique los estudios a realizar:<?php echo form_error('laboratorios');?></label>
	<?php $i = 0;$num = sizeof($laboratorios);?>
	<?php foreach($laboratorios as $lab){?>
			<?php if($i==0){$flag=TRUE;?>
					<div class="columnaizq" style="width: 50%;float: left">
			<?php }elseif($i==$num/2){$flag=TRUE;?>
					<div class="columnader" style="width: 50%;float: left">
			<?php }?>
			<?php if($lab->id=='otros'){?>
		<div class="lineal_eval">
			<label style="width:85%">Otros</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="otros" <?php echo set_checkbox('laboratorios','otros',(isset($laboratorio)&&(stristr($laboratorio->especificacion,'otros')))?TRUE:FALSE);?> onchange="if($(this).is(':checked')){$('#otrosr_chk').attr('checked','true');}else{$('#otrosr_chk').attr('checked','false');}$('#otro').toggle(200);$('#otrosr').toggle(200);" />
			<?php $num = (isset($sol_otro)&&($sol_otro))?sizeof($sol_otro):0;?>
			<div id="otro" style="<?php echo (set_checkbox('laboratorios','otros'))||(isset($laboratorio)&&(stristr($laboratorio->especificacion,'otros')))?'':'display:none;';?>float:right">
			<?php if($num==0){?>			
				<div id="otro_0" class="lineal">
					<input type="text"  name="otro[]" />
					<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
				</div>
			<?php }else{for($i=0;$i<$num;$i++){?>
				<div id="otro_<?php echo $i;?>" class="lineal">
					<input type="text"  name="otro[]" value="<?php echo $sol_otro[$i];?>" />
					<input id="0" type="button" <?php echo ($i+1<$num)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
				</div>
			<?php }}?>
			</div>
		</div>
			<?php }else{?>
			<div class="lineal_eval">
				<label style="width:85%"><?php echo $lab->nombre?></label>
				<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="<?php echo $lab->id;?>" <?php echo set_checkbox('laboratorios',$lab->id,(isset($laboratorio)&&(stristr($laboratorio->especificacion,$lab->id)))?TRUE:FALSE);?> onchange="$('#<?php echo $lab->id;?>').toggle(200);if($(this).is(':checked')){$('#<?php echo $lab->id;?>_chk').attr('checked','true');}else{$('#<?php echo $lab->id;?>_chk').attr('checked','false');}" />
			</div>
			<?php }?>
			<?php $i++;if($i==$num/2||$i==$num){$flag=FALSE;?>
				</div>
			<?php }?>	
	<?php }?>
</div>
</fieldset>
