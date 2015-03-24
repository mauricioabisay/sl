<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<form id="formulario" action="<?php echo site_url();?>/paciente/modificar/<?php echo $paciente->id;?>" method="post" enctype="multipart/form-data" style="width: 100%"><div class="columnaizq">	<fieldset>		<legend>Informaci&oacute;n Personal</legend>		<fieldset class="columnaizq">		<legend>Datos Personales</legend>			<label>Nombre(s):</label>			<span class="lineal"><input type="text" name="nombre" value="<?php echo set_value('nombre',$paciente->nombre);?>"/><?php echo form_error('nombre')?></span>			<label>Apellido Paterno:</label>
			<span class="lineal"><input type="text" name="ap" value="<?php echo set_value('ap',$paciente->ap);?>" /><?php echo form_error('ap')?></span>			<label>Apellido Materno</label>
			<span class="lineal"><input type="text" name="am" value="<?php echo set_value('am',$paciente->am);?>" /><?php echo form_error('am')?></span>			<label>Fecha Nacimiento:</label>
			<span class="lineal">				<input class="date_fecha" type="text" name="fecha_nac" onchange="$('#edad').text(calcularEdad($(this).val()))" value="<?php echo set_value('fecha_nac',$paciente->fecha_nac);?>" />				<label id="edad"></label>				<?php echo form_error('fecha_nac')?>			</span>			<label>Ocupaci&oacute;n:</label>			<span class="lineal"><input type="text" name="ocupacion" value="<?php echo set_value('ocupacion',$paciente->ocupacion);?>" /><?php echo form_error('ocupacion')?></span>			<label>¿C&oacute;mo le gusta que le digan?:</label>			<span class="lineal"><input type="text" name="nick" value="<?php echo set_value('nick',$paciente->nick);?>" /><?php echo form_error('nick')?></span>			<label>Sexo:</label>			<div class="lineal">				<input type="radio" name="sexo" value="Masculino" <?php echo set_radio('sexo','Masculino',($paciente->sexo=='Masculino')?TRUE:FALSE);?> /><label>Masculino</label>				<input type="radio" name="sexo" value="Femenino" <?php echo set_radio('sexo','Femenino',($paciente->sexo=='Femenino')?TRUE:FALSE);?> /><label>Femenino</label>				<?php echo form_error('sexo')?>
			</div>
			<div class="lineal">				<label>Edo. Civil:</label>				<select name="edo_civil">					<option value="Soltero" <?php echo set_select('edo_civil','Soltero',($paciente->edo_civil=='Soltero')?TRUE:FALSE);?>>Soltero</option>					<option value="Casado" <?php echo set_select('edo_civil','Casado',($paciente->edo_civil=='Casado')?TRUE:FALSE);?>>Casado</option>					<option value="Divorciado" <?php echo set_select('edo_civil','Divorciado',($paciente->edo_civil=='Divorciado')?TRUE:FALSE);?>>Divorciado</option>					<option value="U.Libre" <?php echo set_select('edo_civil','U.Libre',($paciente->edo_civil=='U.Libre')?TRUE:FALSE);?>>U.Libre</option>				</select>				<?php echo form_error('edo_civil')?>			</div>		</fieldset>		<fieldset class="columnader">			<legend>Fotograf&iacute;a:</legend>			<img src="<?php echo base_url();?><?php echo file_exists(base_url()."/assets/img/paciente/".$paciente->id.".png")?'/assets/img/paciente/'.$paciente->id.'.png':'/assets/img/anonimo.jpg';?>" width="108" height="120" />			<label>Fotograf&iacute;a:</label>			<span class="lineal"><input type="file" name="foto" style="width: 200px" accept="image/gif,image/jpg,image/jpeg,image/png" value="<?php echo set_value('foto');?>" /><?php echo form_error('foto')?></span>		</fieldset>	</fieldset>	<fieldset>		<legend>Direcci&oacute;n</legend>		<div class="lineal">			<label>Calle:</label><input type="text" name="calle" value="<?php echo set_value('calle',(($direccion))?$direccion->calle:'');?>" /><?php echo form_error('calle')?>			<label>N&uacute;m.Exterior:</label><input type="text" size="4" name="num_ext" value="<?php echo set_value('num_ext',(($direccion))?$direccion->num_ext:'');?>" /><?php echo form_error('num_ext')?>			<label>N&uacute;m.Interior:</label><input type="text" size="4" name="num_int" value="<?php echo set_value('num_int',(($direccion))?$direccion->num_int:'');?>" /><?php echo form_error('num_int')?>			<label>Colonia:</label><input size="15" type="text" name="colonia" value="<?php echo set_value('colonia',(($direccion))?$direccion->colonia:'');?>" /><?php echo form_error('colonia')?>		</div>		<div class="lineal">					<label>Ciudad:</label><input type="text" name="ciudad" value="<?php echo set_value('ciudad',(($direccion))?$direccion->ciudad:'');?>" /><?php echo form_error('ciudad')?>			<label>Estado:</label>			<select name="estado">				<option <?php echo set_select('estado','Aguascalientes',($direccion)&&($direccion->estado=='Aguascalientes')?TRUE:FALSE);?>>Aguascalientes</option>				<option <?php echo set_select('estado','Baja California',($direccion)&&($direccion->estado=='Baja California')?TRUE:FALSE);?>>Baja California</option>				<option <?php echo set_select('estado','Baja California Sur',($direccion)&&($direccion->estado=='Baja California Sur')?TRUE:FALSE);?>>Baja California Sur</option>				<option <?php echo set_select('estado','Campeche',($direccion)&&($direccion->estado=='Campeche')?TRUE:FALSE);?>>Campeche</option>				<option  <?php echo set_select('estado','Chiapas',($direccion)&&($direccion->estado=='Chiapas')?TRUE:FALSE);?>>Chiapas</option>				<option <?php echo set_select('estado','Chihuahua',($direccion)&&($direccion->estado=='Chihuahua')?TRUE:FALSE);?>>Chihuahua</option>				<option <?php echo set_select('estado','Coahuila',($direccion)&&($direccion->estado=='Coahuila')?TRUE:FALSE);?>>Coahuila</option>				<option <?php echo set_select('estado','Colima',($direccion)&&($direccion->estado=='Colima')?TRUE:FALSE);?>>Colima</option>				<option <?php echo set_select('estado','Distrito Federal',($direccion)&&($direccion->estado=='Distrito Federal')?TRUE:FALSE);?>>Distrito Federal</option>				<option <?php echo set_select('estado','Durango',($direccion)&&($direccion->estado=='Durango')?TRUE:FALSE);?>>Durango</option>				<option <?php echo set_select('estado','Guanajuato',($direccion)&&($direccion->estado=='Guanajuato')?TRUE:FALSE);?>>Guanajuato</option>				<option <?php echo set_select('estado','Guerrero',($direccion)&&($direccion->estado=='Guerrero')?TRUE:FALSE);?>>Guerrero</option>				<option <?php echo set_select('estado','Hidalgo',($direccion)&&($direccion->estado=='Hidalgo')?TRUE:FALSE);?>>Hidalgo</option>				<option <?php echo set_select('estado','Jalisco',($direccion)&&($direccion->estado=='Jalisco')?TRUE:FALSE);?>>Jalisco</option>
				<option value="México" <?php echo set_select('estado','México',($direccion)&&($direccion->estado=='México')?TRUE:FALSE);?>>M&eacute;xico</option>				<option value="Michoacán" <?php echo set_select('estado','Michoacán',($direccion)&&($direccion->estado=='Michoacán')?TRUE:FALSE);?>>Michoac&aacute;n</option>				<option <?php echo set_select('estado','Morelos',($direccion)&&($direccion->estado=='Morelos')?TRUE:FALSE);?>>Morelos</option>				<option <?php echo set_select('estado','Nayarit',($direccion)&&($direccion->estado=='Nayarit')?TRUE:FALSE);?>>Nayarit</option>				<option value="Nuevo León" <?php echo set_select('estado','Nuevo León',($direccion)&&($direccion->estado=='Nuevo León')?TRUE:FALSE);?>>Nuevo Le&oacute;n</option>				<option <?php echo set_select('estado','Oaxaca',($direccion)&&($direccion->estado=='Oaxaca')?TRUE:FALSE);?>>Oaxaca</option>				<option <?php echo set_select('estado','Puebla',($direccion)&&($direccion->estado=='Puebla')?TRUE:FALSE);?>>Puebla</option>				<option value="Querétaro" <?php echo set_select('estado','Querétaro',($direccion)&&($direccion->estado=='Querétaro')?TRUE:FALSE);?>>Quer&eacute;taro</option>				<option <?php echo set_select('estado','Quintana Roo',($direccion)&&($direccion->estado=='Quintana Roo')?TRUE:FALSE);?>>Quintana Roo</option>				<option value="San Luis Potosí" <?php echo set_select('estado','San Luis Potosí',($direccion)&&($direccion->estado=='San Luis Potosí')?TRUE:FALSE);?>>San Luis Potos&iacute;</option>				<option <?php echo set_select('estado','Sinaloa',($direccion)&&($direccion->estado=='Sinaloa')?TRUE:FALSE);?>>Sinaloa</option>				<option <?php echo set_select('estado','Sonora',($direccion)&&($direccion->estado=='Sonora')?TRUE:FALSE);?>>Sonora</option>				<option <?php echo set_select('estado','Tabasco',($direccion)&&($direccion->estado=='Tabasco')?TRUE:FALSE);?>>Tabasco</option>				<option <?php echo set_select('estado','Tamaulipas',($direccion)&&($direccion->estado=='Tamaulipas')?TRUE:FALSE);?>>Tamaulipas</option>				<option <?php echo set_select('estado','Tlaxcala',($direccion)&&($direccion->estado=='Tlaxcala')?TRUE:FALSE);?>>Tlaxcala</option>				<option <?php echo set_select('estado','Veracruz',($direccion)&&($direccion->estado=='Veracruz')?TRUE:FALSE);?>>Veracruz</option>				<option value="Yucatán" <?php echo set_select('estado','Yucatán',($direccion)&&($direccion->estado=='Yucatán')?TRUE:FALSE);?>>Yucat&aacute;n</option>				<option <?php echo set_select('estado','Zacatecas',($direccion)&&($direccion->estado=='Zacatecas')?TRUE:FALSE);?>>Zacatecas</option>			</select>			<?php echo form_error('estado')?>			<label>C.P.:</label><input type="text" name="cp" value="<?php echo set_value('cp',($direccion)?$direccion->cp:'');?>" /><?php echo form_error('cp')?>		</div>	</fieldset></div>
<div class="columnader">	<fieldset>		<legend>Informaci&oacute;n de Contacto</legend>		<fieldset class="columnaizq">		<legend>Tel&eacute;fonos</legend>			<div class="lineal" style="padding-bottom: 1em;">				<label>Tel.Oficina:</label>				<input type="text" maxlength="3" size="2" name="tel_oficina_lada" value="<?php echo ($paciente->tel_oficina)?set_value('tel_oficina_lada',substr($paciente->tel_oficina,0,3)):'222';?>" />				<span>-</span><input type="text" maxlength="1" size="1" name="tel_oficina_d1" value="<?php echo set_value('tel_oficina_d1',substr($paciente->tel_oficina,2,1));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="tel_oficina_d2" value="<?php echo set_value('tel_oficina_d2',substr($paciente->tel_oficina,3,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="tel_oficina_d3" value="<?php echo set_value('tel_oficina_d3',substr($paciente->tel_oficina,5,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="tel_oficina_d4" value="<?php echo set_value('tel_oficina_d4',substr($paciente->tel_oficina,7,2));?>" />				<label>Ext.:</label><input type="text" maxlength="4" size="3" name="ext_oficina" value="<?php echo set_value('ext_oficina',$paciente->ext_oficina);?>" />				<?php				$tel_oficina = TRUE;				if((form_error('tel_oficina_d1')!='')&&($tel_oficina)){					$tel_oficina = FALSE;					echo form_error('tel_oficina_d1');				}				if((form_error('tel_oficina_d2')!='')&&($tel_oficina)){					$tel_oficina = FALSE;					echo form_error('tel_oficina_d2');				}				if((form_error('tel_oficina_d3')!='')&&($tel_oficina)){					$tel_oficina = FALSE;					echo form_error('tel_oficina_d3');				}				if((form_error('tel_oficina_d4')!='')&&($tel_oficina)){					$tel_oficina = FALSE;					echo form_error('tel_oficina_d4');				}				if((form_error('ext_oficina')!='')&&($tel_oficina)){					$tel_oficina = FALSE;					echo form_error('ext_oficina');				}				?>			</div>
			<div class="lineal" style="padding-bottom: 1em;">
				<label>Tel.Casa:</label>				<input type="text" maxlength="3" size="2" name="tel_casa_lada" value="<?php echo ($paciente->tel_casa)?set_value('tel_casa_lada',substr($paciente->tel_casa,0,3)):'222';?>" />				<span>-</span><input type="text" maxlength="1" size="1" name="tel_casa_d1" value="<?php echo set_value('tel_casa_d1',substr($paciente->tel_casa,3,1));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="tel_casa_d2" value="<?php echo set_value('tel_casa_d2',substr($paciente->tel_casa,4,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="tel_casa_d3" value="<?php echo set_value('tel_casa_d3',substr($paciente->tel_casa,6,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="tel_casa_d4" value="<?php echo set_value('tel_casa_d4',substr($paciente->tel_casa,8,2));?>" />				<?php					$tel_casa = TRUE;					if((form_error('tel_casa_d1')!='')&&($tel_casa)){						$tel_casa = FALSE;						echo form_error('tel_casa_d1');					}					if((form_error('tel_casa_d2')!='')&&($tel_casa)){						$tel_casa = FALSE;						echo form_error('tel_casa_d2');					}					if((form_error('tel_casa_d3')!='')&&($tel_casa)){						$tel_casa = FALSE;						echo form_error('tel_casa_d3');					}					if((form_error('tel_casa_d4')!='')&&($tel_casa)){						$tel_casa = FALSE;						echo form_error('tel_casa_d4');					}				?>			</div>			<div class="lineal" style="padding-bottom: 1em;">				<label>Celular 1:</label>				<span>044-</span><input type="text" maxlength="2" size="1" name="cel1_d1" value="<?php echo ($paciente->cel1)?set_value('cel1_d1',substr($paciente->cel1,0,2)):'22';?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel1_d2" value="<?php echo ($paciente->cel1)?set_value('cel1_d2',substr($paciente->cel1,2,2)):'2';?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel1_d3" value="<?php echo set_value('cel1_d3',substr($paciente->cel1,4,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel1_d4" value="<?php echo set_value('cel1_d4',substr($paciente->cel1,6,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel1_d5" value="<?php echo set_value('cel1_d5',substr($paciente->cel1,8,2));?>" />				<?php					$cel1 = TRUE;					if((form_error('cel1_d1')!='')&&($cel1)){						$cel1 = FALSE;						echo form_error('cel1_d1');					}					if((form_error('cel1_d2')!='')&&($cel1)){						$cel1 = FALSE;						echo form_error('cel1_d2');					}					if((form_error('cel1_d3')!='')&&($cel1)){						$cel1 = FALSE;						echo form_error('cel1_d3');					}					if((form_error('cel1_d4')!='')&&($cel1)){						$cel1 = FALSE;						echo form_error('cel1_d4');					}					if((form_error('cel1_d5')!='')&&($cel1)){						$cel1 = FALSE;						echo form_error('cel1_d5');					}				?>			</div>			<div class="lineal" style="padding-bottom: 1em;">				<label>Celular 2:</label>				<span>044-</span><input type="text" maxlength="2" size="1" name="cel2_d1" value="<?php echo ($paciente->cel2)?set_value('cel2_d1',substr($paciente->cel2,0,2)):'22';?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel2_d2" value="<?php echo ($paciente->cel2)?set_value('cel2_d2',substr($paciente->cel2,2,2)):'2';?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel2_d3" value="<?php echo set_value('cel2_d3',substr($paciente->cel2,4,2));?>" />
				<span>-</span><input type="text" maxlength="2" size="1" name="cel2_d4" value="<?php echo set_value('cel2_d4',substr($paciente->cel2,6,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="cel2_d5" value="<?php echo set_value('cel2_d5',substr($paciente->cel2,8,2));?>" />				<?php					$cel2 = TRUE;					if((form_error('cel2_d1')!='')&&($cel2)){						$cel2 = FALSE;						echo form_error('cel2_d1');					}					if((form_error('cel2_d2')!='')&&($cel2)){						$cel2 = FALSE;						echo form_error('cel2_d2');					}					if((form_error('cel2_d3')!='')&&($cel2)){						$cel2 = FALSE;						echo form_error('cel2_d3');					}					if((form_error('cel2_d4')!='')&&($cel2)){						$cel2 = FALSE;						echo form_error('cel2_d4');					}					if((form_error('cel2_d5')!='')&&($cel2)){						$cel2 = FALSE;						echo form_error('cel2_d5');					}				?>			</div>			<div class="lineal" style="padding-bottom: 1em;">				<label>Radio:</label>				<input type="text" maxlength="3" size="2" name="radio_d1" value="<?php echo set_value('radio_d1',substr($paciente->radio,0,3));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="radio_d2" value="<?php echo set_value('radio_d2',substr($paciente->radio,3,2));?>" />				<span>-</span><input type="text" maxlength="2" size="1" name="radio_d3" value="<?php echo set_value('radio_d3',substr($paciente->radio,5));?>" />				<?php					$radio = TRUE;					if((form_error('radio_d1')!='')&&($radio)){						$radio = FALSE;						echo form_error('radio_d1');					}					if((form_error('radio_d2')!='')&&($radio)){						$radio = FALSE;						echo form_error('radio_d2');					}					if((form_error('radio_d3')!='')&&($radio)){						$radio = FALSE;						echo form_error('radio_d3');					}				?>			</div>			<div class="lineal" style="padding-bottom: 1em;">				<label>Radio ID:</label>				<input type="text" maxlength="3" size="2" name="radio_id_d1" value="<?php echo ($paciente->radio_id)?set_value('radio_id_d1',substr($paciente->radio_id,0,2)):'52';?>" />				<span>*</span><input type="text" maxlength="6" size="5" name="radio_id_d2" value="<?php echo set_value('radio_id_d2',substr($paciente->radio_id,2,6));?>" />				<span>*</span><input type="text" maxlength="6" size="5" name="radio_id_d3" value="<?php echo set_value('radio_id_d3',substr($paciente->radio_id,8));?>" />				<?php					$radio_id = TRUE;					if((form_error('radio_id_d1')!='')&&($radio_id)){						$radio_id = FALSE;						echo form_error('radio_id_d1');					}					if((form_error('radio_id_d2')!='')&&($radio_id)){						$radio_id = FALSE;						echo form_error('radio_id_d2');					}					if((form_error('radio_id_d3')!='')&&($radio_id)){						$radio_id = FALSE;						echo form_error('radio_id_d3');					}				?>			</div>		</fieldset>		<fieldset class="columnader">			<legend>E-mail</legend>			<label>E-mail 1:</label>			<span class="lineal"><input type="text" size="35" name="mail1" value="<?php echo set_value('mail1',$paciente->mail1);?>" /><?php echo form_error('mail1')?></span>			<label>E-mail 2:</label>			<span class="lineal"><input type="text" size="35" name="mail2" value="<?php echo set_value('mail2',$paciente->mail2);?>" /><?php echo form_error('mail2')?></span>			<label>E-mail 3:</label>			<span class="lineal"><input type="text" size="35" name="mail3" value="<?php echo set_value('mail3',$paciente->mail3);?>" /><?php echo form_error('mail3')?></span>		</fieldset>	</fieldset>
	<fieldset>
		<legend>Servicio Alimentos Sabor and Light</legend>
		<div class="lineal">
			<label>¿Desea el Servicio de Alimentos Sabor and Light?</label>
			<input name="servicio_alimentos" type="radio" value="Si" <?php echo set_radio('servicio_alimentos','Si',($paciente->servicio_alimentos=='Si')?TRUE:FALSE);?>/><label>Si</label>
			<input name="servicio_alimentos" type="radio" value="No" <?php echo set_radio('servicio_alimentos','No',($paciente->servicio_alimentos=='No')?TRUE:FALSE);?>/><label>No</label>
			<?php echo form_error('servicio_alimentos');?>
		</div>
	</fieldset>	<fieldset>		<legend>Referencia</legend>		<div class="lineal">			<label>¿Ha venido por instrucciones de su m&eacute;dico u otra persona?</label>			<input type="radio" onclick='$("#info_referencia").toggle(200)' name="recomendacion" value="Si" <?php echo set_radio('recomendacion','Si',($paciente->referencia)?TRUE:FALSE);?> /><label>S&iacute;</label>			<input type="radio" onclick='$("#info_referencia").css("display","none")' name="recomendacion" value="No" <?php echo set_radio('recomendacion','No',(!$paciente->referencia)?TRUE:FALSE);?> /><label>No</label>			<?php echo form_error('recomendacion')?>		</div>		<div id="info_referencia" style="display: none" class="lineal">			<label>Referencia:</label><input type="text" name="referencia" size="35" maxlength="50" value="<?php echo set_value('referencia',$paciente->referencia);?>" /><?php echo form_error('referencia')?>		</div>	</fieldset>	<fieldset>		<legend>Informaci&oacute;n Fiscal</legend>		<div class="lineal">			<label>¿Requiere Facturaci&oacute;n?</label>			<input type="radio" onclick='$("#info_fiscal").toggle(200)' name="facturacion" value="Si" <?php echo set_radio('facturacion','Si',($paciente->rfc)?TRUE:FALSE);?> /><label>S&iacute;</label>			<input type="radio" onclick='$("#info_fiscal").css("display","none")' name="facturacion" value="No" <?php echo set_radio('facturacion','No',(!$paciente->rfc)?TRUE:FALSE);?> /><label>No</label>			<?php echo form_error('facturacion')?>		</div>		<div id="info_fiscal" style="display: none">		<div class="lineal">			<label>R.F.C.</label><input type="text" name="rfc" value="<?php echo set_value('rfc',$paciente->rfc);?>" /><?php echo form_error('rfc')?>		</div>		<fieldset>			<legend>Direcci&oacute;n</legend>				<div class="lineal">					<label>Calle:</label><input type="text" name="fiscal_calle" value="<?php echo set_value('fiscal_calle',($direccion_fiscal)?$direccion_fiscal->calle:'');?>" /><?php echo form_error('fiscal_calle')?>					<label>N&uacute;m.Exterior:</label><input type="text" size="4" name="fiscal_num_ext" value="<?php echo set_value('fiscal_num_ext',($direccion_fiscal)?$direccion_fiscal->num_ext:'');?>" /><?php echo form_error('fiscal_num_ext')?>					<label>N&uacute;m.Interior:</label><input type="text" size="4" name="fiscal_num_int" value="<?php echo set_value('fiscal_num_int',($direccion_fiscal)?$direccion_fiscal->num_int:'');?>" /><?php echo form_error('fiscal_num_int')?>					<label>Colonia:</label><input type="text" name="fiscal_colonia" value="<?php echo set_value('fiscal_colonia',($direccion_fiscal)?$direccion_fiscal->colonia:'');?>" /><?php echo form_error('fiscal_colonia')?>				</div>				<div class="lineal">							<label>Ciudad:</label><input type="text" name="fiscal_ciudad" value="<?php echo set_value('fiscal_ciudad',($direccion_fiscal)?$direccion_fiscal->ciudad:'');?>" /><?php echo form_error('fiscal_ciudad')?>					<label>Estado:</label>					<select name="fiscal_estado">						<?php if($direccion_fiscal){?>						<option <?php echo set_select('estado','Aguascalientes',($direccion_fiscal->estado=='Aguascalientes')?TRUE:FALSE);?>>Aguascalientes</option>						<option <?php echo set_select('estado','Baja California',($direccion_fiscal->estado=='Baja California')?TRUE:FALSE);?>>Baja California</option>						<option <?php echo set_select('estado','Baja California Sur',($direccion_fiscal->estado=='Baja California Sur')?TRUE:FALSE);?>>Baja California Sur</option>						<option <?php echo set_select('estado','Campeche',($direccion_fiscal->estado=='Campeche')?TRUE:FALSE);?>>Campeche</option>						<option  <?php echo set_select('estado','Chiapas',($direccion_fiscal->estado=='Chiapas')?TRUE:FALSE);?>>Chiapas</option>						<option <?php echo set_select('estado','Chihuahua',($direccion_fiscal->estado=='Chihuahua')?TRUE:FALSE);?>>Chihuahua</option>						<option <?php echo set_select('estado','Coahuila',($direccion_fiscal->estado=='Coahuila')?TRUE:FALSE);?>>Coahuila</option>						<option <?php echo set_select('estado','Colima',($direccion_fiscal->estado=='Colima')?TRUE:FALSE);?>>Colima</option>						<option <?php echo set_select('estado','Distrito Federal',($direccion_fiscal->estado=='Distrito Federal')?TRUE:FALSE);?>>Distrito Federal</option>						<option <?php echo set_select('estado','Durango',($direccion_fiscal->estado=='Durango')?TRUE:FALSE);?>>Durango</option>						<option <?php echo set_select('estado','Guanajuato',($direccion_fiscal->estado=='Guanajuato')?TRUE:FALSE);?>>Guanajuato</option>						<option <?php echo set_select('estado','Guerrero',($direccion_fiscal->estado=='Guerrero')?TRUE:FALSE);?>>Guerrero</option>						<option <?php echo set_select('estado','Hidalgo',($direccion_fiscal->estado=='Hidalgo')?TRUE:FALSE);?>>Hidalgo</option>						<option <?php echo set_select('estado','Jalisco',($direccion_fiscal->estado=='Jalisco')?TRUE:FALSE);?>>Jalisco</option>						<option value="México" <?php echo set_select('estado','México',($direccion_fiscal->estado=='México')?TRUE:FALSE);?>>M&eacute;xico</option>						<option value="Michoacán" <?php echo set_select('estado','Michoacán',($direccion_fiscal->estado=='Michoacán')?TRUE:FALSE);?>>Michoac&aacute;n</option>						<option <?php echo set_select('estado','Morelos',($direccion_fiscal->estado=='Morelos')?TRUE:FALSE);?>>Morelos</option>						<option <?php echo set_select('estado','Nayarit',($direccion_fiscal->estado=='Nayarit')?TRUE:FALSE);?>>Nayarit</option>						<option value="Nuevo León" <?php echo set_select('estado','Nuevo León',($direccion_fiscal->estado=='Nuevo León')?TRUE:FALSE);?>>Nuevo Le&oacute;n</option>						<option <?php echo set_select('estado','Oaxaca',($direccion_fiscal->estado=='Oaxaca')?TRUE:FALSE);?>>Oaxaca</option>						<option <?php echo set_select('estado','Puebla',($direccion_fiscal->estado=='Puebla')?TRUE:FALSE);?>>Puebla</option>						<option value="Querétaro" <?php echo set_select('estado','Querétaro',($direccion_fiscal->estado=='Querétaro')?TRUE:FALSE);?>>Quer&eacute;taro</option>						<option <?php echo set_select('estado','Quintana Roo',($direccion_fiscal->estado=='Quintana Roo')?TRUE:FALSE);?>>Quintana Roo</option>						<option value="San Luis Potosí" <?php echo set_select('estado','San Luis Potosí',($direccion_fiscal->estado=='San Luis Potosí')?TRUE:FALSE);?>>San Luis Potos&iacute;</option>						<option <?php echo set_select('estado','Sinaloa',($direccion_fiscal->estado=='Sinaloa')?TRUE:FALSE);?>>Sinaloa</option>						<option <?php echo set_select('estado','Sonora',($direccion_fiscal->estado=='Sonora')?TRUE:FALSE);?>>Sonora</option>						<option <?php echo set_select('estado','Tabasco',($direccion_fiscal->estado=='Tabasco')?TRUE:FALSE);?>>Tabasco</option>						<option <?php echo set_select('estado','Tamaulipas',($direccion_fiscal->estado=='Tamaulipas')?TRUE:FALSE);?>>Tamaulipas</option>						<option <?php echo set_select('estado','Tlaxcala',($direccion_fiscal->estado=='Tlaxcala')?TRUE:FALSE);?>>Tlaxcala</option>						<option <?php echo set_select('estado','Veracruz',($direccion_fiscal->estado=='Veracruz')?TRUE:FALSE);?>>Veracruz</option>						<option value="Yucatán" <?php echo set_select('estado','Yucatán',($direccion_fiscal->estado=='Yucatán')?TRUE:FALSE);?>>Yucat&aacute;n</option>						<option <?php echo set_select('estado','Zacatecas',($direccion_fiscal->estado=='Zacatecas')?TRUE:FALSE);?>>Zacatecas</option>						<?php }else{?>						<option <?php echo set_select('fiscal_estado','Aguascalientes');?>>Aguascalientes</option>						<option <?php echo set_select('fiscal_estado','Baja California');?>>Baja California</option>						<option <?php echo set_select('fiscal_estado','Baja California Sur');?>>Baja California Sur</option>						<option <?php echo set_select('fiscal_estado','Campeche');?>>Campeche</option>						<option  <?php echo set_select('fiscal_estado','Chiapas');?>>Chiapas</option>						<option <?php echo set_select('fiscal_estado','Chihuahua');?>>Chihuahua</option>						<option <?php echo set_select('fiscal_estado','Coahuila');?>>Coahuila</option>						<option <?php echo set_select('fiscal_estado','Colima');?>>Colima</option>						<option <?php echo set_select('fiscal_estado','Distrito Federal');?>>Distrito Federal</option>						<option <?php echo set_select('fiscal_estado','Durango');?>>Durango</option>						<option <?php echo set_select('fiscal_estado','Guanajuato');?>>Guanajuato</option>						<option <?php echo set_select('fiscal_estado','Guerrero');?>>Guerrero</option>						<option <?php echo set_select('fiscal_estado','Hidalgo');?>>Hidalgo</option>						<option <?php echo set_select('fiscal_estado','Jalisco');?>>Jalisco</option>						<option value="México" <?php echo set_select('fiscal_estado','México');?>>M&eacute;xico</option>						<option value="Michoacán" <?php echo set_select('fiscal_estado','Michoacán');?>>Michoac&aacute;n</option>						<option <?php echo set_select('fiscal_estado','Morelos');?>>Morelos</option>						<option <?php echo set_select('fiscal_estado','Nayarit');?>>Nayarit</option>						<option value="Nuevo León" <?php echo set_select('fiscal_estado','Nuevo León');?>>Nuevo Le&oacute;n</option>						<option <?php echo set_select('fiscal_estado','Oaxaca');?>>Oaxaca</option>						<option <?php echo set_select('fiscal_estado','Puebla',TRUE);?>>Puebla</option>						<option value="Querétaro" <?php echo set_select('fiscal_estado','Querétaro');?>>Quer&eacute;taro</option>						<option <?php echo set_select('fiscal_estado','Quintana Roo');?>>Quintana Roo</option>						<option value="San Luis Potosí" <?php echo set_select('fiscal_estado','San Luis Potosí');?>>San Luis Potos&iacute;</option>						<option <?php echo set_select('fiscal_estado','Sinaloa');?>>Sinaloa</option>						<option <?php echo set_select('fiscal_estado','Sonora');?>>Sonora</option>						<option <?php echo set_select('fiscal_estado','Tabasco');?>>Tabasco</option>						<option <?php echo set_select('fiscal_estado','Tamaulipas');?>>Tamaulipas</option>						<option <?php echo set_select('fiscal_estado','Tlaxcala');?>>Tlaxcala</option>						<option <?php echo set_select('fiscal_estado','Veracruz');?>>Veracruz</option>						<option value="Yucatán" <?php echo set_select('fiscal_estado','Yucatán');?>>Yucat&aacute;n</option>						<option <?php echo set_select('fiscal_estado','Zacatecas');?>>Zacatecas</option>						<?php }?>					</select>					<?php echo form_error('fiscal_estado')?>					<label>C.P.:</label><input type="text" name="fiscal_cp" value="<?php echo set_value('fiscal_cp',($direccion_fiscal)?$direccion_fiscal->cp:'');?>" /><?php echo form_error('fiscal_cp')?>				</div>		</fieldset>		</div>	</fieldset>	<div class="botones" align="center">		<input type="submit" value="Guardar" />		<input type="reset" value="Restaurar" />	</div></div>	
</form>