<fieldset>
	<legend>Historial de Peso</legend>
<!--Inicia Seccion de Pesos-->
	<fieldset>
	<legend>Peso M&aacute;ximo</legend>
	<div class="lineal">
		<label>1. &iquest;Cu&aacute;l es el peso m&aacute;ximo que ha alcanzado? </label>
		<input type="text" size="4" name="peso_max" value="<?php echo set_value('peso_max',(isset($historial))?$historial->peso_max:'')?>" />Kg.
		<?php echo form_error('peso_max');?>
	</div>
	<div class="lineal">
		<label> 2. &iquest;En qu&eacute; fecha?</label>
		<?php $aux_fecha_peso_max = isset($historial)?DateTime::createFromFormat('Y-m-d',$historial->peso_max_fecha):FALSE;?>
		<label>Mes</label>
		<select name="peso_max_m">
			<option value="" <?php echo set_select('peso_max_m','');?>></option>
			<option value="01" <?php echo set_select('peso_max_m','01',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='01'))?TRUE:FALSE);?>>Enero</option>
			<option value="02" <?php echo set_select('peso_max_m','02',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='02'))?TRUE:FALSE);?>>Febrero</option>
			<option value="03" <?php echo set_select('peso_max_m','03',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='03'))?TRUE:FALSE);?>>Marzo</option>
			<option value="04" <?php echo set_select('peso_max_m','04',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='04'))?TRUE:FALSE);?>>Abril</option>
			<option value="05" <?php echo set_select('peso_max_m','05',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='05'))?TRUE:FALSE);?>>Mayo</option>
			<option value="06" <?php echo set_select('peso_max_m','06',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='06'))?TRUE:FALSE);?>>Junio</option>
			<option value="07" <?php echo set_select('peso_max_m','07',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='07'))?TRUE:FALSE);?>>Julio</option>
			<option value="08" <?php echo set_select('peso_max_m','08',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='08'))?TRUE:FALSE);?>>Agosto</option>
			<option value="09" <?php echo set_select('peso_max_m','09',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='09'))?TRUE:FALSE);?>>Septiembre</option>
			<option value="10" <?php echo set_select('peso_max_m','10',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='10'))?TRUE:FALSE);?>>Octubre</option>
			<option value="11" <?php echo set_select('peso_max_m','11',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='11'))?TRUE:FALSE);?>>Noviembre</option>
			<option value="12" <?php echo set_select('peso_max_m','12',(($aux_fecha_peso_max)&&($aux_fecha_peso_max->format('m')=='12'))?TRUE:FALSE);?>>Diciembre</option>
		</select><?php echo form_error('peso_max_m');?>
		<label>A&ntilde;o</label>
		<input type="text" size="5" name="peso_max_a" value="<?php echo set_value('peso_max_a',($aux_fecha_peso_max)?$aux_fecha_peso_max->format('Y'):'');?>"/>
		<?php echo form_error('peso_max_a');?>
	</div>
	</fieldset>
	<fieldset>
	<legend>Peso M&iacute;nimo</legend>
	<div class="lineal">
		<label>  3. &iquest;Cu&aacute;l es el m&iacute;nimo de peso que ha alcanzado?</label>
		<input type="text" size="4" name="peso_min" value="<?php echo set_value('peso_min',(isset($historial))?$historial->peso_min:'');?>"/>Kg.
		<?php echo form_error('peso_min');?>
	</div>
	<div class="lineal">
		<label> 4. &iquest;En qu&eacute; fecha?</label>
		<?php $aux_fecha_peso_min = isset($historial)?DateTime::createFromFormat('Y-m-d',$historial->peso_min_fecha):FALSE;?>
		<label>Mes</label>
		<select name="peso_min_m">
			<option value="" <?php echo set_select('peso_min_m','');?>></option>
			<option value="01" <?php echo set_select('peso_min_m','01',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='01'))?TRUE:FALSE);?>>Enero</option>
			<option value="02" <?php echo set_select('peso_min_m','02',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='02'))?TRUE:FALSE);?>>Febrero</option>
			<option value="03" <?php echo set_select('peso_min_m','03',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='03'))?TRUE:FALSE);?>>Marzo</option>
			<option value="04" <?php echo set_select('peso_min_m','04',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='04'))?TRUE:FALSE);?>>Abril</option>
			<option value="05" <?php echo set_select('peso_min_m','05',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='05'))?TRUE:FALSE);?>>Mayo</option>
			<option value="06" <?php echo set_select('peso_min_m','06',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='06'))?TRUE:FALSE);?>>Junio</option>
			<option value="07" <?php echo set_select('peso_min_m','07',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='07'))?TRUE:FALSE);?>>Julio</option>
			<option value="08" <?php echo set_select('peso_min_m','08',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='08'))?TRUE:FALSE);?>>Agosto</option>
			<option value="09" <?php echo set_select('peso_min_m','09',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='09'))?TRUE:FALSE);?>>Septiembre</option>
			<option value="10" <?php echo set_select('peso_min_m','10',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='10'))?TRUE:FALSE);?>>Octubre</option>
			<option value="11" <?php echo set_select('peso_min_m','11',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='11'))?TRUE:FALSE);?>>Noviembre</option>
			<option value="12" <?php echo set_select('peso_min_m','12',(($aux_fecha_peso_min)&&($aux_fecha_peso_min->format('m')=='12'))?TRUE:FALSE);?>>Diciembre</option>
		</select><?php echo form_error('peso_min_m');?>
		<label>A&ntilde;o</label>
		<input type="text" size="5" name="peso_min_a" value="<?php echo set_value('peso_min_a',($aux_fecha_peso_min)?$aux_fecha_peso_min->format('Y'):'');?>"/>
		<?php echo form_error('peso_min_a');?>	
	</div>
	</fieldset>
	<fieldset>
	<legend>Historial</legend>
	<label> 5. Describa su historia de peso en los &uacute;ltimos 6 meses</label>
	<textarea rows="3" cols="70" name="desc_hist"><?php echo set_value('desc_hist',(isset($historial))?$historial->desc_hist:''); ?></textarea><?php echo form_error('desc_hist');?>
<!--Fin Seccion de Pesos-->
<!--Inicia Seccion Medicamentos-->
	<div class="lineal">
		<label> 6. &iquest;Ha tomado medicamentos para bajar de peso? </label>
		<label>S&iacute;</label><input type="radio" name="medicamento" value="Si" onclick='$("#ocultar_med").toggle(200)' <?php echo set_radio('medicamento','Si',(isset($historial)&&($historial->medicamento=='Si'))?TRUE:FALSE);?>/>
		<label>No</label><input type="radio" name="medicamento"  value="No" onclick='$("#ocultar_med").toggle(!200)'  <?php echo set_radio('medicamento','No',(isset($historial)&&($historial->medicamento=='No'))?TRUE:FALSE);?>/>
		<?php echo form_error('medicamento');?>
	</div>
	<div id="ocultar_med" <?php echo ((($this->input->post('medicamento'))=='Si')||(isset($historial)&&($historial->medicamento=='Si')))?'':'style="display:none"'?>>
<!--Inicio Seccion Medicamentos-->
	<?php if(isset($medicamentos)&&$medicamentos){$i=0;$num=sizeof($medicamentos);//Hay Medicamentos en el Historial?>
		<?php foreach($medicamentos as $medicamento){?>
				<div id="medicamento_<?php echo $i;?>" class="lineal">
					<input type="hidden" name="medicamento_id[]" value="<?php echo $medicamento->id;?>" />
					<label>Nombre:</label>
					<input type="text" name="medicamento_nombre[]" size="10" value="<?php echo $medicamento->nombre;?>" />
					<?php $aux_fecha_medicamento = DateTime::createFromFormat('Y-m-d',$medicamento->fecha);?>
					<label>Fecha: Mes </label>
					<select name="medicamento_mes[]">
						<option value="1" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='1'))?'selected="selected"':'';?>>Enero</option>
						<option value="2" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='2'))?'selected="selected"':'';?>>Febrero</option>
						<option value="3" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='3'))?'selected="selected"':'';?>>Marzo</option>
						<option value="4" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='4'))?'selected="selected"':'';?>>Abril</option>
						<option value="5" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='5'))?'selected="selected"':'';?>>Mayo</option>
						<option value="6" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='6'))?'selected="selected"':'';?>>Junio</option>
						<option value="7" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='7'))?'selected="selected"':'';?>>Julio</option>
						<option value="8" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='8'))?'selected="selected"':'';?>>Agosto</option>
						<option value="9" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='9'))?'selected="selected"':'';?>>Septiembre</option>
						<option value="10" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='10'))?'selected="selected"':'';?>>Octubre</option>
						<option value="11" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='11'))?'selected="selected"':'';?>>Noviembre</option>
						<option value="12" <?php echo (($aux_fecha_medicamento)&&($aux_fecha_medicamento->format('m')=='12'))?'selected="selected"':'';?>>Diciembre</option>
					</select>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="medicamento_a[]" value="<?php echo $aux_fecha_medicamento->format('Y');?>"/>
					<label>Experiencia:</label>
					<textarea rows="2" cols="30" name="medicamento_exp[]"><?php echo $medicamento->experiencia;?></textarea>
					<?php if(!($i+1<$num)){?>
					<input id="<?php echo $i;?>" type="button" <?php echo ($i+1<$num)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />	
					<?php }?>
					
				</div>
		<?php $i++;}?>
	<?php }else{$num = (isset($medicamento_nombre))?sizeof($medicamento_nombre):0;//No hay Medicamentos en el Historial?>
		<div id="medicamento_0" class="lineal">
			<label>Nombre:</label>
			<input type="text" name="medicamento_nombre[]" size="10" value="<?php echo (isset($medicamento_nombre))?$medicamento_nombre[0]:'';?>" />
			<?php echo form_error('medicamento_nombre[0]');?>
			<label>Fecha: Mes </label>
			<select name="medicamento_mes[]">
				<option value="1" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==1))?'selected="selected"':'';?>>Enero</option>
				<option value="2" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==2))?'selected="selected"':'';?>>Febrero</option>
				<option value="3" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==3))?'selected="selected"':'';?>>Marzo</option>
				<option value="4" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==4))?'selected="selected"':'';?>>Abril</option>
				<option value="5" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==5))?'selected="selected"':'';?>>Mayo</option>
				<option value="6" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==6))?'selected="selected"':'';?>>Junio</option>
				<option value="7" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==7))?'selected="selected"':'';?>>Julio</option>
				<option value="8" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==8))?'selected="selected"':'';?>>Agosto</option>
				<option value="9" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==9))?'selected="selected"':'';?>>Septiembre</option>
				<option value="10" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==10))?'selected="selected"':'';?>>Octubre</option>
				<option value="11" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==11))?'selected="selected"':'';?>>Noviembre</option>
				<option value="12" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[0]==12))?'selected="selected"':'';?>>Diciembre</option>
			</select><?php echo form_error('medicamento_mes[0]');?>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="medicamento_a[]" value="<?php echo (isset($medicamento_a))?$medicamento_a[0]:'';?>"/>
			<?php echo form_error('medicamento_a[0]');?>
			<label>Experiencia:</label>
			<textarea rows="2" cols="30" name="medicamento_exp[]"><?php echo (isset($medicamento_exp))?$medicamento_exp[0]:'';?></textarea>
			<?php echo form_error('medicamento_exp[0]');?>
			<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
		</div>
		<?php for($i=1;$i<$num;$i++){?>
				<div id="medicamento_<?php echo $i;?>" class="lineal">
					<label>Nombre:</label>
					<input type="text" name="medicamento_nombre[]" size="10" value="<?php echo (isset($medicamento_nombre))?$medicamento_nombre[$i]:'';?>" />
					<?php echo form_error('medicamento_nombre['.$i.']');?>
					<label>Fecha: Mes </label>
					<select name="medicamento_mes[]">
						<option value="1" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==1))?'selected="selected"':'';?>>Enero</option>
						<option value="2" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==2))?'selected="selected"':'';?>>Febrero</option>
						<option value="3" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==3))?'selected="selected"':'';?>>Marzo</option>
						<option value="4" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==4))?'selected="selected"':'';?>>Abril</option>
						<option value="5" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==5))?'selected="selected"':'';?>>Mayo</option>
						<option value="6" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==6))?'selected="selected"':'';?>>Junio</option>
						<option value="7" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==7))?'selected="selected"':'';?>>Julio</option>
						<option value="8" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==8))?'selected="selected"':'';?>>Agosto</option>
						<option value="9" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==9))?'selected="selected"':'';?>>Septiembre</option>
						<option value="10" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==10))?'selected="selected"':'';?>>Octubre</option>
						<option value="11" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==11))?'selected="selected"':'';?>>Noviembre</option>
						<option value="12" <?php echo ((isset($medicamento_mes))&&($medicamento_mes[$i]==12))?'selected="selected"':'';?>>Diciembre</option>
					</select><?php echo form_error('medicamento_mes['.$i.']');?>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="medicamento_a[]" value="<?php echo (isset($medicamento_a))?$medicamento_a[$i]:'';?>"/>
					<?php echo form_error('medicamento_a['.$i.']');?>
					<label>Experiencia:</label>
					<textarea rows="2" cols="30" name="medicamento_exp[]"><?php echo (isset($medicamento_exp))?$medicamento_exp[$i]:'';?></textarea>
					<?php echo form_error('medicamento_exp['.$i.']');?>
					<input id="<?php echo $i;?>" type="button" <?php echo ($i+1<$num)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
				</div>
		<?php }?>
	<?php }?>
<!--Fin Seccion Medicamentos-->
	</div>
	
	<div class="lineal">
		<label>7. &iquest;Ha acudido a otros tratamientos? </label>
		<label>S&iacute;</label><input type="radio" name="tratamiento" value="Si" onclick='$("#ocultar_trat").toggle(200)' <?php echo set_radio('tratamiento','Si',(isset($historial)&&($historial->tratamiento=='Si'))?TRUE:FALSE);?>/>
		<label>No</label><input type="radio" name="tratamiento" value="No" onclick='$("#ocultar_trat").toggle(!200)'<?php echo set_radio('tratamiento','No',(isset($historial)&&($historial->tratamiento=='No'))?TRUE:FALSE);?>/>
		<?php echo form_error('tratamiento');?>
	</div>
	
	<fieldset>
	<legend>Tratamientos</legend>
		<div id="ocultar_trat" <?php echo (($this->input->post('tratamiento'))=='Si')||(isset($historial)&&($historial->tratamiento=='Si'))?'':'style="display:none"'?>>
		<label> 8. Narre los &uacute;ltimos 3 con fechas y resultados</label>
<!--Inicio Seccion Medicamentos-->
		<?php if(isset($tratamientos)&&($tratamientos)){$i=0;$num=sizeof($tratamientos);?>
				<?php foreach($tratamientos as $tratamiento){?>
				<div id="tratamiento_<?php echo $i;?>" class="lineal">
					<input type="hidden" name="tratamiento_id[]" value="<?php echo $tratamiento->id;?>" />
					<label>Nombre:</label>
					<input type="text" name="tratamiento_nombre[]" size="10" value="<?php echo $tratamiento->nombre;?>" />
					<?php $aux_fecha_tratamiento = DateTime::createFromFormat('Y-m-d',$tratamiento->fecha);?>
					<label>Fecha: Mes </label>
					<select name="tratamiento_mes[]">
						<option value="1" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='1')?'selected="selected"':'';?>>Enero</option>
						<option value="2" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='2')?'selected="selected"':'';?>>Febrero</option>
						<option value="3" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='3')?'selected="selected"':'';?>>Marzo</option>
						<option value="4" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='4')?'selected="selected"':'';?>>Abril</option>
						<option value="5" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='5')?'selected="selected"':'';?>>Mayo</option>
						<option value="6" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='6')?'selected="selected"':'';?>>Junio</option>
						<option value="7" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='7')?'selected="selected"':'';?>>Julio</option>
						<option value="8" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='8')?'selected="selected"':'';?>>Agosto</option>
						<option value="9" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='9')?'selected="selected"':'';?>>Septiembre</option>
						<option value="10" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='10')?'selected="selected"':'';?>>Octubre</option>
						<option value="11" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='11')?'selected="selected"':'';?>>Noviembre</option>
						<option value="12" <?php echo ($aux_fecha_tratamiento)&&($aux_fecha_tratamiento->format('m')=='12')?'selected="selected"':'';?>>Diciembre</option>
					</select>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="tratamiento_a[]" value="<?php echo $aux_fecha_tratamiento->format('Y');?>"/>
					<label>Experiencia:</label>
					<textarea rows="2" cols="30" name="tratamiento_res[]"><?php echo $tratamiento->resultado;?></textarea>
					<?php if(!($i+1<$num)){?>
					<input id="<?php echo $i;?>" type="button" <?php echo ($i+1<$num)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
					<?php }?>
				</div>
			<?php $i++;}?>
		<?php }else{$num = (isset($tratamiento_nombre))?sizeof($tratamiento_nombre):0;?>
		<div id="tratamiento_0" class="lineal">
			<label>Nombre:</label>
			<input type="text" name="tratamiento_nombre[]" size="10" value="<?php echo (isset($tratamiento_nombre))?$tratamiento_nombre[0]:'';?>" />
			<?php echo form_error('tratamiento_nombre[0]');?>
			<label>Fecha: Mes </label>
			<select name="tratamiento_mes[]">
				<option value="1" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==1))?'selected="selected"':'';?>>Enero</option>
				<option value="2" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==2))?'selected="selected"':'';?>>Febrero</option>
				<option value="3" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==3))?'selected="selected"':'';?>>Marzo</option>
				<option value="4" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==4))?'selected="selected"':'';?>>Abril</option>
				<option value="5" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==5))?'selected="selected"':'';?>>Mayo</option>
				<option value="6" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==6))?'selected="selected"':'';?>>Junio</option>
				<option value="7" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==7))?'selected="selected"':'';?>>Julio</option>
				<option value="8" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==8))?'selected="selected"':'';?>>Agosto</option>
				<option value="9" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==9))?'selected="selected"':'';?>>Septiembre</option>
				<option value="10" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==10))?'selected="selected"':'';?>>Octubre</option>
				<option value="11" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==11))?'selected="selected"':'';?>>Noviembre</option>
				<option value="12" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[0]==12))?'selected="selected"':'';?>>Diciembre</option>
			</select><?php echo form_error('tratamiento_mes[0]');?>
			<label>A&ntilde;o</label>
			<input type="text" size="5" name="tratamiento_a[]" value="<?php echo (isset($tratamiento_a))?$tratamiento_a[0]:'';?>"/>
			<?php echo form_error('tratamiento_a[0]');?>
			<label>Experiencia:</label>
			<textarea rows="2" cols="30" name="tratamiento_res[]"><?php echo (isset($tratamiento_res))?$tratamiento_res[0]:'';?></textarea>
			<?php echo form_error('tratamiento_res[0]');?>
			<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
		</div>
		<?php for($i=1;$i<$num;$i++){?>
				<div id="tratamiento_<?php echo $i;?>" class="lineal">
					<label>Nombre:</label>
					<input type="text" name="tratamiento_nombre[]" size="10" value="<?php echo (isset($tratamiento_nombre))?$tratamiento_nombre[$i]:'';?>" />
					<?php echo form_error('tratamiento_nombre['.$i.']');?>
					<label>Fecha: Mes </label>
					<select name="tratamiento_mes[]">
						<option value="1" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==1))?'selected="selected"':'';?>>Enero</option>
						<option value="2" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==2))?'selected="selected"':'';?>>Febrero</option>
						<option value="3" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==3))?'selected="selected"':'';?>>Marzo</option>
						<option value="4" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==4))?'selected="selected"':'';?>>Abril</option>
						<option value="5" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==5))?'selected="selected"':'';?>>Mayo</option>
						<option value="6" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==6))?'selected="selected"':'';?>>Junio</option>
						<option value="7" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==7))?'selected="selected"':'';?>>Julio</option>
						<option value="8" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==8))?'selected="selected"':'';?>>Agosto</option>
						<option value="9" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==9))?'selected="selected"':'';?>>Septiembre</option>
						<option value="10" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==10))?'selected="selected"':'';?>>Octubre</option>
						<option value="11" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==11))?'selected="selected"':'';?>>Noviembre</option>
						<option value="12" <?php echo ((isset($tratamiento_mes))&&($tratamiento_mes[$i]==12))?'selected="selected"':'';?>>Diciembre</option>
					</select><?php echo form_error('tratamiento_mes['.$i.']');?>
					<label>A&ntilde;o</label>
					<input type="text" size="5" name="tratamiento_a[]" value="<?php echo (isset($tratamiento_a))?$tratamiento_a[$i]:'';?>"/>
					<?php echo form_error('tratamiento_a['.$i.']');?>
					<label>Experiencia:</label>
					<textarea rows="2" cols="30" name="tratamiento_res[]"><?php echo (isset($tratamiento_res))?$tratamiento_res[$i]:'';?></textarea>
					<?php echo form_error('tratamiento_res['.$i.']');?>
					<input id="<?php echo $i;?>" type="button" <?php echo ($i+1<$num)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
				</div>
		<?php }?>
	<?php }?>
<!--Fin Seccion Tratamientos-->
	</div>
	</fieldset>
	</fieldset>
</fieldset>