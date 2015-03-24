<fieldset>
	<legend>Ficha de Tanita</legend>
	<table>
		<tr><td>
		<fieldset>
			<legend>General</legend>
			<table class="columnaizq">
				<tr><td>Masa grasa:</td>
					<td><div class="lineal">
						<input type="text" size="4" name="mg_p_gral" value="<?php echo set_value('mg_p_gral')?>"/>
						<strong>%</strong>
						</div>
					</td>
				</tr>
				<tr><td>Masa grasa:</td>
					<td><div class="lineal">
						<input type="text" size="4" name="mg_kg_gral" value="<?php echo set_value('mg_kg_gral')?>"/>
						<strong>Kg.</strong>
					</div>
					</td>
				</tr>
				<tr><td>Masa magra:</td>
					<td><input type="text" size="6" name="masa_magra_gral" value="<?php echo set_value('masa_magra_gral')?>"/></td>
				</tr>
				<tr><td>Agua total:</td>
					<td><input type="text" size="6" name="agua_total" value="<?php echo set_value('agua_total')?>"/></td>
				</tr>
				<tr><td colspan="2"></td></tr>
			</table>
		
			<fieldset class="columnader">
				<legend>Valores ideales</legend>
				<table>
				<tr><td>Masa grasa</td>
					<td><div class="lineal">
						<input type="text" size="4" name="masa_grasa_idealp" value="<?php echo set_value('masa_grasa_idealp')?>"/>
						<strong>%</strong>
						</div>
					</td>
				</tr>
				<tr><td>Masa grasa</td>
					<td><div class="lineal">
						<input type="text" size="4" name="masa_grasa_idealkg"  value="<?php echo set_value('masa_grasa_idealkg')?>"/>
						<strong>Kg.</strong>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
		</fieldset>
	</td>
</tr>
<tr>
	<td>
	<fieldset>
		<legend>An&aacute;lisis segmentado</legend>
		<table
		<tr>
			
		<?php for ($i=0;$i<5;$i++){
			echo ($i==2||$i==4)?'<tr>':'';?>
		<td>
		<fieldset>
			<legend><?php switch($i){
							case 0: $nombre='Pierna_der';echo 'PIERNA DERECHA';break;
							case 1: $nombre='Pierna_izq';echo 'PIERNA IZQUIERDA';break;
							case 2: $nombre='Brazo_der';echo 'BRAZO DERECHO';break;
							case 3: $nombre='Brazo_izq';echo 'BRAZO IZQUIERDO';break;
							case 4: $nombre='Tronco';echo 'TRONCO';break;}?>
			</legend>
			<table>
				<tr><td>Masa grasa:</td>
				<td><div class="lineal">
					<input type="text" size="4" name="<?php echo $nombre.'masa_grasa_p';?>" value="<?php echo set_value($nombre.'masa_grasa_p')?>"/>
					<strong>%</strong>
					</div>
				</td>
			</tr>
			<tr><td>Masa grasa:</td>
				<td><div class="lineal">
					<input type="text" size="4" name="<?php echo $nombre.'masa_grasa_kg';?>" value="<?php echo set_value($nombre.'masa_grasa_kg')?>"/>
					<strong>Kg.</strong>
				</div>
				</td>
			</tr>
			<tr><td>Masa magra:</td>
				<td><input type="text" size="6" name="<?php echo $nombre.'masa_magra';?>" value="<?php echo set_value($nombre.'masa_magra')?>"/></td>
			</tr>
			<tr><td>Masa muscular prevista:</td>
				<td><input type="text" size="6" name="<?php echo $nombre.'masa_muscular';?>" value="<?php echo set_value($nombre.'masa_muscular')?>"/></td>
			</tr>
		</table>
		</fieldset>
		</td>
	<?php }?>
		</tr>
		</table>
	</fieldset>
	</td>
	</tr>
</table>
</fieldset>