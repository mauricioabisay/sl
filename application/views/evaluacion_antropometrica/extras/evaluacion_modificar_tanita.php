<fieldset>
	<legend>Ficha de Tanita</legend>
	<table>
		<tr><td><fieldset>
			<legend>General</legend>
			<input type="hidden" name="id_tanita_gral" value="<?php echo set_value('id_tanita_gral',(isset($tanita_general)&&$tanita_general)?$tanita_general->id:'');?>"/>
			<table class="columnaizq">
				<tr><td>Masa grasa:</td>
					<td><div class="lineal">
						<input type="text" size="4" name="mg_p_gral" value="<?php echo set_value('mg_p_gral',((isset($tanita_general))&&($tanita_general))?$tanita_general->masa_grasa_p:'');?>"/>
						<strong>%</strong>
						</div>
					</td>
				</tr>
				<tr><td>Masa grasa:</td>
					<td><div class="lineal">
						<input type="text" size="4" name="mg_kg_gral" value="<?php echo set_value('mg_kg_gral',((isset($tanita_general))&&($tanita_general))?$tanita_general->masa_grasa_kg:'');?>"/>
						<strong>Kg.</strong>
					</div>
					</td>
				</tr>
				<tr><td>Masa magra:</td>
					<td><input type="text" size="6" name="masa_magra_gral" value="<?php echo set_value('masa_magra_gral',((isset($tanita_general))&&($tanita_general))?$tanita_general->masa_magra:'');?>"/></td>
				</tr>
				<tr><td>Agua total:</td>
					<td><input type="text" size="6" name="agua_total" value="<?php echo set_value('agua_total',((isset($tanita_general))&&($tanita_general))?$tanita_general->agua_total:'');?>"/></td>
				</tr>
				<tr><td colspan="2"></td></tr>
			</table>
			<fieldset class="columnader">
				<legend>Valores ideales</legend>
				<table>
					<tr>
						<td>Masa grasa</td>
						<td><div class="lineal">
							<input type="text" size="4" name="masa_grasa_idealp" value="<?php echo set_value('masa_grasa_idealp',((isset($tanita_general))&&($tanita_general))?$tanita_general->masa_grasa_idealp:'');?>"/>
							<strong>%</strong>
						</div></td>
					</tr>
					<tr>
						<td>Masa grasa</td>
						<td><div class="lineal">
							<input type="text" size="4" name="masa_grasa_idealkg"  value="<?php echo set_value('masa_grasa_idealkg',((isset($tanita_general))&&($tanita_general))?$tanita_general->masa_grasa_idealkg:'');?>"/>
							<strong>Kg.</strong>
						</div></td>
					</tr>
				</table>
			</fieldset>
		</fieldset></td></tr>
<tr><td><fieldset>
		<legend>An&aacute;lisis segmentado</legend>
		<table
		<tr>
			
		<?php if(isset($tanita_segmentos)&&$tanita_segmentos){$i=0;foreach($tanita_segmentos as $tanita_segmento){echo ($i==2||$i==4)?'<tr>':'';?>
		<td>
		<fieldset>
			<legend>
				<?php
				switch ($tanita_segmento->concepto){
					case 'Pierna_der':$nombre=$tanita_segmento->concepto;echo 'Pierna derecha';break;
					case 'Pierna_izq':$nombre=$tanita_segmento->concepto;echo 'Pierna izquierda';break;
					case 'Brazo_izq':$nombre=$tanita_segmento->concepto;echo 'Brazo izquierdo';break;
					case 'Brazo_der':$nombre=$tanita_segmento->concepto;echo 'Brazo derecho';break;
				}
				?>
			</legend>
			<input type="hidden" name="<?php echo $nombre.'id_tanita';?>" value="<?php echo set_value('id_tanita',$tanita_segmento->id);?>"/>
			<table>
				<tr><td>Masa grasa:</td>
				<td><div class="lineal">
					<input type="text" size="4" name="<?php echo $nombre.'masa_grasa_p';?>" value="<?php echo set_value($nombre.'masa_grasa_p',$tanita_segmento->masa_grasa_p);?>"/>
					<strong>%</strong>
					</div>
				</td>
			</tr>
			<tr><td>Masa grasa:</td>
				<td><div class="lineal">
					<input type="text" size="4" name="<?php echo $nombre.'masa_grasa_kg';?>" value="<?php echo set_value($nombre.'masa_grasa_kg',$tanita_segmento->masa_grasa_kg);?>"/>
					<strong>Kg.</strong>
				</div>
				</td>
			</tr>
			<tr><td>Masa magra:</td>
				<td><input type="text" size="6" name="<?php echo $nombre.'masa_magra';?>" value="<?php echo set_value($nombre.'masa_magra',$tanita_segmento->masa_magra);?>"/></td>
			</tr>
			<tr><td>Masa muscular prevista:</td>
				<td><input type="text" size="6" name="<?php echo $nombre.'masa_muscular';?>" value="<?php echo set_value($nombre.'masa_muscular',$tanita_segmento->masa_muscular);?>"/></td>
			</tr>
		</table>
		</fieldset>
		</td>
		<?php $i++;echo ($i==2||$i==4)?'</tr>':'';}?>
		<?php }else{for ($i=0;$i<5;$i++){echo ($i==2||$i==4)?'<tr>':'';?>
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
					<input type="text" size="4" name="<?php echo $nombre.'masa_grasa_p';?>" value="<?php echo set_value($nombre.'masa_grasa_p');?>"/>
					<strong>%</strong>
					</div>
				</td>
			</tr>
			<tr><td>Masa grasa:</td>
				<td><div class="lineal">
					<input type="text" size="4" name="<?php echo $nombre.'masa_grasa_kg';?>" value="<?php echo set_value($nombre.'masa_grasa_kg');?>"/>
					<strong>Kg.</strong>
				</div>
				</td>
			</tr>
			<tr><td>Masa magra:</td>
				<td><input type="text" size="6" name="<?php echo $nombre.'masa_magra';?>" value="<?php echo set_value($nombre.'masa_magra');?>"/></td>
			</tr>
			<tr><td>Masa muscular prevista:</td>
				<td><input type="text" size="6" name="<?php echo $nombre.'masa_muscular';?>" value="<?php echo set_value($nombre.'masa_muscular');?>"/></td>
			</tr>
		</table>
		</fieldset>
		</td>
		<?php echo ($i==2||$i==4)?'</tr>':'';?>;?>
	<?php }}?>
		</tr>
		</table>
	</fieldset>
	</td>
	</tr>
</table>
</fieldset>
