<?php
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<form id="formulario" action="<?php echo site_url();?>/usuario/agregar" method="post" style="width:100%">
	<fieldset>
	<legend>Datos de Usuario</legend>
	<fieldset>
		<legend>Datos Personales</legend>
		<div class="lineal">
			<label>Nombre:</label>
			<input type="text" name="nombre" size="30" maxlength="30"  /><?php echo form_error('nombre');?>
			<label>Ap. Paterno:</label>
			<input type="text" name="ap" size="30" maxlength="30"  /><?php echo form_error('ap');?>
			<label>Ap. Materno:</label>
			<input type="text" name="am" size="30" maxlength="30"  /><?php echo form_error('am');?>
		</div>
	</fieldset>
	<fieldset>
		<legend>Datos de Autenficaci&oacute;n</legend>
		<div class="lineal_eval">
			<label style="width:50%">Nombre de Usuario:</label>
			<input type="text" name="nick" size="30" maxlength="30"  /><?php echo form_error('nick');?>
		</div>
		<div class="lineal_eval">
			<label style="width:50%">Contrase&ntilde;a Temporal de Usuario:</label>
			<input type="password" name="pass" size="30" maxlength="30" /><?php echo form_error('pass');?>
		</div>
		<div class="lineal_eval">
			<label style="width:50%">Confirmar Contrase&ntilde;a Temporal de Usuario:</label>
			<input type="password" name="pass_confirm" size="30" maxlength="30" /><?php echo form_error('pass');?>
		</div>
		<div class="lineal_eval">
			<label style="width:50%">Tipo</label>
			<select id="tipo" name="tipo" onchange="($(this).val()<=2)?($('#horario_doctor').css('display','block')):($('#horario_doctor').css('display','none'));($(this).val()==1)?($('#horario_general').css('display','block')):($('#horario_general').css('display','none'));">
				<?php foreach($tipos_usuario as $tipo){?>
						<option value="<?php echo $tipo->id;?>" label="<?php echo $tipo->nombre;?>"><?php echo $tipo->nombre;?></option>
				<?php }?>
			</select>
			<label id="p1"></label>
		</div>
	</fieldset>
	<?php $this->load->view('usuario/extras/horario_agregar');?>
	</fieldset>
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar" />
	</div>
	</fieldset>
</form>