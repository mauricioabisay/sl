<fieldset>
	<legend>Preguntas sobre h&aacute;bitos alimenticios</legend>
		<table class="tabla_formulario">
			<thead>
			<tr><th colspan="6">Comidas del d&iacute;a</th></tr>
			<tr align="center">
				<th></th>
				<th>S&iacute;</th>
				<th>No</th>
				<th width="20%">Lugar</th>
				<th width="20%">Horario</th>
				<th width="30%">&iquest;Qui&eacute;n cocina?</th>
			</tr>
			</thead>
			<tbody>
			<?php
				for($i=0;$i<5;$i++){
			?>
			<tr>
				<td class="titulo">
					<?php
					switch($i){
						case '0':{echo 'Desayuno';break;}
						case '1':{echo 'Colaci&oacute;n';break;}
						case '2':{echo 'Comida';break;}
						case '3':{echo 'Colaci&oacute;n';break;}
						case '4':{echo 'Cena';break;}
					}
					?>
				</td>
				<td><input type="radio" name="existe<?php echo $i;?>" value="Si" onclick='$("#ocultar_des<?php echo $i;?>").toggle(200)' <?php echo set_radio('existe'.$i.'','Si');?> /></td>
				<td><input type="radio" name="existe<?php echo $i;?>" value="No" onclick='$("#ocultar_des<?php echo $i;?>").toggle(!200)' <?php echo set_radio('existe'.$i.'','No');?> /></td>
				<td colspan="3">
					<div id="ocultar_des<?php echo $i;?>" class="lineal"
					<?php echo ($this->input->post('existe'.$i.'')=='Si')?'':'style="display:none"';?>>	
					<input type="text" name="lugar[]" value="<?php echo (isset($lugar))?$lugar[$i]:'';?>"/>
					<?php echo form_error('lugar['.$i.']')?>
					<select name="horas[]">
						<option value="01" <?php echo (isset($horas)&&($horas[$i]=='01'))?'selected="selected"':'';?>>01</option>
						<option value="02" <?php echo (isset($horas)&&($horas[$i]=='02'))?'selected="selected"':'';?>>02</option>
						<option value="03" <?php echo (isset($horas)&&($horas[$i]=='03'))?'selected="selected"':'';?>>03</option>
						<option value="04" <?php echo (isset($horas)&&($horas[$i]=='04'))?'selected="selected"':'';?>>04</option>
						<option value="05" <?php echo (isset($horas)&&($horas[$i]=='05'))?'selected="selected"':'';?>>05</option>
						<option value="06" <?php echo (isset($horas)&&($horas[$i]=='06'))?'selected="selected"':'';?>>06</option>
						<option value="07" <?php echo (isset($horas)&&($horas[$i]=='07'))?'selected="selected"':'';?>>07</option>
						<option value="08" <?php echo (isset($horas)&&($horas[$i]=='08'))?'selected="selected"':'';?>>08</option>
						<option value="09" <?php echo (isset($horas)&&($horas[$i]=='09'))?'selected="selected"':'';?>>09</option>
						<option value="10" <?php echo (isset($horas)&&($horas[$i]=='10'))?'selected="selected"':'';?>>10</option>
						<option value="11" <?php echo (isset($horas)&&($horas[$i]=='11'))?'selected="selected"':'';?>>11</option>
						<option value="12" <?php echo (isset($horas)&&($horas[$i]=='12'))?'selected="selected"':'';?>>12</option>
					</select><?php echo form_error('horas['.$i.']')?>:
					<select name="minutos[]">
						<option value="00" <?php echo (isset($minutos)&&($minutos[$i]=='00'))?'selected="selected"':'';?>>00</option>
						<option value="05" <?php echo (isset($minutos)&&($minutos[$i]=='05'))?'selected="selected"':'';?>>05</option>
						<option value="10" <?php echo (isset($minutos)&&($minutos[$i]=='10'))?'selected="selected"':'';?>>10</option>
						<option value="15" <?php echo (isset($minutos)&&($minutos[$i]=='15'))?'selected="selected"':'';?>>15</option>
						<option value="20" <?php echo (isset($minutos)&&($minutos[$i]=='20'))?'selected="selected"':'';?>>20</option>
						<option value="25" <?php echo (isset($minutos)&&($minutos[$i]=='25'))?'selected="selected"':'';?>>25</option>
						<option value="30" <?php echo (isset($minutos)&&($minutos[$i]=='30'))?'selected="selected"':'';?>>30</option>
						<option value="35" <?php echo (isset($minutos)&&($minutos[$i]=='35'))?'selected="selected"':'';?>>35</option>
						<option value="40" <?php echo (isset($minutos)&&($minutos[$i]=='40'))?'selected="selected"':'';?>>40</option>
						<option value="45" <?php echo (isset($minutos)&&($minutos[$i]=='45'))?'selected="selected"':'';?>>45</option>
						<option value="50" <?php echo (isset($minutos)&&($minutos[$i]=='50'))?'selected="selected"':'';?>>50</option>
						<option value="55" <?php echo (isset($minutos)&&($minutos[$i]=='55'))?'selected="selected"':'';?>>55</option>
					</select><?php echo form_error('minutos['.$i.']')?>
					<select name="ampm[]">
						<option value="am" <?php echo (isset($ampm)&&($ampm[$i]=='am'))?'selected="selected"':'';?>>a.m.</option>
						<option value="pm" <?php echo (isset($ampm)&&($ampm[$i]=='pm'))?'selected="selected"':'';?>>p.m.</option>
					</select><?php echo form_error('ampm['.$i.']')?>
				<input type="text" name="cocinero[]" value="<?php echo (isset($cocinero))?$cocinero[$i]:'';?>"/><?php echo form_error('cocinero['.$i.']')?>
			</div>
			</td>
			<td><?php echo form_error('existe'.$i.'')?></td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
</fieldset>