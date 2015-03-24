<!--Vista que llena el select de patologías-->
<option value="-1">Seleccionar...</option>
<?php 

	foreach($patologias as $i => $dato)
	{
		echo '<option value="'.$dato['id'].'">';
		echo $dato['nombre'];
		echo '</option>';
	}
?>