<fieldset>
	<?php $num = (isset($alimento))?sizeof($alimento):0;//Obtenemos el valor de campos que agregamos?>
	<legend>Recordatorio de 24 horas</legend>
	<label>Narre lo que comi&oacute; el d&iacute;a anterior(si fue ordinario)</label>
	<div id="recordatorio_0"  class="lineal">		
		<label>Tiempo:</label>
		<select name="tiempo[]">
			<option value="" <?php echo ((isset($tiempo))&&($tiempo[0]==""))?'selected="selected"':'';?>></option>
			<option value="des" <?php echo ((isset($tiempo))&&($tiempo[0]=="des"))?'selected="selected"':'';?>>Desayuno</option>
			<option value="co1" <?php echo ((isset($tiempo))&&($tiempo[0]=="co1"))?'selected="selected"':'';?>>Colaci&oacute;n Ma&ntilde;ana</option>
			<option value="com" <?php echo ((isset($tiempo))&&($tiempo[0]=="com"))?'selected="selected"':'';?>>Comida</option>
			<option value="co2" <?php echo ((isset($tiempo))&&($tiempo[0]=="co2"))?'selected="selected"':'';?>>Colaci&oacute;n Tarde</option>
			<option value="cen" <?php echo ((isset($tiempo))&&($tiempo[0]=="cen"))?'selected="selected"':'';?>>Cena</option>
		</select>
		<label>Alimento:</label>
		<input type="text" name="alimento[]" value="<?php echo (isset($alimento))?''.$alimento[0].'':'';?>" />
		<label>Cantidad:</label>
		<input type="text" name="cantidad[]" size="5" value="<?php echo (isset($cantidad))?''.$cantidad[0].'':'';?>" />
		<label>Unidad:</label>
		<select name="unidad[]">
			<option value="piezas"<?php echo ((isset($unidad))&&($unidad[0]=="piezas"))?'selected="selected"':'';?>>Piezas</option>
			<option value="porciones"<?php echo ((isset($unidad))&&($unidad[0]=="porciones"))?'selected="selected"':'';?>>Porciones</option>
			<option value="gramos"<?php echo ((isset($unidad))&&($unidad[0]=="gramos"))?'selected="selected"':'';?>>Gramos</option>
			<option value="tazas"<?php echo ((isset($unidad))&&($unidad[0]=="tazas"))?'selected="selected"':'';?>>Tazas</option>
			<option value="cda"<?php echo ((isset($unidad))&&($unidad[0]=="cda"))?'selected="selected"':'';?>>Cda.</option>
			<option value="cdita"<?php echo ((isset($unidad))&&($unidad[0]=="cdita"))?'selected="selected"':'';?>>Cdita.</option>
		</select>
		<label>Kcal.:</label>
		<input type="text" name="calorias[]" value="<?php echo (isset($calorias))?''.$calorias[0].'':'';?>" size="3" />
		<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />		
	</div>
	<?php
		for ($i=1;$i < $num; $i++){?>
			<div id="recordatorio_<?php echo $i;?>" class="lineal">
				<label>Tiempo:</label>
				<select name="tiempo[]">
					<option value="des"<?php echo ((isset($tiempo))&&($tiempo[$i]=="des"))?'selected="selected"':'';?>>Desayuno</option>
					<option value="co1"<?php echo ((isset($tiempo))&&($tiempo[$i]=="co1"))?'selected="selected"':'';?>>Colaci&oacute;n Ma&ntilde;ana</option>
					<option value="com"<?php echo ((isset($tiempo))&&($tiempo[$i]=="com"))?'selected="selected"':'';?>>Comida</option>
					<option value="co2"<?php echo ((isset($tiempo))&&($tiempo[$i]=="co2"))?'selected="selected"':'';?>>Colaci&oacute;n Tarde</option>
					<option value="cen"<?php echo ((isset($tiempo))&&($tiempo[$i]=="cen"))?'selected="selected"':'';?>>Cena</option>
				</select>
				<label>Alimento:</label><input type="text" name="alimento[]" value="<?php echo (isset($alimento))?''.$alimento[$i].'':'';?>" />
				<label>Cantidad:</label><input type="text" name="cantidad[]" size="5" value="<?php echo (isset($cantidad))?''.$cantidad[$i].'':'';?>" />
				<label>Unidad:</label>
				<select name="unidad[]">
					<option value="piezas"<?php echo ((isset($unidad))&&($unidad[$i]=="piezas"))?'selected="selected"':'';?>>Piezas</option>
					<option value="porciones"<?php echo ((isset($unidad))&&($unidad[$i]=="porciones"))?'selected="selected"':'';?>>Porciones</option>
					<option value="gramos"<?php echo ((isset($unidad))&&($unidad[$i]=="gramos"))?'selected="selected"':'';?>>Gramos</option>
					<option value="tazas"<?php echo ((isset($unidad))&&($unidad[$i]=="tazas"))?'selected="selected"':'';?>>Tazas</option>
					<option value="cda"<?php echo ((isset($unidad))&&($unidad[$i]=="cda"))?'selected="selected"':'';?>>Cda.</option>
					<option value="cdita"<?php echo ((isset($unidad))&&($unidad[$i]=="cdita"))?'selected="selected"':'';?>>Cdita.</option>
				</select>
				<label>Kcal.:</label><input type="text" name="calorias[]" value="<?php echo (isset($calorias))?''.$calorias[$i].'':'';?>" size="3" />
				<?php if(($i+1)<$num){//Comprobamos que no sea el ultimo alimento capturado?>
					<input id="<?php echo $i;?>" type="button" value="-" class="bt_menos" />	
				<?php }else{//Si es el ultimo alimento capturado, cambiamos el boton para agregar mas?>
					<input id="<?php echo $i;?>" type="button" value="+" class="bt_mas" />
				<?php }?>
			</div>
		<?php }?>
		<div class="lineal" style="float: right">
			<label>Total Kcal.:</label><input type="text" name="total" size="15" value="<?php echo set_value('total') ?>"/>
		</div>
</fieldset>
<?php echo form_error('tiempo');?>
<?php echo form_error('alimento');?>
<?php echo form_error('cantidad');?>
<?php echo form_error('calorias');?>