<?php if(isset($tipo)){	echo '<div><span id="'.$tipo.'">';	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';	echo '</span></div>';}?><!--Esta funcion javasrcipt crea el calendario en base a las preferencias establecidas por el usuario--><script>	$(function() {		$('#calendario').datepicker({			beforeShowDay:function(date){				switch(date.getDay()){					<?php for($i=0;$i<sizeof($dias_habiles_generales);$i++){?>						case <?php echo $dias_habiles_generales[$i];?>:{							return [true,''];						}					<?php }?>						default:{							return [false,''];						}				}			},			onSelect:function(dateText, inst){				$.post("<?php echo site_url();?>/cita/lista_espera/",{fecha:dateText},function(data){$("#citas").html(data);});			},			numberOfMonths: 2,			minDate: new Date()		})	});</script><form id="formulario" method="post" action="<?php echo site_url();?>/cita/listado_citas_nombre">	<fieldset>		<legend>B&uacute;squeda de Cita</legend>		<span class="lineal">			<label>Fecha:</label>			<input type="text" name="fecha" id="calendario" />		</span>	</fieldset></form><table class="listado">	<thead>		<tr>			<th>Nombre</th>			<th>Estado</th>			<th>Fecha</th>			<th>Hora</th>			<th>Tipo</th>			<?php if(isset($cita_transferida)||isset($cita_cancelada)){?>				<th>Opciones</th>			<?php }?>		</tr>	</thead>	<tbody id="citas">	<?php if(isset($resultados) && $resultados != FALSE){foreach ($resultados as $cita) {?>
		<tr class="<?php echo $cita->status;?>">			<td>				<?php echo $cita->nombre;?> <?php echo $cita->ap;?> <?php echo $cita->am;?>			</td>			<td><?php echo $cita->status;?></td>			<td><?php $aux_d = DateTime::createFromFormat('Y-m-d',$cita->fecha);echo $aux_d->format('d-m-Y')?></td>			<td><?php echo $cita->hora;?></td>			<td><?php echo $cita->tipo;?></td>			<?php if(isset($cita_cancelada)){?>			<td>				<a href="<?php echo site_url();?>/cita/transferir/<?php echo $cita->id?>/<?php echo $cita_cancelada;?>">					<img src="<?php echo base_url();?>/assets/img/transferencia.png" width="32" height="32">				</a>			</td>				<?php }?>			<?php if(isset($cita_transferida)){?>			<td>				<a href="<?php echo site_url();?>/cita/transferir/<?php echo $cita->id?>/<?php echo $cita_transferida;?>">					<img src="<?php echo base_url();?>/assets/img/transferencia.png" width="32" height="32">				</a>			</td>				<?php }?>		</tr>	<?php }}?>	</tbody></table>