<head>
	<script language="JavaScript" type="text/JavaScript">
		   //Función que actualiza el select de las patologías cuando se elige una clasificación
		    $(document).ready(function(){
		        $("#clasificacion_otra").change(function(event){
		            var id = $("#clasificacion_otra").find(':selected').val();           
		            $("#patologia_otra").load('patologias_select?id='+id);
		      
		        });
		    
		    });
	</script>	
    
</head>
<fieldset>
	<legend>Antecedentes Heredofamiliares</legend>
	<label>&iquest;Ha padecido alg&uacute;n familiar alguna de las siguientes enfermedades?</label>
	<table class="tabla_formulario">
		<tr>
			<th>Patolog&iacute;a</th><th>S&iacute;</th><th>No</th><th>Parentesco</th>
		</tr>
	
		<?php 
			if($resultados != NULL){
				$i = 0;
				foreach ($resultados as $r) {
					if($r['hereditaria'] == 'Si'){	
				
			?>
		<tr>
			<td>
			<?php	echo $r['patologia'];
			?>	
			<input type="hidden" name="id_patologia_<?php echo $i;?>" value="<?php echo $r['id_patologia'];?>"/>	   
			</td>
			<td><input type="radio" name="existe<?php echo $i;?>" value="Si"  onclick='$("#ocultar_par<?php echo $i;?>").toggle(200)' 
				<?php /*$aux = FALSE;
					 
						if ($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
				   			$r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
				  			$r['hereditaria'] == 'Si')*/
							$aux = TRUE;
					  
					
					echo set_radio('existe'.$i.'','Si',$aux);
					//echo ($aux)?'disabled':'';?> /></td>
			<td><div class="lineal">
				<input type="radio" name="existe<?php echo $i;?>"  value="No" onclick='$("#ocultar_par<?php echo $i;?>").toggle(!200)' 
				<?php /*$aux = TRUE;
						if ($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   		$r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   		$r['hereditaria'] == 'Si')*/
							$aux = FALSE;
					  
					
					  echo set_radio('existe'.$i.'','No',$aux);
					  //echo ($aux)?'':'disabled'; ?> />
				<?php echo form_error('existe'.$i.'')?>
				</div>
			</td>
			<td align="center">
				<div id="ocultar_par<?php echo $i;?>" class="lineal"
				<?php /*$aux = FALSE;
						if ($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   		$r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   		$r['hereditaria'] == 'Si')*/
							$aux = TRUE;
					  
					  echo (($this->input->post('existe'.$i.'')=='Si') || $aux)?'':'style="display:none"';?> >
				<?php echo form_error('parentesco_'.$i); ?>
				<table>
				<tr>
					<td align="right"><label>Abuelo materno</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuelo materno" <?php $aux = FALSE;
																													if (/*($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
																													   	 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
																													     $r['hereditaria'] == 'Si' && */
																														 stristr($r['parentesco'],'Abuelo materno'))
																													
																														$aux = TRUE;
																												  
																												echo set_checkbox('parentesco_'.$i,'Abuelo materno',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
					<td align="right"><label>Abuelo paterno</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuelo paterno" <?php $aux = FALSE;
																												 
																													if ((/*$r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   																									 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   																									 $r['hereditaria'] == 'Si' && */
																														 stristr($r['parentesco'],'Abuelo paterno')))
																													
																														 $aux = TRUE;
																												  
																												echo set_checkbox('parentesco_'.$i,'Abuelo paterno',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
				</tr>
				<tr>
					<td align="right"><label>Abuela materna</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuela materna" <?php $aux = FALSE;
																												 
																													if (/*($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   																									 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   																									 $r['hereditaria'] == 'Si' && */
																														stristr($r['parentesco'],'Abuela materna'))
																													
																														$aux = TRUE;
																												  
																												echo set_checkbox('parentesco_'.$i,'Abuela materna',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
				
					<td align="right"><label>Abuela paterna</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Abuela paterna" <?php $aux = FALSE;
																												 
																													if (/*($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   																									 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   																									 $r['hereditaria'] == 'Si'&& */
																														stristr($r['parentesco'],'Abuela paterna'))
																													
																														$aux = TRUE;
																												  
					
																												echo set_checkbox('parentesco_'.$i,'Abuela paterna',$aux);
																												//echo ($aux)?'disabled':'';?> /></td>
				</tr>
				<tr>				
					<td align="right"><label>Padre</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Padre" <?php $aux = FALSE;
																												 
																													if (/*($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   																									 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   																									 $r['hereditaria'] == 'Si' && */
																														stristr($r['parentesco'],'Padre'))
																													
																														$aux = TRUE;
																												  
																										echo set_checkbox('parentesco_'.$i,'Padre',$aux);
																										//echo ($aux)?'disabled':'';?> /></td>
					<td align="right"><label>Madre</label></td>
					<td><input type="checkbox" name="parentesco_<?php echo $i;?>[]" value="Madre" <?php $aux = FALSE;
																												
																													if (/*($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   																									 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   																									 $r['hereditaria'] == 'Si'&& */
																														stristr($r['parentesco'],'Madre'))
																													
																														$aux = TRUE;
																												  
																										echo set_checkbox('parentesco_'.$i,'Madre',$aux);
																										//echo ($aux)?'disabled':'';?> /></td>
				</tr>
				</table>
				
				<div class="lineal">
					<label>Otro:</label><input type="text" name="otro_parentesco_<?php echo $i;?>" value="<?php $aux = '';
																												
																													if (/*($r['id_patologia'] != 32 && $r['id_patologia'] != 27 &&
					   																									 $r['id_patologia'] != 17 && $r['id_patologia'] != 3 &&
					   																									 $r['hereditaria'] == 'Si' && */
																														 $r['otro_parentesco'] != NULL)
																													
																														$aux = $r['otro_parentesco'];
																												  
																											echo set_value('otro_parentesco_'.$i,$aux);?>"/>
					<?php echo form_error('otro_parentesco_'.$i); ?>	
				</div>			
				<!--<input type="text" name="parentesco[]" value="<?php echo (isset($parentesco))?$parentesco[$i]:'';?>"/>
				<?php echo form_error('parentesco['.$i.']')?>-->
				</div>
			</td>
		</tr>
		<?php }$i++;}}?>
		
		
		
	</table>
</fieldset>