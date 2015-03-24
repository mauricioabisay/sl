<fieldset>
	<legend>Solicitud de Laboratorios</legend>
	<div class="lineal">
		<label>¿Desea capturar ahora la solicitud de laboratorio?</label>
		<input type="radio" name="lab_sol" id="lab_sol_si" value="Si" onclick="$('#laboratorio_solicitud').css('display','block')" <?php echo set_radio('lab_sol','Si');?> /><label>Si</label>
		<input type="radio" name="lab_sol" id="lab_sol_no" value="No" onclick="$('#lab_res_si').attr('checked',true);$('#laboratorio_solicitud').css('display','none');$('#laboratorio_resultados').css('display','block')" <?php echo set_radio('lab_sol','No');?> /><label>No</label>
		<?php echo form_error('lab_sol');?>
	</div>
<div id="laboratorio_solicitud" style="<?php echo (set_radio('lab_sol','Si'))?'':'display:none';?>">
	<div class="lineal">
		<label>&iquest;Tiene s&iacute;ntomas de debilidad, fatiga, angustia,
			cansancio, mareo, necesidad de consumir az&uacute;car,
			visi&oacute;n borrosa?</label>
		<label>S&iacute;</label><input type="radio" name="sintomas" value="Si" onclick='$("#ocultar_sintomas").toggle(200)' <?php echo set_radio('sintomas','Si');?>/>
		<label>No</label><input type="radio" name="sintomas" value="No" onclick='$("#ocultar_sintomas").toggle(!200)' <?php echo set_radio('sintomas','No');?>/>
		<?php echo form_error('sintomas');?>
	</div>
	<div class="lineal" id="ocultar_sintomas" <?php echo ($this->input->post('sintomas')&&($this->input->post('sintomas')=='Si'))?'':'style="display:none"';?>>
		<label>&iquest;Cu&aacute;ntos s&iacute;ntomas?</label>
		<select name="cuantos_sintomas">
			<option <?php echo set_select('cuantos_sintomas','');?> value=""></option>
			<option <?php echo set_select('cuantos_sintomas','1');?> value="1">1</option>
			<option <?php echo set_select('cuantos_sintomas','2');?> value="2">2</option>
			<option <?php echo set_select('cuantos_sintomas','3');?> value="3">3</option>
			<option <?php echo set_select('cuantos_sintomas','4');?> value="4">4</option>
			<option <?php echo set_select('cuantos_sintomas','5');?> value="5">5</option>
			<option <?php echo set_select('cuantos_sintomas','6');?> value="6">6</option>
			<option <?php echo set_select('cuantos_sintomas','7');?> value="7">7</option>
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
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="otros" <?php echo set_checkbox('laboratorios','otros');?> onclick='$("#otro").toggle(100);' />
			<?php $num = (isset($sol_otro)&&($sol_otro))?sizeof($sol_otro):0;?>
			<div id="otro" style="<?php echo (set_checkbox('laboratorios','otros'))?'':'display:none;';?>float:right">
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
				<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios[]" value="<?php echo $lab->id;?>" <?php echo set_checkbox('laboratorios',$lab->id);?> />
			</div>
			<?php }?>
			<?php $i++;if($i==$num/2||$i==$num){$flag=FALSE;?>
				</div>
			<?php }?>	
	<?php }?>
</div>
</fieldset>