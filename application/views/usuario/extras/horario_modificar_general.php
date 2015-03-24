<fieldset id="horario_general" <?php echo (isset($usuario)&&$usuario->nombre_tipo=="Recepcionista")?'style="display:none"':'style="display:block"';?>>
	<legend>Horario de Atenci&oacute;n General</legend>
<?php if((isset($horario_general))&&($horario_general)){$num=sizeof($horario_general);$j=0;foreach($horario_general as $horario){?>
<div id="hg_<?php echo $j;?>" class="lineal">
	<label>H. Entrada:</label>
	<?php $aux_hora = DateTime::createFromFormat('H:i:s',$horario->hora_ini);?>
	<select name="h_entrada_general[]">
	<?php for($i=1;$i<13;$i++){?>
		<option value="<?php echo $i;?>" <?php echo ($aux_hora->format('g')==$i)?'selected="selected"':'';?>><?php echo ($i<10)?'0'.$i.'':$i;?></option>
	<?php }?>
	</select>
	<select name="m_entrada_general[]">
		<option <?php echo ($aux_hora->format('i')=="00")?'selected="selected"':'';?>>00</option>
		<option <?php echo ($aux_hora->format('i')=="30")?'selected="selected"':'';?>>30</option>
	</select>
	<select name="ampm_entrada_general[]">
		<option value="am" <?php echo ($aux_hora->format('a')=="am")?'selected="selected"':'';?>>a.m.</option>
		<option value="pm" <?php echo ($aux_hora->format('a')=="pm")?'selected="selected"':'';?>>p.m.</option>
	</select>
	<label>H. Salida:</label>
	<?php $aux_hora = DateTime::createFromFormat('H:i:s',$horario->hora_fin);?>
	<select name="h_salida_general[]">
	<?php for($i=1;$i<13;$i++){?>
		<option value="<?php echo $i;?>" <?php echo ($aux_hora->format('g')==$i)?'selected="selected"':'';?>><?php echo ($i<10)?'0'.$i.'':$i;?></option>
	<?php }?>
	</select>
	<select name="m_salida_general[]">
		<option <?php echo ($aux_hora->format('i')=="00")?'selected="selected"':'';?>>00</option>
		<option <?php echo ($aux_hora->format('i')=="30")?'selected="selected"':'';?>>30</option>
	</select>
	<select name="ampm_salida_general[]">
		<option value="am" <?php echo ($aux_hora->format('a')=="am")?'selected="selected"':'';?>>a.m.</option>
		<option value="pm" <?php echo ($aux_hora->format('a')=="pm")?'selected="selected"':'';?>>p.m.</option>
	</select>
	<input type="checkbox" name="lun_g[<?php echo $j;?>]" value="Lun" <?php echo (strstr($horario->dias,'Lun'))?'checked="checked"':''?>><label>Lunes</label>
	<input type="checkbox" name="mar_g[<?php echo $j;?>]" value="Mar" <?php echo (strstr($horario->dias,'Mar'))?'checked="checked"':''?>><label>Martes</label>
	<input type="checkbox" name="mie_g[<?php echo $j;?>]" value="Mie" <?php echo (strstr($horario->dias,'Mie'))?'checked="checked"':''?>><label>Mi&eacute;rcoles</label>
	<input type="checkbox" name="jue_g[<?php echo $j;?>]" value="Jue" <?php echo (strstr($horario->dias,'Jue'))?'checked="checked"':''?>><label>Jueves</label>
	<input type="checkbox" name="vie_g[<?php echo $j;?>]" value="Vie" <?php echo (strstr($horario->dias,'Vie'))?'checked="checked"':''?>><label>Viernes</label>
	<input type="checkbox" name="sab_g[<?php echo $j;?>]" value="Sab" <?php echo (strstr($horario->dias,'Sab'))?'checked="checked"':''?>><label>S&aacute;bado</label>
	<input type="checkbox" name="dom_g[<?php echo $j;?>]" value="Dom" <?php echo (strstr($horario->dias,'Dom'))?'checked="checked"':''?>><label>Domingo</label>
	<?php if($j+1>=$num){?>
		<input type="button" id="<?php echo $j;?>" class="bt_mas" value="+"/>	
	<?php }?>
	<?php $j++;?>
</div>
<input type="hidden" name="h_id_general[<?php echo ($j-1);?>]" value="<?php echo $horario->id;?>" /> 
<?php }}else{?>
<div id="hg_0" class="lineal">
	<label>H. Entrada:</label>
	<select name="h_entrada_general[]">
	<?php for($i=1;$i<13;$i++){?>
		<option value="<?php echo $i;?>"><?php echo ($i<10)?'0'.$i.'':$i;?></option>
	<?php }?>
	</select>
	<select name="m_entrada_general[]">
		<option>00</option>
		<option>30</option>
	</select>
	<select name="ampm_entrada_general[]">
		<option value="am">a.m.</option>
		<option value="pm">p.m.</option>
	</select>
	<label>H. Salida:</label>
	<select name="h_salida_general[]">
	<?php for($i=1;$i<13;$i++){?>
		<option value="<?php echo $i;?>"><?php echo ($i<10)?'0'.$i.'':$i;?></option>
	<?php }?>
	</select>
	<select name="m_salida_general[]">
		<option>00</option>
		<option>30</option>
	</select>
	<select name="ampm_salida_general[]">
		<option value="am">a.m.</option>
		<option value="pm">p.m.</option>
	</select>
	<input type="checkbox" name="lun_g[0]" value="Lun"><label>Lunes</label>
	<input type="checkbox" name="mar_g[0]" value="Mar"><label>Martes</label>
	<input type="checkbox" name="mie_g[0]" value="Mie"><label>Mi&eacute;rcoles</label>
	<input type="checkbox" name="jue_g[0]" value="Jue"><label>Jueves</label>
	<input type="checkbox" name="vie_g[0]" value="Vie"><label>Viernes</label>
	<input type="checkbox" name="sab_g[0]" value="Sab"><label>S&aacute;bado</label>
	<input type="checkbox" name="dom_g[0]" value="Dom"><label>Domingo</label>
	<input type="button" id="0" class="bt_mas" value="+"/>
</div>
<?php }?>
</fieldset>