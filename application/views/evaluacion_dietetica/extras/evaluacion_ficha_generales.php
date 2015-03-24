<fieldset>
	<legend>Preguntas generales</legend>
	<div class="lineal">
		<label>&iquest;Qu&eacute; expectativa de evoluci&oacute;n tiene?</label>
		<span><?php echo $ev->evolucion;?></span>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 el nivel de desgaste o irritabilidad que le genera el tema</label>
		<span><?php echo $ev->desgaste;?></span>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 la motivaci&oacute;n con la que llega</label>
		<span><?php echo $ev->motivacion;?></span>
	</div>
	<div class="lineal">
		<label>&iquest;Por qu&eacute;?</label>
		<span><?php echo $ev->razon_motivacion;?></span>
	</div>
	<div class="lineal">
		<label>Mencione del 1 al 10 qu&eacute; tan capaz se cree usted de lograr los resultados</label>
		<span><?php echo $ev->capacidad;?></span>
	</div>
</fieldset>