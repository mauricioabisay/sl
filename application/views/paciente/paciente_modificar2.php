<form id="formulario" action="<?php echo site_url();?>/paciente/modificar/<?php $paciente->id?>" method="post" enctype="multipart/form-data" style="width:100%">
	<input type="hidden" value="<?php echo $paciente->id;?>" name="paciente_id" />
<div class="columnaizq">	
	<fieldset>
		<legend>Informaci&oacute;n Personal</legend>
		<fieldset class="columnaizq">
		<legend>Datos Personales</legend>
			<label>Nombre(s):</label><input type="text" name="nombre" value="<?php echo set_value('nombre',$paciente->nombre);?>"/>
			<label>Apellido Paterno:</label><input type="text" name="ap" value="<?php echo set_value('ap',$paciente->ap);?>" />
			<label>Apellido Materno</label><input type="text" name="am" value="<?php echo set_value('am',$paciente->am);?>" />
			<label>Fecha Nacimiento:</label>
			<span class="lineal">
				<input class="date_fecha" type="text" name="fecha_nac" onchange="$('#edad').text(calcularEdad($(this).val()))" value="<?php echo set_value('fecha_nac',$paciente->fecha_nac);?>" />
				<label id="edad"></label>
				<?php echo form_error('fecha_nac')?>
			</span>
			<label>Ocupaci&oacute;n:</label><input type="text" name="ocupacion" value="<?php echo set_value('ocupacion',$paciente->ocupacion);?>" />
			<label>¿C&oacute;mo le gusta que le digan?:</label><input type="text" name="nick" value="<?php echo set_value('nick',$paciente->nick);?>" />
			<label>Sexo:</label>
			<div class="lineal">
				<input type="radio" name="sexo" value="Masculino" <?php echo set_radio('sexo','Masculino',($paciente->sexo=='Masculino')?TRUE:FALSE);?> /><label>Masculino</label>
				<input type="radio" name="sexo" value="Femenino" <?php echo set_radio('sexo','Femenino',($paciente->sexo=='Femenino')?TRUE:FALSE);?> /><label>Femenino</label>
			</div>
			<div class="lineal">
				<label>Edo. Civil:</label>
				<select name="edo_civil">
					<option value="Soltero" <?php echo set_select('edo_civil','Soltero',($paciente->edo_civil=='Soltero')?TRUE:FALSE);?>>Soltero</option>
					<option value="Casado" <?php echo set_select('edo_civil','Casado',($paciente->edo_civil=='Casado')?TRUE:FALSE);?>>Casado</option>
					<option value="Divorciado" <?php echo set_select('edo_civil','Divorciado',($paciente->edo_civil=='Divorciado')?TRUE:FALSE);?>>Divorciado</option>
					<option value="U.Libre" <?php echo set_select('edo_civil','U.Libre',($paciente->edo_civil=='U.Libre')?TRUE:FALSE);?>>U.Libre</option>
				</select>
			</div>
		</fieldset>
		<fieldset class="columnader">
			<legend>Fotograf&iacute;a:</legend>
			<img src="<?php echo base_url();?>/assets/img/paciente/<?php echo $paciente->id;?>.png" width="108" height="120" />
			<label>Fotograf&iacute;a:</label><input type="file" name="foto" value="<?php echo set_value('foto');?>" />
		</fieldset>
	</fieldset>
<?php if($direccion){?>
	<fieldset>
		<legend>Direcci&oacute;n</legend>
		<div class="lineal">
			<label>Calle:</label><input type="text" name="calle" value="<?php echo set_value('calle',$direccion->calle);?>" />
			<label>N&uacute;m.Exterior:</label><input type="text" size="4" name="num_ext" value="<?php echo set_value('num_ext',$direccion->num_ext);?>" />
			<label>N&uacute;m.Interior:</label><input type="text" size="4" name="num_int" value="<?php echo set_value('num_int',$direccion->num_int);?>" />
			<label>Colonia:</label><input type="text" name="colonia" value="<?php echo set_value('colonia',$direccion->colonia);?>" />
			
		</div>
		<div class="lineal">		
			<label>Ciudad:</label><input type="text" name="ciudad" value="<?php echo set_value('ciudad',$direccion->ciudad);?>" />
			<label>Estado:</label>
			<select name="estado">
				<option <?php echo set_select('estado','Aguascalientes',($direccion->estado=='Aguascalientes')?TRUE:FALSE);?>>Aguascalientes</option>
				<option <?php echo set_select('estado','Baja California',($direccion->estado=='Baja California')?TRUE:FALSE);?>>Baja California</option>
				<option <?php echo set_select('estado','Baja California Sur',($direccion->estado=='Baja California Sur')?TRUE:FALSE);?>>Baja California Sur</option>
				<option <?php echo set_select('estado','Campeche',($direccion->estado=='Campeche')?TRUE:FALSE);?>>Campeche</option>
				<option  <?php echo set_select('estado','Chiapas',($direccion->estado=='Chiapas')?TRUE:FALSE);?>>Chiapas</option>
				<option <?php echo set_select('estado','Chihuahua',($direccion->estado=='Chihuahua')?TRUE:FALSE);?>>Chihuahua</option>
				<option <?php echo set_select('estado','Coahuila',($direccion->estado=='Coahuila')?TRUE:FALSE);?>>Coahuila</option>
				<option <?php echo set_select('estado','Colima',($direccion->estado=='Colima')?TRUE:FALSE);?>>Colima</option>
				<option <?php echo set_select('estado','Distrito Federal',($direccion->estado=='Distrito Federal')?TRUE:FALSE);?>>Distrito Federal</option>
				<option <?php echo set_select('estado','Durango',($direccion->estado=='Durango')?TRUE:FALSE);?>>Durango</option>
				<option <?php echo set_select('estado','Guanajuato',($direccion->estado=='Guanajuato')?TRUE:FALSE);?>>Guanajuato</option>
				<option <?php echo set_select('estado','Guerrero',($direccion->estado=='Guerrero')?TRUE:FALSE);?>>Guerrero</option>
				<option <?php echo set_select('estado','Hidalgo',($direccion->estado=='Hidalgo')?TRUE:FALSE);?>>Hidalgo</option>
				<option <?php echo set_select('estado','Jalisco',($direccion->estado=='Jalisco')?TRUE:FALSE);?>>Jalisco</option>
				<option value="México" <?php echo set_select('estado','México',($direccion->estado=='México')?TRUE:FALSE);?>>M&eacute;xico</option>
				<option value="Michoacán" <?php echo set_select('estado','Michoacán',($direccion->estado=='Michoacán')?TRUE:FALSE);?>>Michoac&aacute;n</option>
				<option <?php echo set_select('estado','Morelos',($direccion->estado=='Morelos')?TRUE:FALSE);?>>Morelos</option>
				<option <?php echo set_select('estado','Nayarit',($direccion->estado=='Nayarit')?TRUE:FALSE);?>>Nayarit</option>
				<option value="Nuevo León" <?php echo set_select('estado','Nuevo León',($direccion->estado=='Nuevo León')?TRUE:FALSE);?>>Nuevo Le&oacute;n</option>
				<option <?php echo set_select('estado','Oaxaca',($direccion->estado=='Oaxaca')?TRUE:FALSE);?>>Oaxaca</option>
				<option <?php echo set_select('estado','Puebla',($direccion->estado=='Puebla')?TRUE:FALSE);?>>Puebla</option>
				<option value="Querétaro" <?php echo set_select('estado','Querétaro',($direccion->estado=='Querétaro')?TRUE:FALSE);?>>Quer&eacute;taro</option>
				<option <?php echo set_select('estado','Quintana Roo',($direccion->estado=='Quintana Roo')?TRUE:FALSE);?>>Quintana Roo</option>
				<option value="San Luis Potosí" <?php echo set_select('estado','San Luis Potosí',($direccion->estado=='San Luis Potosí')?TRUE:FALSE);?>>San Luis Potos&iacute;</option>
				<option <?php echo set_select('estado','Sinaloa',($direccion->estado=='Sinaloa')?TRUE:FALSE);?>>Sinaloa</option>
				<option <?php echo set_select('estado','Sonora',($direccion->estado=='Sonora')?TRUE:FALSE);?>>Sonora</option>
				<option <?php echo set_select('estado','Tabasco',($direccion->estado=='Tabasco')?TRUE:FALSE);?>>Tabasco</option>
				<option <?php echo set_select('estado','Tamaulipas',($direccion->estado=='Tamaulipas')?TRUE:FALSE);?>>Tamaulipas</option>
				<option <?php echo set_select('estado','Tlaxcala',($direccion->estado=='Tlaxcala')?TRUE:FALSE);?>>Tlaxcala</option>
				<option <?php echo set_select('estado','Veracruz',($direccion->estado=='Veracruz')?TRUE:FALSE);?>>Veracruz</option>
				<option value="Yucatán" <?php echo set_select('estado','Yucatán',($direccion->estado=='Yucatán')?TRUE:FALSE);?>>Yucat&aacute;n</option>
				<option <?php echo set_select('estado','Zacatecas',($direccion->estado=='Zacatecas')?TRUE:FALSE);?>>Zacatecas</option>
			</select>
			<label>C.P.:</label><input type="text" name="cp" value="<?php echo set_value('cp',$direccion->cp);?>" />
		</div>
	</fieldset>
<?php }else{?>
	<fieldset>
		<legend>Direcci&oacute;n</legend>
		<div class="lineal">
			<label>Calle:</label><input type="text" name="calle" value="<?php echo set_value('calle');?>" /><?php echo form_error('calle')?>
			<label>N&uacute;m.Exterior:</label><input type="text" size="4" name="num_ext" value="<?php echo set_value('num_ext');?>" /><?php echo form_error('num_ext')?>
			<label>N&uacute;m.Interior:</label><input type="text" size="4" name="num_int" value="<?php echo set_value('num_int');?>" /><?php echo form_error('num_int')?>
			<label>Colonia:</label><input size="15" type="text" name="colonia" value="<?php echo set_value('colonia');?>" /><?php echo form_error('colonia')?>
		</div>
		<div class="lineal">		
			<label>Ciudad:</label><input type="text" name="ciudad" value="<?php echo set_value('ciudad');?>" /><?php echo form_error('ciudad')?>
			<label>Estado:</label>
			<select name="estado">
				<option <?php echo set_select('estado','Aguascalientes');?>>Aguascalientes</option>
				<option <?php echo set_select('estado','Baja California');?>>Baja California</option>
				<option <?php echo set_select('estado','Baja California Sur');?>>Baja California Sur</option>
				<option <?php echo set_select('estado','Campeche');?>>Campeche</option>
				<option  <?php echo set_select('estado','Chiapas');?>>Chiapas</option>
				<option <?php echo set_select('estado','Chihuahua');?>>Chihuahua</option>
				<option <?php echo set_select('estado','Coahuila');?>>Coahuila</option>
				<option <?php echo set_select('estado','Colima');?>>Colima</option>
				<option <?php echo set_select('estado','Distrito Federal');?>>Distrito Federal</option>
				<option <?php echo set_select('estado','Durango');?>>Durango</option>
				<option <?php echo set_select('estado','Guanajuato');?>>Guanajuato</option>
				<option <?php echo set_select('estado','Guerrero');?>>Guerrero</option>
				<option <?php echo set_select('estado','Hidalgo');?>>Hidalgo</option>
				<option <?php echo set_select('estado','Jalisco');?>>Jalisco</option>
				<option value="México" <?php echo set_select('estado','México');?>>M&eacute;xico</option>
				<option value="Michoacán" <?php echo set_select('estado','Michoacán');?>>Michoac&aacute;n</option>
				<option <?php echo set_select('estado','Morelos');?>>Morelos</option>
				<option <?php echo set_select('estado','Nayarit');?>>Nayarit</option>
				<option value="Nuevo León" <?php echo set_select('estado','Nuevo León');?>>Nuevo Le&oacute;n</option>
				<option <?php echo set_select('estado','Oaxaca');?>>Oaxaca</option>
				<option <?php echo set_select('estado','Puebla',TRUE);?>>Puebla</option>
				<option value="Querétaro" <?php echo set_select('estado','Querétaro');?>>Quer&eacute;taro</option>
				<option <?php echo set_select('estado','Quintana Roo');?>>Quintana Roo</option>
				<option value="San Luis Potosí" <?php echo set_select('estado','San Luis Potosí');?>>San Luis Potos&iacute;</option>
				<option <?php echo set_select('estado','Sinaloa');?>>Sinaloa</option>
				<option <?php echo set_select('estado','Sonora');?>>Sonora</option>
				<option <?php echo set_select('estado','Tabasco');?>>Tabasco</option>
				<option <?php echo set_select('estado','Tamaulipas');?>>Tamaulipas</option>
				<option <?php echo set_select('estado','Tlaxcala');?>>Tlaxcala</option>
				<option <?php echo set_select('estado','Veracruz');?>>Veracruz</option>
				<option value="Yucatán" <?php echo set_select('estado','Yucatán');?>>Yucat&aacute;n</option>
				<option <?php echo set_select('estado','Zacatecas');?>>Zacatecas</option>
			</select>
			<?php echo form_error('estado')?>
			<label>C.P.:</label><input type="text" name="cp" value="<?php echo set_value('cp');?>" /><?php echo form_error('cp')?>
		</div>
	</fieldset>
<?php }?>
</div>
<div class="columnader">
	<fieldset>
		<legend>Informaci&oacute;n de Contacto</legend>
		<fieldset class="columnaizq">
			<legend>Tel&eacute;fonos</legend>
			<div class="lineal">
				<label>Tel. Oficina:</label>
				<input type="text" size="10" name="tel_oficina" value="<?php echo set_value('tel_oficina',$paciente->tel_oficina);?>" />
				<label>Ext.:</label>
				<input type="text" size="3" name="ext_oficina" value="<?php echo set_value('ext_oficina',$paciente->ext_oficina);?>" />
			</div>
			<div class="lineal">
				<label>Tel. Casa:</label><input type="text" size="10" name="tel_casa" value="<?php echo set_value('tel_casa',$paciente->tel_casa);?>" />
			</div>
			<div class="lineal">
				<label>Celular 1:</label><input type="text" size="10" name="cel1" value="<?php echo set_value('cel1',$paciente->cel1);?>" />
			</div>
			<div class="lineal">
				<label>Celular 2:</label><input type="text" size="10" name="cel2" value="<?php echo set_value('cel2',$paciente->cel2);?>" />
			</div>
		</fieldset>
		<fieldset class="columnader">
			<legend>E-mail</legend>
			<label>E-mail 1:</label><input type="text" size="45" name="mail1" value="<?php echo set_value('mail1',$paciente->mail1);?>" />
			<label>E-mail 2:</label><input type="text" size="45" name="mail2" value="<?php echo set_value('mail2',$paciente->mail2);?>" />
			<label>E-mail 3:</label><input type="text" size="45" name="mail3" value="<?php echo set_value('mail3',$paciente->mail3);?>" />
		</fieldset>
	</fieldset>
	<fieldset>
		<legend>Informaci&oacute;n Fiscal</legend>
		<?php if($direccion_fiscal!=FALSE){?>
		<div class="lineal"><label>R.F.C.</label><input type="text" name="rfc" value="<?php echo set_value('rfc',$paciente->rfc);?>" /></div>
		<fieldset>
			<legend>Direcci&oacute;n</legend>
				<div class="lineal">
					<label>Calle:</label><input type="text" name="fiscal_calle" value="<?php echo set_value('fiscal_calle',$direccion_fiscal->calle);?>" />
					<label>Interior:</label><input type="text" size="4" name="fiscal_int" value="<?php echo set_value('fiscal_int',$direccion_fiscal->num_int);?>" />
					<label>Exterior:</label><input type="text" size="4" name="fiscal_ext" value="<?php echo set_value('fiscal_ext',$direccion_fiscal->num_ext);?>" />
					<label>Colonia:</label><input type="text" name="fiscal_colonia" value="<?php echo set_value('fiscal_colonia',$direccion_fiscal->colonia);?>" />
				</div>
				<div class="lineal">		
					<label>Ciudad:</label><input type="text" name="fiscal_ciudad" value="<?php echo set_value('fiscal_ciudad',$direccion_fiscal->ciudad);?>" />
					<label>Estado:</label>
					<select name="fiscal_estado">
						<option <?php echo set_select('estado','Aguascalientes',($direccion_fiscal->estado=='Aguascalientes')?TRUE:FALSE);?>>Aguascalientes</option>
						<option <?php echo set_select('estado','Baja California',($direccion_fiscal->estado=='Baja California')?TRUE:FALSE);?>>Baja California</option>
						<option <?php echo set_select('estado','Baja California Sur',($direccion_fiscal->estado=='Baja California Sur')?TRUE:FALSE);?>>Baja California Sur</option>
						<option <?php echo set_select('estado','Campeche',($direccion_fiscal->estado=='Campeche')?TRUE:FALSE);?>>Campeche</option>
						<option  <?php echo set_select('estado','Chiapas',($direccion_fiscal->estado=='Chiapas')?TRUE:FALSE);?>>Chiapas</option>
						<option <?php echo set_select('estado','Chihuahua',($direccion_fiscal->estado=='Chihuahua')?TRUE:FALSE);?>>Chihuahua</option>
						<option <?php echo set_select('estado','Coahuila',($direccion_fiscal->estado=='Coahuila')?TRUE:FALSE);?>>Coahuila</option>
						<option <?php echo set_select('estado','Colima',($direccion_fiscal->estado=='Colima')?TRUE:FALSE);?>>Colima</option>
						<option <?php echo set_select('estado','Distrito Federal',($direccion_fiscal->estado=='Distrito Federal')?TRUE:FALSE);?>>Distrito Federal</option>
						<option <?php echo set_select('estado','Durango',($direccion_fiscal->estado=='Durango')?TRUE:FALSE);?>>Durango</option>
						<option <?php echo set_select('estado','Guanajuato',($direccion_fiscal->estado=='Guanajuato')?TRUE:FALSE);?>>Guanajuato</option>
						<option <?php echo set_select('estado','Guerrero',($direccion_fiscal->estado=='Guerrero')?TRUE:FALSE);?>>Guerrero</option>
						<option <?php echo set_select('estado','Hidalgo',($direccion_fiscal->estado=='Hidalgo')?TRUE:FALSE);?>>Hidalgo</option>
						<option <?php echo set_select('estado','Jalisco',($direccion_fiscal->estado=='Jalisco')?TRUE:FALSE);?>>Jalisco</option>
						<option value="México" <?php echo set_select('estado','México',($direccion_fiscal->estado=='México')?TRUE:FALSE);?>>M&eacute;xico</option>
						<option value="Michoacán" <?php echo set_select('estado','Michoacán',($direccion_fiscal->estado=='Michoacán')?TRUE:FALSE);?>>Michoac&aacute;n</option>
						<option <?php echo set_select('estado','Morelos',($direccion_fiscal->estado=='Morelos')?TRUE:FALSE);?>>Morelos</option>
						<option <?php echo set_select('estado','Nayarit',($direccion_fiscal->estado=='Nayarit')?TRUE:FALSE);?>>Nayarit</option>
						<option value="Nuevo León" <?php echo set_select('estado','Nuevo León',($direccion_fiscal->estado=='Nuevo León')?TRUE:FALSE);?>>Nuevo Le&oacute;n</option>
						<option <?php echo set_select('estado','Oaxaca',($direccion_fiscal->estado=='Oaxaca')?TRUE:FALSE);?>>Oaxaca</option>
						<option <?php echo set_select('estado','Puebla',($direccion_fiscal->estado=='Puebla')?TRUE:FALSE);?>>Puebla</option>
						<option value="Querétaro" <?php echo set_select('estado','Querétaro',($direccion_fiscal->estado=='Querétaro')?TRUE:FALSE);?>>Quer&eacute;taro</option>
						<option <?php echo set_select('estado','Quintana Roo',($direccion_fiscal->estado=='Quintana Roo')?TRUE:FALSE);?>>Quintana Roo</option>
						<option value="San Luis Potosí" <?php echo set_select('estado','San Luis Potosí',($direccion_fiscal->estado=='San Luis Potosí')?TRUE:FALSE);?>>San Luis Potos&iacute;</option>
						<option <?php echo set_select('estado','Sinaloa',($direccion_fiscal->estado=='Sinaloa')?TRUE:FALSE);?>>Sinaloa</option>
						<option <?php echo set_select('estado','Sonora',($direccion_fiscal->estado=='Sonora')?TRUE:FALSE);?>>Sonora</option>
						<option <?php echo set_select('estado','Tabasco',($direccion_fiscal->estado=='Tabasco')?TRUE:FALSE);?>>Tabasco</option>
						<option <?php echo set_select('estado','Tamaulipas',($direccion_fiscal->estado=='Tamaulipas')?TRUE:FALSE);?>>Tamaulipas</option>
						<option <?php echo set_select('estado','Tlaxcala',($direccion_fiscal->estado=='Tlaxcala')?TRUE:FALSE);?>>Tlaxcala</option>
						<option <?php echo set_select('estado','Veracruz',($direccion_fiscal->estado=='Veracruz')?TRUE:FALSE);?>>Veracruz</option>
						<option value="Yucatán" <?php echo set_select('estado','Yucatán',($direccion_fiscal->estado=='Yucatán')?TRUE:FALSE);?>>Yucat&aacute;n</option>
						<option <?php echo set_select('estado','Zacatecas',($direccion_fiscal->estado=='Zacatecas')?TRUE:FALSE);?>>Zacatecas</option>
					</select>
					<label>C.P.:</label><input type="text" name="fiscal_cp" value="<?php echo set_value('fiscal_cp',$direccion_fiscal->cp);?>" />
				</div>
		</fieldset>
		<?php }else{?>
		<div class="lineal"><label>R.F.C.</label><input type="text" name="rfc" value="<?php echo set_value('rfc');?>" /></div>
		<fieldset>
			<legend>Direcci&oacute;n</legend>
				<div class="lineal">
					<label>Calle:</label><input type="text" name="fiscal_calle" value="<?php echo set_value('fiscal_calle');?>" />
					<label>Interior:</label><input type="text" size="4" name="fiscal_int" value="<?php echo set_value('fiscal_int');?>" />
					<label>Exterior:</label><input type="text" size="4" name="fiscal_ext" value="<?php echo set_value('fiscal_ext');?>" />
					<label>Colonia:</label><input type="text" name="fiscal_colonia" value="<?php echo set_value('fiscal_colonia');?>" />
				</div>
				<div class="lineal">		
					<label>Ciudad:</label><input type="text" name="fiscal_ciudad" value="<?php echo set_value('fiscal_ciudad');?>" />
					<label>Estado:</label>
					<select name="fiscal_estado">
						<option <?php echo set_select('fiscal_estado','Aguascalientes');?>>Aguascalientes</option>
						<option <?php echo set_select('fiscal_estado','Baja California');?>>Baja California</option>
						<option <?php echo set_select('fiscal_estado','Baja California Sur');?>>Baja California Sur</option>
						<option <?php echo set_select('fiscal_estado','Campeche');?>>Campeche</option>
						<option  <?php echo set_select('fiscal_estado','Chiapas');?>>Chiapas</option>
						<option <?php echo set_select('fiscal_estado','Chihuahua');?>>Chihuahua</option>
						<option <?php echo set_select('fiscal_estado','Coahuila');?>>Coahuila</option>
						<option <?php echo set_select('fiscal_estado','Colima');?>>Colima</option>
						<option <?php echo set_select('fiscal_estado','Distrito Federal');?>>Distrito Federal</option>
						<option <?php echo set_select('fiscal_estado','Durango');?>>Durango</option>
						<option <?php echo set_select('fiscal_estado','Guanajuato');?>>Guanajuato</option>
						<option <?php echo set_select('fiscal_estado','Guerrero');?>>Guerrero</option>
						<option <?php echo set_select('fiscal_estado','Hidalgo');?>>Hidalgo</option>
						<option <?php echo set_select('fiscal_estado','Jalisco');?>>Jalisco</option>
						<option value="México" <?php echo set_select('fiscal_estado','México');?>>M&eacute;xico</option>
						<option value="Michoacán" <?php echo set_select('fiscal_estado','Michoacán');?>>Michoac&aacute;n</option>
						<option <?php echo set_select('fiscal_estado','Morelos');?>>Morelos</option>
						<option <?php echo set_select('fiscal_estado','Nayarit');?>>Nayarit</option>
						<option value="Nuevo León" <?php echo set_select('fiscal_estado','Nuevo León');?>>Nuevo Le&oacute;n</option>
						<option <?php echo set_select('fiscal_estado','Oaxaca');?>>Oaxaca</option>
						<option <?php echo set_select('fiscal_estado','Puebla','TRUE');?>>Puebla</option>
						<option value="Querétaro" <?php echo set_select('fiscal_estado','Querétaro');?>>Quer&eacute;taro</option>
						<option <?php echo set_select('fiscal_estado','Quintana Roo');?>>Quintana Roo</option>
						<option value="San Luis Potosí" <?php echo set_select('fiscal_estado','San Luis Potosí');?>>San Luis Potos&iacute;</option>
						<option <?php echo set_select('fiscal_estado','Sinaloa');?>>Sinaloa</option>
						<option <?php echo set_select('fiscal_estado','Sonora');?>>Sonora</option>
						<option <?php echo set_select('fiscal_estado','Tabasco');?>>Tabasco</option>
						<option <?php echo set_select('fiscal_estado','Tamaulipas');?>>Tamaulipas</option>
						<option <?php echo set_select('fiscal_estado','Tlaxcala');?>>Tlaxcala</option>
						<option <?php echo set_select('fiscal_estado','Veracruz');?>>Veracruz</option>
						<option value="Yucatán" <?php echo set_select('fiscal_estado','Yucatán');?>>Yucat&aacute;n</option>
						<option <?php echo set_select('fiscal_estado','Zacatecas');?>>Zacatecas</option>
					</select>
					<label>C.P.:</label><input type="text" name="fiscal_cp" value="<?php echo set_value('fiscal_cp');?>" />
				</div>
			</fieldset>
		<?php }?>
	</fieldset>
</div>
	<div class="botones" align="center">
		<input type="submit" value="Modificar" />
		<input type="reset" value="Restaurar" />
	</div>
</form>