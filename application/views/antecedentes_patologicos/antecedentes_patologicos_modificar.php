<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>
</head>
<body>
<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
	<form method="post" action="<?php echo site_url();?>/antecedentes_patologicos/modificar/<?php echo $id_paciente;?>/<?php echo $fecha_id;?>" name="formulario" id="formulario" style="width: 100%">
		<input type="hidden" name="paciente" value="<?php echo $id_paciente?>" />
		<fieldset>
			<legend>Antecedentes Patol&oacute;gicos</legend>
			<?php $this->load->view('antecedentes_patologicos/antecedentes_hereditarios_modificar');?>	
			<fieldset>
				<legend>Antecedentes Personales</legend>
				<div class="lineal">
					<label>&iquest;Ha padecido o padece alguna enfermedad?</label>
					<label>S&iacute;</label><input type="radio" value="Si" name="enfermedad" onclick='$("#ocultar_enfermedad").toggle(200);'
						<?php $aux = FALSE;
							 if ($resultados != NULL)
							  foreach($resultados as $r){
								if ($r['hereditaria']=='No')  
								$aux = TRUE;
							  }  
						echo set_radio('enfermedad','Si',$aux);?>/>
					<label>No</label><input type="radio" value="No" name="enfermedad" onclick='$("#ocultar_enfermedad").toggle(!200);'
						<?php $aux = TRUE;
							 if ($resultados != NULL)
							  foreach($resultados as $r){
								if ($r['hereditaria']=='No')  
								$aux = FALSE;
							  }  
							echo set_radio('enfermedad','No',$aux);
							//echo ($aux)?'':'disabled';?>/>
						<?php echo form_error('enfermedad')?>
				</div>
				<div id="ocultar_enfermedad" <?php $aux = FALSE;
												 	if ($resultados != NULL)
												  		foreach($resultados as $r){
															if ($r['hereditaria']=='No')  
															$aux = TRUE;
												 		 }  
													echo ($this->input->post('enfermedad')=='Si' || $aux)?'':'style="display: none"'?>>
				<div class="lineal">
				 <label>(Indique cu&aacute;l)</label>
				 <?php echo form_error('patologia')?>
				</div>
				<?php 
					$j=0;
					$num = (isset($status))?sizeof($status):0;
					$counter = 0;
					$numero_clasificaciones = sizeof($clasificaciones)/3;
					foreach($clasificaciones as $dato){
						if($counter==0){
							echo '<div class="columnaizq" style="margin:0.2em">';
						}
						if($counter==round($numero_clasificaciones,0)){
							echo '</div>';
							echo '<div class="columnaizq" style="margin:0.2em">';
						}
						if($counter==round(($numero_clasificaciones*2),0)){
							echo '</div>';
							echo '<div class="columnaizq" style="margin:0.2em">';
						}
				?>
						<fieldset>
							<legend><?php echo $dato['clasificacion']; ?>
									<input type="button" value="+" onclick='$("<?php echo '#lista_'.$dato['id'];?>").toggle(200);' 
									 style="display: inline" />
							</legend>
							<div id="lista_<?php echo $dato['id']; ?>" <?php $aux = FALSE;
																			 if ($resultados != NULL)
																			  foreach($resultados as $r){
																				if ($r['hereditaria']=='No')  
																				$aux = TRUE;
																			  }  
																			echo (($this->input->post('patologia')!=NULL)||
																				  ($this->input->post('otra')!=NULL)|| $aux)?'':'style="display: none"';?>>
								<table>
								<?php
									foreach($patologias as $dato2)
									if ($dato2['clasificacion'] == $dato['id']){
										$k=$dato2['id'];
								?>
									<tr><td><input type="checkbox" name="patologia[]" onclick='$("<?php echo '#ocultar_status_'.$k;?>").toggle(200);'
											 value="<?php echo $dato2['id'];?>" 
											 <?php $aux = FALSE;
												   if ($resultados != NULL)
												  	foreach($resultados as $r){
														if ($r['hereditaria']=='No' &&
															$r['id_patologia']==$dato2['id'])  
														$aux = TRUE;
												  	}  
											 	echo set_checkbox('patologia',$dato2['id'],$aux);
												//echo ($aux)?'disabled':'';
											 ?>/>
										</td>
										<td align="left"><label><?php echo $dato2['nombre'];?></label></td>
										
										<td><div id="<?php echo 'ocultar_status_'.$k;?>" <?php $aux = FALSE;
																							 if ($resultados != NULL)
																							  foreach($resultados as $r){
																								if ($r['hereditaria']=='No' &&
																									$r['id_patologia']==$dato2['id'])  
																								$aux = TRUE;
																							  }
																							  
																							  $aux2=$this->input->post('patologia');
																							  for($i=0;$i<sizeof($aux2);$i++){
																							  	if($aux2[$i]==$dato2['id'])
																									$aux=TRUE;
																							  }
																							  echo ($aux)?'':'style="display:none"'; 
																							?> >
												<select name="<?php echo 'status_'.$k;?>">
													<option value="Activo" <?php $aux = FALSE;
																				 if ($resultados != NULL)
																				  foreach($resultados as $r){
																					if ($r['hereditaria']=='No' &&
																						$r['id_patologia']==$dato2['id'] &&
																						$r['status']=='Activo')  
																					$aux = TRUE;
																				  }
																				     
																				echo set_select('status_'.$k,'Activo',$aux);?>>Activo</option>
													<option value="Normal" <?php $aux = FALSE;
																				 if ($resultados != NULL)
																				  foreach($resultados as $r){
																					if ($r['hereditaria']=='No' &&
																						$r['id_patologia']==$dato2['id'] &&
																						$r['status']=='Normal')  
																					$aux = TRUE;
																				  }  
																				echo set_select('status_'.$k,'Normal',$aux);?>>Normal</option>
												</select>
											</div>
										</td>
									</tr>
								<?php }?>
								<tr>
									<?php if($dato['id'] != 13){?>
									<td><input type="checkbox" name="otra_patologia[]" value="<?php echo $j;?>" onclick='$("<?php echo '#ocultar_otra_'.$j;?>").toggle(200);'
										<?php echo set_checkbox('otra_patologia',$j)?>/></td>
									<td align="left"><label>Otra:</label></td>
									
									
									<td><div id="<?php echo 'ocultar_otra_'.$j;?>" class="lineal"
										<?php $aux=FALSE;
										
											  $aux1=$this->input->post('otra_patologia');
											  for($i=0;$i<sizeof($aux1);$i++)
											  	if($aux1[$i]!=NULL && $aux1[$i]==$j)
													$aux=TRUE;
											  echo ($aux)?'':'style="display:none"'; 
										?>
										>
										<input type="text" name="otra[]" size="15" value="<?php echo (isset($otra))?$otra[$j]:'';?>" />
										<?php echo form_error('otra['.$j.']')?>
										
										<select name="<?php echo 'status_otra'.$j;?>">
											<option value="Activo" <?php echo set_select('status_otra'.$j,'Activo')?>>Activo</option>
											<option value="Normal" <?php echo set_select('status_otra'.$j,'Normal')?>>Normal</option>
										</select>
										</div>
									</td>
									<?php }else{?>
										<td colspan="3">
											<?php $num = (isset($otra_patologia))?sizeof($otra_patologia):0;//Obtenemos el valor de campos que agregamos?>
											<div id="otra_patologia_0"  class="lineal">	
												<label>Otra:</label>
												<input type="text" name="otra_clasificacion[]" value="<?php echo (isset($otra_patologia))?''.$otra_patologia[0].'':'';?>" />
												<select name="status_otra[]">
													<option value="Activo"<?php echo ((isset($status_otra))&&($status_otra[0]=="Activo"))?'selected="selected"':'';?>>Activo</option>
													<option value="Normal"<?php echo ((isset($status_otra))&&($status_otra[0]=="Normal"))?'selected="selected"':'';?>>Normal</option>
												</select>
												<input id="0" type="button" <?php echo ($num>0)?'value="-" class="bt_menos"':'value="+" class="bt_mas"';?> />
											</div>
											<?php
											for ($i=1;$i < $num; $i++){?>
												<div id="otra_patologia_<?php echo $i;?>" class="lineal">
													<label>Otra:</label>
													<input type="text" name="otra_clasificacion[]" value="<?php echo (isset($otra_patologia))?''.$otra_patologia[$i].'':'';?>" />
													<select name="status_otra[]">
														<option value="Activo"<?php echo ((isset($status_otra))&&($status_otra[$i]=="Activo"))?'selected="selected"':'';?>>Activo</option>
														<option value="Normal"<?php echo ((isset($status_otra))&&($status_otra[$i]=="Normal"))?'selected="selected"':'';?>>Normal</option>
													</select>
													<?php if(($i+1)<$num){//Comprobamos que no sea el ultimo alimento capturado?>
														<input id="<?php echo $i;?>" type="button" value="-" class="bt_menos" />	
													<?php }else{//Si es el ultimo alimento capturado, cambiamos el boton para agregar mas?>
														<input id="<?php echo $i;?>" type="button" value="+" class="bt_mas" />
													<?php }?>
												</div>
											<?php }?>
										</td>
								<?php }?>
								</tr>
								</table>
							</div>
						</fieldset>
				<?php
						
						$j++;
						$counter++;
					}
					echo '</div>';
				?>
			</fieldset>
			</div>
		</fieldset>
		<div class="botones" align="center">
			<input type="submit" value="Guardar" />
			<input type="reset" value="Limpiar" />
		</div>
	</form>
<script>
$('#formulario').submit(function(){setTimeout(function(){
		parent.listado_mini.location='<?php echo site_url()?>/antecedentes_patologicos/listado_mini/<?php echo $id_paciente;?>';
	},200);});
</script>
</body>
</html>