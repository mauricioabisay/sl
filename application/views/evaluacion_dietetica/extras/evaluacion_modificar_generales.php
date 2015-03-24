<fieldset>
	<legend>Preguntas generales</legend>
	<div class="lineal">
		<label>&iquest;Qu&eacute; expectativa de evoluci&oacute;n tiene?</label>
		<input type="radio" name="evolucion" value="Rapida" <?php echo set_radio('evolucion','Rapida',((isset($evaluacion))&&($evaluacion->evolucion=="Rapida"))?TRUE:FALSE);?>/>
		<label>R&aacute;pida</label>
		<input type="radio" name="evolucion" value="Moderada" <?php echo set_radio('evolucion','Moderada',((isset($evaluacion))&&($evaluacion->evolucion=="Moderada"))?TRUE:FALSE);?>/>
		<label>Moderada</label>
		<input type="radio" name="evolucion" value="Lenta" <?php echo set_radio('evolucion','Lenta',((isset($evaluacion))&&($evaluacion->evolucion=="Lenta"))?TRUE:FALSE);?>/>
		<label>Lenta</label>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 el nivel de desgaste o irritabilidad que le genera el tema</label>
		<select name="desgaste">
			<option value="1" <?php echo set_select('desgaste','1',((isset($evaluacion))&&($evaluacion->desgaste=='1'))?TRUE:FALSE);?>>1</option>
			<option value="2" <?php echo set_select('desgaste','2',((isset($evaluacion))&&($evaluacion->desgaste=='2'))?TRUE:FALSE);?>>2</option>
			<option value="3" <?php echo set_select('desgaste','3',((isset($evaluacion))&&($evaluacion->desgaste=='3'))?TRUE:FALSE);?>>3</option>
			<option value="4" <?php echo set_select('desgaste','4',((isset($evaluacion))&&($evaluacion->desgaste=='4'))?TRUE:FALSE);?>>4</option>
			<option value="5" <?php echo set_select('desgaste','5',((isset($evaluacion))&&($evaluacion->desgaste=='5'))?TRUE:FALSE);?>>5</option>
			<option value="6" <?php echo set_select('desgaste','6',((isset($evaluacion))&&($evaluacion->desgaste=='6'))?TRUE:FALSE);?>>6</option>
			<option value="7" <?php echo set_select('desgaste','7',((isset($evaluacion))&&($evaluacion->desgaste=='7'))?TRUE:FALSE);?>>7</option>
			<option value="8" <?php echo set_select('desgaste','8',((isset($evaluacion))&&($evaluacion->desgaste=='8'))?TRUE:FALSE);?>>8</option>
			<option value="9" <?php echo set_select('desgaste','9',((isset($evaluacion))&&($evaluacion->desgaste=='9'))?TRUE:FALSE);?>>9</option>
			<option value="10" <?php echo set_select('desgaste','10',((isset($evaluacion))&&($evaluacion->desgaste=='10'))?TRUE:FALSE);?>>10</option>
		</select>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 la motivaci&oacute;n con la que llega</label>
		<select name="motivacion">
			<option value="1" <?php echo set_select('motivacion','1',((isset($evaluacion))&&($evaluacion->motivacion=='1'))?TRUE:FALSE);?>>1</option>
			<option value="2" <?php echo set_select('motivacion','2',((isset($evaluacion))&&($evaluacion->motivacion=='2'))?TRUE:FALSE);?>>2</option>
			<option value="3" <?php echo set_select('motivacion','3',((isset($evaluacion))&&($evaluacion->motivacion=='3'))?TRUE:FALSE);?>>3</option>
			<option value="4" <?php echo set_select('motivacion','4',((isset($evaluacion))&&($evaluacion->motivacion=='4'))?TRUE:FALSE);?>>4</option>
			<option value="5" <?php echo set_select('motivacion','5',((isset($evaluacion))&&($evaluacion->motivacion=='5'))?TRUE:FALSE);?>>5</option>
			<option value="6" <?php echo set_select('motivacion','6',((isset($evaluacion))&&($evaluacion->motivacion=='6'))?TRUE:FALSE);?>>6</option>
			<option value="7" <?php echo set_select('motivacion','7',((isset($evaluacion))&&($evaluacion->motivacion=='7'))?TRUE:FALSE);?>>7</option>
			<option value="8" <?php echo set_select('motivacion','8',((isset($evaluacion))&&($evaluacion->motivacion=='8'))?TRUE:FALSE);?>>8</option>
			<option value="9" <?php echo set_select('motivacion','9',((isset($evaluacion))&&($evaluacion->motivacion=='9'))?TRUE:FALSE);?>>9</option>
			<option value="10" <?php echo set_select('motivacion','10',((isset($evaluacion))&&($evaluacion->motivacion=='10'))?TRUE:FALSE);?>>10</option>
		</select>
	</div>
	<div class="lineal">
		<label>&iquest;Por qu&eacute;?</label>
		<input type="text" size="50" name="razon_motivacion" value="<?php echo set_value('razon_motivacion',(isset($evaluacion))?$evaluacion->razon_motivacion:'');?>" >
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 qu&eacute; tan capaz se cree usted de lograr los resultados</label>
		<select name="capacidad">
			<option value="" <?php echo set_select('capacidad','');?>></option>
			<option value="1" <?php echo set_select('capacidad','1',((isset($evaluacion))&&($evaluacion->capacidad=='1'))?TRUE:FALSE);?>>1</option>
			<option value="2" <?php echo set_select('capacidad','2',((isset($evaluacion))&&($evaluacion->capacidad=='2'))?TRUE:FALSE);?>>2</option>
			<option value="3" <?php echo set_select('capacidad','3',((isset($evaluacion))&&($evaluacion->capacidad=='3'))?TRUE:FALSE);?>>3</option>
			<option value="4" <?php echo set_select('capacidad','4',((isset($evaluacion))&&($evaluacion->capacidad=='4'))?TRUE:FALSE);?>>4</option>
			<option value="5" <?php echo set_select('capacidad','5',((isset($evaluacion))&&($evaluacion->capacidad=='5'))?TRUE:FALSE);?>>5</option>
			<option value="6" <?php echo set_select('capacidad','6',((isset($evaluacion))&&($evaluacion->capacidad=='6'))?TRUE:FALSE);?>>6</option>
			<option value="7" <?php echo set_select('capacidad','7',((isset($evaluacion))&&($evaluacion->capacidad=='7'))?TRUE:FALSE);?>>7</option>
			<option value="8" <?php echo set_select('capacidad','8',((isset($evaluacion))&&($evaluacion->capacidad=='8'))?TRUE:FALSE);?>>8</option>
			<option value="9" <?php echo set_select('capacidad','9',((isset($evaluacion))&&($evaluacion->capacidad=='9'))?TRUE:FALSE);?>>9</option>
			<option value="10" <?php echo set_select('capacidad','10',((isset($evaluacion))&&($evaluacion->capacidad=='10'))?TRUE:FALSE);?>>10</option>
		</select>
	</div>
</fieldset>
<?php echo form_error('evolucion');?>
<?php echo form_error('desgaste');?>
<?php echo form_error('motivacion');?>
<?php echo form_error('razon_motivacion');?>
<?php echo form_error('capacidad');?>