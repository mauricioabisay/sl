<html>
<head>
	<title>Laboratorios</title>
    <link type="text/css"rel="stylesheet"
     href="http://jquery-ui.googlecode.com/svn/tags/1.7/themes/redmond/jquery-ui.css" />   
  <script type="text/javascript"
     src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
   
  <script type="text/javascript">
      $(document).ready(function() {
          $('#txtFechaSimple').datepicker();
      });
      $(document).ready(function() {
          $('#txtFechaSimple2').datepicker();
      });
  </script> 
  <link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
  
  <script>
  	
	function activa_lab(accion)
		{
			document.formulario.bh.disabled = accion;
			document.formulario.qs_trigliceridos.disabled = accion;
			document.formulario.p_lipidos.disabled = accion;
			document.formulario.p_hepatico.disabled = accion;
			document.formulario.p_tiroideo.disabled = accion;
			document.formulario.p_tiroideo_anticuerpos.disabled = accion;
			document.formulario.tsh.disabled = accion;
			document.formulario.cortisol.disabled = accion;
			document.formulario.ant_prostatico.disabled = accion;
			document.formulario.ego.disabled = accion;
			document.formulario.fact_reumatoide.disabled = accion;
			document.formulario.glucosa_basal.disabled = accion;
			document.formulario.insulina_basal.disabled = accion;
			document.formulario.h_crecimiento.disabled = accion;
			document.formulario.otros.disabled = accion;
			document.formulario.curva_tolerancia.disabled = accion;
		}
  </script>
<body>
	<form action="http://localhost/alumnos/index.php/alta/alta_laboratorios" method="post" id="formulario" name="formulario">
		<?php $fecha_dia = date ("d"); 
			  $fecha_mes = date ("m"); 
			  $fecha_year = date ("Y");
		?>
		<div class="lineal">
		<label>Fecha:</label>
		<select name="fecha">
			<option><?php echo $fecha_dia."/".$fecha_mes."/".$fecha_year?></option>
		</select>
	</div>
	<fieldset>
		<legend>Solicitud de Laboratorios</legend>
		<div class="lineal">
			<label>&iquest;Tiene s&iacute;ntomas de debilidad, fatiga, angustia,
					cansancio, mareo, necesidad de consumir az&uacute;car,
					visi&oacute;n borrosa?</label>
			<label>S&iacute;</label><input type="radio" name="sintomas" value="si" onclick='$("#ocultar_sintomas").toggle(200)' <?php echo set_radio('sintomas','si');?>/>
			<label>No</label><input type="radio" name="sintomas" value="no" onclick='$("#ocultar_sintomas").toggle(!200)' <?php echo set_radio('sintomas','no');?>/>
		</div>
		<div class="lineal" id="ocultar_sintomas" style="display: <?php echo ($this->input->post('sintomas'))=='si'?'':'none'?>;">
			<label>&iquest;Cu&aacute;ntos s&iacute;ntomas?</label>
			<select name="cuantos_sintomas">
				<option <?php echo set_select('cuantos_sintomas','');?> value=""></option>
				<option <?php echo set_select('cuantos_sintomas','1');?>value="1">1</option>
				<option <?php echo set_select('cuantos_sintomas','2');?>value="2">2</option>
				<option <?php echo set_select('cuantos_sintomas','3');?>value="3">3</option>
				<option <?php echo set_select('cuantos_sintomas','4');?>value="4">4</option>
				<option <?php echo set_select('cuantos_sintomas','5');?>value="5">5</option>
				<option <?php echo set_select('cuantos_sintomas','6');?>value="6">6</option>
				<option <?php echo set_select('cuantos_sintomas','7');?>value="7">7</option>
			</select>
		</div>
		<div>
			<table>
				<tr>
					<td align="right">BH</td><td><input type="checkbox" name="laboratorios[]" value="bh" <?php echo set_checkbox('laboratorios','bh');?>/></td>
					<td align="right">Ant&iacute;geno prost&aacute;tico</td><td><input type="checkbox" name="laboratorios[]" value="ap" <?php echo set_checkbox('laboratorios','ap');?>/></td>
				</tr>
				<tr>
					<td align="right">QS con triglic&eacute;ridos</td><td><input type="checkbox" name="laboratorios[]" value="qs" <?php echo set_checkbox('laboratorios','qs');?>/></td>
					<td align="right">EGO</td><td><input type="checkbox" name="laboratorios[]" value="ego" <?php echo set_checkbox('laboratorios','ego');?>/></td>
				</tr>
				<tr>
					<td align="right">Perfil de l&iacute;pidos</td><td><input type="checkbox" name="laboratorios[]" value="p_lipidos" <?php echo set_checkbox('laboratorios','p_lipidos');?>/></td>
					<td align="right">Factor reumatoide</td><td><input type="checkbox" name="laboratorios[]" value="f_reumatoide" <?php echo set_checkbox('laboratorios','f_reumatoide');?>/></td>
				</tr>
				<tr>
					<td align="right">Perfil hep&aacute;tico</td><td><input type="checkbox" name="laboratorios[]" value="p_hepatico" <?php echo set_checkbox('laboratorios','p_hepatico');?>/></td>
					<td align="right">Curva de tolerancia de 4 horas</td><td><input type="checkbox" name="laboratorios[]" value="curva_tolerancia" <?php echo set_checkbox('laboratorios','curva_tolerancia');?>/></td>
				</tr>
				<tr>
					<td align="right">Perfil tiroideo</td><td><input type="checkbox" name="laboratorios[]" value="p_tiroideo" <?php echo set_checkbox('laboratorios','p_tiroideo');?>/></td>
					<td align="right">Glucosa basal y post-carga</td><td><input type="checkbox" name="laboratorios[]" value="glucosa_basal" <?php echo set_checkbox('laboratorios','glucosa_basal');?>/></td>
				</tr>
				<tr>
					<td align="right">Perfil tiroideo con anticuerpos</td><td><input type="checkbox" name="laboratorios[]" value="p_tiroideo_ca" <?php echo set_checkbox('laboratorios','p_tiroideo_ca');?>/></td>
					<td align="right">Insulina basal y post-carga</td><td><input type="checkbox" name="laboratorios[]" value="insulina_basal" <?php echo set_checkbox('laboratorios','insulina_basal');?>/></td>
				</tr>
				<tr>
					<td align="right">TSH</td><td><input type="checkbox" name="laboratorios[]" value="tsh" <?php echo set_checkbox('laboratorios','tsh');?>/></td>
					<td align="right">Hormona del crecimiento</td><td><input type="checkbox" name="laboratorios[]" value="hormona_crecimiento" <?php echo set_checkbox('laboratorios','hormona_crecimiento');?>/></td>
				</tr>
				<tr>
					<td align="right">Cortisol</td><td><input type="checkbox" name="laboratorios[]" value="cortisol" <?php echo set_checkbox('laboratorios','cortisol');?>/></td>
					<td align="right">Otros</td><td><input type="text" name="laboratorios_otros" value="<?php echo set_value('laboratorios_otros');?>"/></td>
				</tr>
			</table>
		</div>
	</fieldset>
		<?php echo form_error('sintomas')?>
		<?php echo form_error('cuantos_sintomas')?>
		<?php echo form_error('laboratorios')?>
		<?php echo form_error('laboratorios_otros')?>
	<fieldset>
		<legend>Recepci&oacute;n de Laboratorios</legend>
		<div class="lineal">
			<label>Fecha de recepci&oacute;n:</label>
			<input id="txtFechaSimple" type="text" name="calendario1" onchange="activa_lab(false)"/>
		</div>
		<div class="lineal">
			<label>Fecha de laboratorios:</label>
			<input id="txtFechaSimple2" type="text" name="calendario2"/>
		</div>
		<div>
			<table>
				<tr>
					<td align="right">BH</td><td><textarea rows="3" cols="20" name="bh" disabled="true"></textarea></td>
					<td align="right">Ant&iacute;geno prost&aacute;tico</td><td><textarea rows="3" cols="20" name="ant_prostatico" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">QS con triglic&eacute;ridos</td><td><textarea rows="3" cols="20" name="qs_trigliceridos" disabled="true"></textarea></td>
					<td align="right">EGO</td><td><textarea rows="3" cols="20" name="ego" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">Perfil de l&iacute;pidos</td><td><textarea rows="3" cols="20" name="p_lipidos" disabled="true"></textarea></td>
					<td align="right">Factor reumatoide</td><td><textarea rows="3" cols="20" name="fact_reumatoide" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">Perfil hep&aacute;tico</td><td><textarea rows="3" cols="20" name="p_hepatico" disabled="true"></textarea></td>
					<td align="right">Curva de tolerancia de 4 horas</td><td><textarea rows="3" cols="20" name="curva_tolerancia" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">Perfil tiroideo</td><td><textarea rows="3" cols="20" name="p_tiroideo" disabled="true"></textarea></td>
					<td align="right">Glucosa basal y post-carga</td><td><textarea rows="3" cols="20" name="glucosa_basal" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">Perfil tiroideo con anticuerpos</td><td><textarea rows="3" cols="20" name="p_tiroideo_anticuerpos" disabled="true"></textarea></td>
					<td align="right">Insulina basal y post-carga</td><td><textarea rows="3" cols="20" name="insulina_basal" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">TSH</td><td><textarea rows="3" cols="20" name="tsh" disabled="true"></textarea></td>
					<td align="right">Hormona del crecimiento</td><td><textarea rows="3" cols="20" name="h_crecimiento" disabled="true"></textarea></td>
				</tr>
				<tr>
					<td align="right">Cortisol</td><td><textarea rows="3" cols="20" name="cortisol" disabled="true"></textarea></td>
					<td align="right">Otros</td>
					<td>
						<textarea rows="6" cols="20" name="otros" disabled="true"></textarea>
					</td>
				</tr>
			</table>
		</div>
	</fieldset>
		<?php echo form_error('bh')?>
		<?php echo form_error('qs_trigliceridos')?>
		<?php echo form_error('p_lipidos')?>
		<?php echo form_error('p_hepatico')?>
		<?php echo form_error('p_tiroideo')?>
		<?php echo form_error('p_tiroideo_anticuerpos')?>
		<?php echo form_error('tsh')?>
		<?php echo form_error('cortisol')?>
		<?php echo form_error('ant_prostatico')?>
		<?php echo form_error('ego')?>
		<?php echo form_error('fact_reumatoide')?>
		<?php echo form_error('glucosa_basal')?>
		<?php echo form_error('insulina_basal')?>
		<?php echo form_error('h_crecimiento')?>
		<?php echo form_error('curva_tolerancia')?>
		<?php echo form_error('otros')?>
		
	<div class="botones" align="center">
		<input type="submit" value="Guardar y salir" />
		<input type="submit" value="Cancelar"/>
	</div>		
	</form>
</body>
</html>

