<?php if($resultados != NULL){?>
	<fieldset>
		<legend>Ficha Tanita</legend>
		<?php $aux=false;  
				foreach ($resultados as $dato){
				$nombre=$dato->concepto;
				if($nombre=='General'){
						
					?>
				<fieldset>
					<legend><?php echo $nombre; ?></legend>
					<div class="lineal"><label>Masa grasa:</label><span><?php echo $dato->masa_grasa_p;?></span><strong>%</strong></div>
					<div class="lineal"><label>Masa grasa:</label><span><?php echo $dato->masa_grasa_kg;?></span><strong>Kg.</strong></div>
					<div class="lineal"><label>Masa magra:</label><span><?php echo $dato->masa_magra;?></span><strong></strong></div>
					
					<div class="lineal"><label>Agua total:</label><span><?php echo $dato->agua_total;?></span><strong></strong></div>
					<fieldset>
						<legend>Valores ideales</legend>
						<div class="lineal"><label>Masa grasa ideal:</label><span><?php echo $dato->masa_grasa_idealp;?></span><strong>%</strong></div>
					<div class="lineal"><label>Masa grasa ideal:</label><span><?php echo $dato->masa_grasa_idealkg;?></span><strong>Kg.</strong></div>
					</fieldset>
				</fieldset>
				<?php }
					else ($nombre!=NULL)?$aux=true:''; }
					if($aux){?>
				<fieldset>
					<legend>An&aacute;lisis segmentado<input type="button" value="+" onclick='$("#analisis_segmentado").toggle(200);' style="display: inline" /></legend>
					<div id="analisis_segmentado" style="display:none">
					<?php foreach ($resultados as $dato){
							$nombre=$dato->concepto;
							if($nombre!='General'){	?>
						  	<fieldset>
					  			<legend>
					  			<?php
					  				switch ($nombre){
									case 'Pierna_der':$nombre='Pierna derecha';break;
									case 'Pierna_izq':$nombre='Pierna izquierda';break;
									case 'Brazo_izq': $nombre= 'Brazo izquierdo';break;
									case 'Brazo_der': $nombre='Brazo derecho';break;
								}
								echo $nombre;?>
					  			</legend>
					  			<div class="lineal"><label>Masa grasa:</label><span><?php echo $dato->masa_grasa_p;?></span><strong>%</strong></div>
								<div class="lineal"><label>Masa grasa:</label><span><?php echo $dato->masa_grasa_kg;?></span><strong>Kg.</strong></div>
								<div class="lineal"><label>Masa magra:</label><span><?php echo $dato->masa_magra;?></span><strong></strong></div>
								<div class="lineal"><label>Masa muscular prevista:</label><span><?php echo $dato->masa_muscular;?></span><strong></strong></div>
					  		</fieldset>
						  	
				   <?php }} ?>
				   </div>
				</fieldset>
				<?php }?>
	</fieldset>
<?php }?>

