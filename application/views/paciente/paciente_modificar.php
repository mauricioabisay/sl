<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<form id="formulario" action="<?php echo site_url();?>/paciente/modificar/<?php echo $paciente->id;?>" method="post" enctype="multipart/form-data" style="width: 100%">
			<span class="lineal"><input type="text" name="ap" value="<?php echo set_value('ap',$paciente->ap);?>" /><?php echo form_error('ap')?></span>
			<span class="lineal"><input type="text" name="am" value="<?php echo set_value('am',$paciente->am);?>" /><?php echo form_error('am')?></span>
			<span class="lineal">
			</div>
			<div class="lineal">
				<option value="México" <?php echo set_select('estado','México',($direccion)&&($direccion->estado=='México')?TRUE:FALSE);?>>M&eacute;xico</option>
<div class="columnader">
			<div class="lineal" style="padding-bottom: 1em;">
				<label>Tel.Casa:</label>
				<span>-</span><input type="text" maxlength="2" size="1" name="cel2_d4" value="<?php echo set_value('cel2_d4',substr($paciente->cel2,6,2));?>" />
	<fieldset>
		<legend>Servicio Alimentos Sabor and Light</legend>
		<div class="lineal">
			<label>¿Desea el Servicio de Alimentos Sabor and Light?</label>
			<input name="servicio_alimentos" type="radio" value="Si" <?php echo set_radio('servicio_alimentos','Si',($paciente->servicio_alimentos=='Si')?TRUE:FALSE);?>/><label>Si</label>
			<input name="servicio_alimentos" type="radio" value="No" <?php echo set_radio('servicio_alimentos','No',($paciente->servicio_alimentos=='No')?TRUE:FALSE);?>/><label>No</label>
			<?php echo form_error('servicio_alimentos');?>
		</div>
	</fieldset>
</form>