<fieldset>
	<legend>Solicitud de Laboratorios</legend>
<div id="laboratorio_solicitud">
	<div class="lineal">
		<label>&iquest;Tiene s&iacute;ntomas de debilidad, fatiga, angustia,
			cansancio, mareo, necesidad de consumir az&uacute;car,
			visi&oacute;n borrosa?</label>
		<?php echo $laboratorio->sintomas>0?'Sí':'No';?>
	</div>
	<div class="lineal" <?php (($laboratorio->sintomas>0))?'':'style="display:none"';?>>
		<label>&iquest;Cu&aacute;ntos s&iacute;ntomas?</label>
		<?php echo $laboratorio->sintomas;?>
	</div>
	<div class="lineal">
		<label>Fecha de Solicitud (Fecha en que se comunicó al paciente los estudios a realizar):</label>
		<?php $fecha_s = DateTime::createFromFormat('Y-m-d',$laboratorio->fecha_solicitud);echo ($fecha_s)?$fecha_s->format('d-m-Y'):'';?>
	</div>
	<div>
		<label>Estudios a solicitados:</label>
		<?php $estudios_std = explode(',', $laboratorio->especificacion);?>
		<?php foreach($laboratorios as $lab){?>
				<?php if(stristr($laboratorio->especificacion,$lab->id)&&($lab->id!='otros')){?>
					<span class="lineal"><label><strong><?php echo $lab->nombre;?></strong></label></span>
				<?php }?>
		<?php }?>
		<?php $estudios_otro = explode(',', $laboratorio->otros);$num=sizeof($estudios_otro);?>
		<?php echo ($num>0)?'<h4>Otros</h4>':'';?>
		<?php for($i=0;$i<$num;$i++){?>
				<span class="lineal"><label><strong><?php echo $estudios_otro[$i];?></strong></label></span>
		<?php }?>
	</div>
</div>
</fieldset>
