<?php
	//Vista que carga los datos almacenados de cada patología
	foreach ($patologia as $i => $dato) {
		
	?>
		<textarea name="caracteristicas" style="width: 45em; height: 15em; font-size: 14" readonly="readonly" ><?php echo $dato['caracteristicas']; ?></textarea>
		
<?php } ?>