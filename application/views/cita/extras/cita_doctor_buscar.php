<!--Esta funcion javasrcipt crea el calendario en base a las preferencias establecidas por el usuario-->
<script>
	$(function() {
		$('#calendario').datepicker({
			beforeShowDay:function(date){
				switch(date.getDay()){
					<?php for($i=0;$i<sizeof($dias_habiles_generales);$i++){?>
						case <?php echo $dias_habiles_generales[$i];?>:{
							return [true,''];
						}
					<?php }?>
						default:{
							return [false,''];
						}
				}
			},
			onSelect:function(dateText, inst){
				$.post("<?php echo site_url();?>/cita/citas_doctor/",{fecha:dateText},function(data){$("#citas").html(data);});
			},
			numberOfMonths: 2,
			minDate: new Date()
		})
	});
</script>
<form id="formulario">
	<fieldset>
		<legend>B&uacute;squeda de Cita</legend>
		<span class="lineal">
			<label>Fecha:</label>
			<input type="text" name="fecha" id="calendario" />
<!--<label>Estado:</label>
			<select name="status">
				<option></option>
				<option>Reservada</option>
				<option>Confirmada</option>
				<option>Cancelada</option>
			</select>
			<label>Tipo Cita:</label>
			<select name="tipo">
				<option></option>
				<option>Primera Vez</option>
				<option>Recurrente</option>
			</select>
			<input type="submit" value="Buscar" />
			<input type="reset" value="Limpiar" />-->
		</span>
	</fieldset>
</form>