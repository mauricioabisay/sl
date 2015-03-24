<fieldset>
	<legend>Antecedentes Heredofamiliares</legend>
	<label>&iquest;Ha padecido alg&uacute;n familiar alguna de las siguientes enfermedades?</label>
	<div class="columnaizq">
	<table class="tabla_formulario">
		<tr>
			<th>Patolog&iacute;a</th><th>S&iacute;</th><th>No</th><th>Parentesco</th>
		</tr>
	
		<?php
		
			for($i=0;$i<4;$i++){
		?>
		<tr>
			<td>
				<?php
				switch($i){
					case '0':{echo 'C&aacute;ncer';break;}
					case '1':{echo 'Obesidad';break;}
					case '2':{echo 'Diabetes';break;}
					case '3':{echo 'Hipertensi&oacute;n';break;}
				}
				
				?>
			</td>
			<td><input type="radio" name="existe<?php echo $i;?>" value="Si"  onclick='$("#ocultar_par<?php echo $i;?>").toggle(200)' 
				<?php $aux = FALSE;
					  if ($resultados != NULL)
						  foreach($resultados as $r){
							if ($i==0 && $r['id_patologia']==32 && $r['hereditaria']=='Si')
								$aux = TRUE;
							if ($i==1 && $r['id_patologia']==27 && $r['hereditaria']=='Si')
								$aux = TRUE;
							if ($i==2 && $r['id_patologia']==17 && $r['hereditaria']=='Si')
								$aux = TRUE;
							if ($i==3 && $r['id_patologia']==3 && $r['hereditaria']=='Si')
								$aux = TRUE;
					  }
					
					echo set_radio('existe'.$i.'','Si',$aux);
					//echo ($aux)?'disabled':'';?> /></td>
			<td><div class="lineal">
				<input type="radio" name="existe<?php echo $i;?>"  value="No" onclick='$("#ocultar_par<?php echo $i;?>").toggle(!200)' 
				<?php $aux = TRUE;
					if ($resultados != NULL)
					  foreach($resultados as $r){
						if ($i==0 && $r['id_patologia']==32 && $r['hereditaria']=='Si')
							$aux = FALSE;
						if ($i==1 && $r['id_patologia']==27 && $r['hereditaria']=='Si')
							$aux = FALSE;
						if ($i==2 && $r['id_patologia']==17 && $r['hereditaria']=='Si')
							$aux = FALSE;
						if ($i==3 && $r['id_patologia']==3 && $r['hereditaria']=='Si')
							$aux = FALSE;
					  }
					
					  echo set_radio('existe'.$i.'','No',$aux);
					  //echo ($aux)?'':'disabled'; ?> />
				<?php echo form_error('existe'.$i.'')?>
				</div>
			</td>
			<td align="center">
				<div id="ocultar_par<?php echo $i;?>" class="lineal"
				<?php $aux = FALSE;
					if ($resultados != NULL)
					  foreach($resultados as $r){
						if ($i==0 && $r['id_patologia']==32 && $r['hereditaria']=='Si')
							$aux = TRUE;
						if ($i==1 && $r['id_patologia']==27 && $r['hereditaria']=='Si')
							$aux = TRUE;
						if ($i==2 && $r['id_patologia']==17 && $r['hereditaria']=='Si')
							$aux = TRUE;
						if ($i==3 && $r['id_patologia']==3 && $r['hereditaria']=='Si')
							$aux = TRUE;
					  }
					  echo (($this->input->post('existe'.$i.'')=='Si') || $aux)?'':'style="display:none"';?> >
				<?php echo form_error('parentesco_'.$i); ?>
				<table>
				<tr>
					<td align="right"><label>Abuelo materno</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuelo materno" <?php $aux = FALSE;
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														stristr($r['parentesco'],'Abuelo materno')))
																													
																														$aux = TRUE;
																												  }
																												echo set_checkbox('parentesco_'.$i,'Abuelo materno',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
					<td align="right"><label>Abuelo paterno</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuelo paterno" <?php $aux = FALSE;
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														stristr($r['parentesco'],'Abuelo paterno')))
																													
																														$aux = TRUE;
																												  }
																												echo set_checkbox('parentesco_'.$i,'Abuelo paterno',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
				</tr>
				<tr>
					<td align="right"><label>Abuela materna</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuela materna" <?php $aux = FALSE;
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														stristr($r['parentesco'],'Abuela materna')))
																													
																														$aux = TRUE;
																												  }
																												echo set_checkbox('parentesco_'.$i,'Abuela materna',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
				
					<td align="right"><label>Abuela paterna</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuela paterna" <?php $aux = FALSE;
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														stristr($r['parentesco'],'Abuela paterna')))
																													
																														$aux = TRUE;
																												  }
					
																												echo set_checkbox('parentesco_'.$i,'Abuela paterna',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
				</tr>
				<tr>				
					<td align="right"><label>Padre</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Padre" <?php $aux = FALSE;
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														stristr($r['parentesco'],'Padre')))
																													
																														$aux = TRUE;
																												  }
																										echo set_checkbox('parentesco_'.$i,'Padre',$aux);
																										//echo ($aux)?'disabled':'';?> /></td>
					<td align="right"><label>Madre</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Madre" <?php $aux = FALSE;
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														stristr($r['parentesco'],'Madre')))
																													
																														$aux = TRUE;
																												  }
																										echo set_checkbox('parentesco_'.$i,'Madre',$aux);
																										//echo ($aux)?'disabled':'';?> /></td>
				</tr>
				</table>
				
				<div class="lineal">
					<label>Otro:</label><input type="text" name="otro_parentesco_<?php echo $i;?>" value="<?php $aux = '';
																												 if ($resultados != NULL)
																												  foreach($resultados as $r){
																													if ((($i==0 && $r['id_patologia']==32) ||
																														($i==1 && $r['id_patologia']==27) ||
																														($i==2 && $r['id_patologia']==17) ||
																														($i==3 && $r['id_patologia']==3))&&
																														($r['hereditaria']=='Si' && 
																														$r['otro_parentesco'] != NULL))
																													
																														$aux = $r['otro_parentesco'];
																												  }
																											echo set_value('otro_parentesco_'.$i,$aux);?>"/>
					<?php echo form_error('otro_parentesco_'.$i); ?>	
				</div>			
				<!--<input type="text" name="parentesco[]" value="<?php echo (isset($parentesco))?$parentesco[$i]:'';?>"/>
				<?php echo form_error('parentesco['.$i.']')?>-->
				</div>
			</td>
		</tr>
		<?php
			}
		?>
		</table>
		</div>
		<!--Otras patologías-->
		<div class="columnader">
			<table class="listado">
				<thead>
					<tr>
						<th>Patolog&iacute;a</th><th>Parentesco</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = (isset($otra_hereditaria))?sizeof($otra_hereditaria):0;?>
					<tr id="otra_0">
						<td>
							<label>Otra:</label>
							<?php echo form_error('otra_patologia_h[0]');?>
							<select id="otra_path_0" name="otra_patologia_h[]" onchange="var divName = $(this).attr('id');var elementos = divName.split('_');var myID = parseInt(elementos[2]); if(this.value == 'otra'){$('#otra_hereditaria_'+myID).css('display','block');}else{$('#otra_hereditaria_'+myID).css('display','none');} ">
								<option value="-1" selected="selected" <?php echo ((isset($otra_patologia_h))&&($otra_patologia_h[0]=="-1"))?'selected="selected"':'';?> >Seleccionar...</option>
								<?php 
									foreach($patologias as $j => $dato)
									{
								?>
										<option value="<?php echo $dato['id'];?>" <?php echo ((isset($otra_patologia_h))&&($otra_patologia_h[0]==$dato['id']))?'selected="selected"':'';?>> 
										<?php	echo $dato['nombre'];?>
										</option>
								<?php }?>
								<option value="otra" <?php echo ((isset($otra_patologia_h))&&($otra_patologia_h[0]=="otra"))?'selected="selected"':'';?>>Otra</option>
		    				</select>
		    				<input id="otra_hereditaria_0" type="text" name="otra_hereditaria[]"  <?php echo (isset($otra_patologia_h) && $otra_patologia_h[0] == "otra")?'':'style="display:none"' ;?>
		    				value="<?php echo (isset($otra_hereditaria))?''.$otra_hereditaria[0].'':'';?>"/>
		    				<?php echo form_error('otra_hereditaria[0]');?>
						</td>
						<td>
							<?php echo form_error('otra_parentesco[0]');?>
							<table>
								<tr>
									<td align="right"><label>Abuelo materno </label></td>
									<td><input type="checkbox" name="abuelo_materno[0]" value="Abuelo materno" <?php echo (isset($abuelo_materno)&& isset($abuelo_materno[0]))? 'checked="checked"':'';?>></td>
									<td align="right"><label>Abuelo paterno </label></td>
									<td><input type="checkbox" name="abuelo_paterno[0]" value="Abuelo paterno" <?php echo (isset($abuelo_paterno)&& isset($abuelo_paterno[0]))? 'checked="checked"':'';?>></td>
								</tr>
								<tr>
									<td align="right"><label>Abuela materna </label></td>
									<td><input type="checkbox" name="abuela_materna[0]" value="Abuela materna" <?php echo (isset($abuela_materna)&& isset($abuela_materna[0]))? 'checked="checked"':'';?>></td>
									<td align="right"><label>Abuela paterna </label></td>
									<td><input type="checkbox" name="abuela_paterna[0]" value="Abuela paterna" <?php echo (isset($abuela_paterna)&& isset($abuela_paterna[0]))? 'checked="checked"':'';?>></td>
								</tr>
								<tr>
									<td align="right"><label>Padre </label></td>
									<td><input type="checkbox" name="padre[0]" value="Padre" <?php echo (isset($padre)&& isset($padre[0]))? 'checked="checked"':'';?>></td>
									<td align="right"><label>Madre </label></td>
									<td><input type="checkbox" name="madre[0]" value="Madre" <?php echo (isset($madre)&& isset($madre[0]))? 'checked="checked"':'';?>></td>
								</tr>
								<tr>
									<td align="right"><label>Otro:</label></td>
									<td align="right" colspan="3"><input type="text" name="otra_parentesco[]" 
													   value="<?php echo (isset($otra_parentesco))?''.$otra_parentesco[0].'':'';?>"/></td>
								</tr>
							</table>
							
						</td>
						<td><input type="button" id="0" class="bt_mas_tabla" value="+"/></td>
					</tr>
					
					<?php for($i = 1; $i < $num; $i++){?>
					
					<tr id="otra_<?php echo $i;?>">
						<td>
							<label>Otra:</label>
							<?php echo form_error('otra_patologia_h['.$i.']');?>
							<select id="otra_path_<?php echo $i;?>" name="otra_patologia_h[]" onchange=" if(this.value == 'otra'){$('#otra_hereditaria_'<?php echo $i;?>).css('display','block');}else{$('#otra_hereditaria_'<?php echo $i;?>).css('display','none');} ">
								<option value="-1" selected="selected" <?php echo ((isset($otra_patologia_h))&&($otra_patologia_h[$i]=="-1"))?'selected="selected"':'';?> >Seleccionar...</option>
								<?php 
									foreach($patologias as $j => $dato)
									{
								?>
										<option value="<?php echo $dato['id'];?>" <?php echo ((isset($otra_patologia_h))&&($otra_patologia_h[$i]==$dato['id']))?'selected="selected"':'';?>> 
										<?php	echo $dato['nombre'];?>
										</option>
								<?php }?>
								<option value="otra" <?php echo ((isset($otra_patologia_h))&&($otra_patologia_h[$i]=="otra"))?'selected="selected"':'';?>>Otra</option>
		    				</select>
		    				<input id="otra_hereditaria_<?php echo $i;?>" type="text" name="otra_hereditaria[]" <?php echo (isset($otra_patologia_h) && $otra_patologia_h[$i] == "otra")?'':'style="display:none"' ;?>
		    				value="<?php echo (isset($otra_hereditaria))?''.$otra_hereditaria[$i].'':'';?>"/>
		    				<?php echo form_error('otra_hereditaria['.$i.']');?>
						</td>
						<td>
							<?php echo form_error('otra_parentesco['.$i.']');?>
							<table>
								<tr>
									<td align="right"><label>Abuelo materno </label></td>
									<td><input type="checkbox" name="abuelo_materno[<?php echo $i;?>]" value="Abuelo materno" <?php echo (isset($abuelo_materno)&& isset($abuelo_materno[$i]))? 'checked="checked"':'';?>></td>
									<td align="right"><label>Abuelo paterno </label></td>
									<td><input type="checkbox" name="abuelo_paterno[<?php echo $i;?>]" value="Abuelo paterno" <?php echo (isset($abuelo_paterno)&& isset($abuelo_paterno[$i]))? 'checked="checked"':'';?>></td>
								</tr>
								<tr>
									<td align="right"><label>Abuela materna </label></td>
									<td><input type="checkbox" name="abuela_materna[<?php echo $i;?>]" value="Abuela materna" <?php echo (isset($abuela_materna)&& isset($abuela_materna[$i]))? 'checked="checked"':'';?>></td>
									<td align="right"><label>Abuela paterna </label></td>
									<td><input type="checkbox" name="abuela_paterna[<?php echo $i;?>]" value="Abuela paterna" <?php echo (isset($abuela_paterna)&& isset($abuela_paterna[$i]))? 'checked="checked"':'';?>></td>
								</tr>
								<tr>
									<td align="right"><label>Padre </label></td>
									<td><input type="checkbox" name="padre[<?php echo $i;?>]" value="Padre" <?php echo (isset($padre)&& isset($padre[$i]))? 'checked="checked"':'';?>></td>
									<td align="right"><label>Madre </label></td>
									<td><input type="checkbox" name="madre[<?php echo $i;?>]" value="Madre" <?php echo (isset($madre)&& isset($madre[$i]))? 'checked="checked"':'';?>></td>
								</tr>
								<tr>
									<td align="right"><label>Otro:</label></td>
									<td align="right"><input type="text" name="otra_parentesco[]" 
													   value="<?php echo (isset($otra_parentesco))?''.$otra_parentesco[$i].'':'';?>"/></td>
								</tr>
							</table>
							<?php if(($i+1)<$num){//Comprobamos que no sea el ultimo alimento capturado?>
								<input id="<?php echo $i;?>" type="button" value="-" class="bt_menos_tabla" />	
							<?php }else{//Si es el ultimo alimento capturado, cambiamos el boton para agregar mas?>
								<input id="<?php echo $i;?>" type="button" value="+" class="bt_mas_tabla" />
							<?php }?>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			</div>
		</fieldset>
		
		
</fieldset>
