<fieldset>
	<legend>Resultados de Laboratorios</legend>
	<div class="lineal">
		<label>¿Desea capturar ahora los resultados del laboratorio?</label>
		<input type="radio" name="lab_res" id="lab_res_si" value="Si" onclick="$('#laboratorio_resultados').css('display','block')" <?php echo set_radio('lab_res','Si');?> /><label>Si</label>
		<input type="radio" name="lab_res" id="lab_res_no" value="No" onclick="$('#lab_sol_si').attr('checked',true);$('#laboratorio_resultados').css('display','none');$('#laboratorio_solicitud').css('display','block')" <?php echo set_radio('lab_res','No');?> /><label>No</label>
		<?php echo form_error('lab_res');?>
	</div>
<div id="laboratorio_resultados" style="<?php echo (set_radio('lab_res','Si'))?'':'display:none';?>">
	<div class="lineal">
		<label>Fecha de realizaci&oacute;n de laboratorios:</label>
		<input type="text" class="date_fecha" name="fecha_laboratorio" value="<?php echo set_value('fecha_laboratorio');?>" />
		<?php echo form_error('fecha_laboratorio');?>
	</div> 
	<?php $i = 0;$num = sizeof($laboratorios);?>
	<?php foreach($laboratorios as $lab){?>
			<?php if($i==0){$flag=TRUE;?>
					<div class="columnaizq">
			<?php }elseif($i==$num/2){$flag=TRUE;?>
					<div class="columnader">
			<?php }?>
			<?php if($lab->id=='otros'){?>
		<div id="otros_res">
			<span class="lineal">
			<label>Otros</label>
			<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios_res[]" value="otros" <?php echo set_checkbox('laboratorios_res','otros');?> onclick='$("#otrosr").toggle(200);' />
			</span>
			<div id="otrosr" <?php echo set_checkbox('laboratorios_res','otros')?'':'style="display:none"';?> >
				<?php $num = (isset($res_otro_nombre)&&($res_otro_nombre))?sizeof($res_otro_nombre):0;?>
				<?php if($num==0){?>
				<div id="otror_0" class="lineal">
						<input type="text"  name="otrores[]" /> 
							<input id="osn_0" type="radio" name="status_0" value="Normal" onclick="$('#especifico_0').css('display','none')" <?php echo set_radio('status_0','Normal');?> /><label>Normal</label>
							<input id="osa_0" type="radio" name="status_0" value="Alterado" onclick="$('#especifico_0').css('display','block')" <?php echo set_radio('status_0','Alterado');?> /><label>Alterado</label>
						<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
					<div id="especifico_0" <?php echo set_radio('status_0','Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="otros[]" style="display:block"><?php echo set_value('otros');?></textarea></div>		
				</div>
				<?php }else{for($i=0;$i<$num;$i++){?>
				<div id="otror_<?php echo $i;?>" class="lineal">
						<input type="text"  name="otrores[]" value="<?php echo $res_otro_nombre[$i];?>" /> 
							<input id="osn_<?php echo $i;?>" type="radio" name="status_<?php echo $i;?>" value="Normal" onclick="$('#especifico_<?php echo $i;?>').css('display','none')" <?php echo set_radio('status_'.$i,'Normal');?> /><label>Normal</label>
							<input id="osa_<?php echo $i;?>" type="radio" name="status_<?php echo $i;?>" value="Alterado" onclick="$('#especifico_<?php echo $i;?>').css('display','block')" <?php echo set_radio('status_'.$i,'Alterado');?> /><label>Alterado</label>
						<input id="<?php echo $i;?>" type="button" <?php echo ($i+1<$num)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
					<div id="especifico_<?php echo $i;?>" <?php echo set_radio('status_'.$i,'Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="otros[]" style="display:block"><?php echo $res_otro_nota[$i];?></textarea></div>		
				</div>	
				<?php }}?>
				
			</div>
		</div>
			<?php }else{?>
			<div id="<?php echo $lab->id;?>_res">
				<span class="lineal">
				<label><?php echo $lab->nombre;?></label>
				<input type="checkbox" style="margin:0.2em;margin-bottom:0.5em;margin-top:0.5em;" name="laboratorios_res[]" value="<?php echo $lab->id;?>" <?php echo set_checkbox('laboratorios_res',$lab->id);?> onclick='$("#<?php echo $lab->id;?>").toggle(200);' />
				<div id="<?php echo $lab->id;?>" <?php echo (set_checkbox('laboratorios_res',$lab->id))?'':'style="display:none"';?> > 
					<input type="radio" name="<?php echo $lab->id;?>_status" value="Normal" onclick="$('#<?php echo $lab->id;?>_desc').css('display','none')" <?php echo set_radio($lab->id.'_status','Normal');?> /><label>Normal</label> 
					<input type="radio" name="<?php echo $lab->id;?>_status" value="Alterado" onclick="$('#<?php echo $lab->id;?>_desc').css('display','block')"<?php echo set_radio($lab->id.'_status','Alterado');?> /><label>Alterado</label>
					<?php echo form_error($lab->id.'_status');?>
					<?php echo form_error($lab->id);?>
				</div>
				</span>
				<div id="<?php echo $lab->id;?>_desc" <?php echo set_radio($lab->id.'_status','Alterado')?'':'style="display: none"'?>><label>Describa el resultado:</label><textarea name="<?php echo $lab->id;?>" style="display:block"><?php echo set_value($lab->id);?></textarea></div>
			</div>
			<?php }?>
			<?php $i++;if($i==$num/2||$i==$num){$flag=FALSE;?>
				</div>
			<?php }?>	
	<?php }?>
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