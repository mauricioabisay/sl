<?php $this->load->view('cita/extras/cita_doctor_buscar');?>
<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<table class="listado">
	<thead>
		<tr>
			<th>Fecha</th>			<th>Hora</th>			<th>Nombre</th>
			<th>Estado</th>
			<th>Tipo</th>
			<th>Contacto</th>
		</tr>
	</thead>
	<tbody id="citas">
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $cita) {
	?>
		<tr class="<?php echo $cita->status;?>">						<td><?php echo $cita->fecha;?></td>						<td><?php echo $cita->hora;?></td>			
			<td><a href="<?php echo site_url();?>/paciente/<?php echo ($cita->tipo=='Primera')?'modificar':'detalle';?>/<?php echo $cita->paciente;?>">
				<?php echo $cita->nombre;?> <?php echo $cita->ap;?> <?php echo $cita->am;?>
			</a></td>
			<td><?php echo $cita->status;?></td>
			
			<td><?php echo $cita->tipo;?></td>
			<td>
				<strong>Infomarci&oacute;n Contacto</strong>
					<input id="mostrar_<?php echo $cita->id;?>" type="button" value="+" onclick="$('#contacto_<?php echo $cita->id;?>').css('display','block');$(this).css('display','none');$('#ocultar_<?php echo $cita->id;?>').css('display','inline')" />
					<input id="ocultar_<?php echo $cita->id;?>" type="button" value="-" onclick="$('#contacto_<?php echo $cita->id;?>').css('display','none');$(this).css('display','none');$('#mostrar_<?php echo $cita->id;?>').css('display','inline')" style="display:none" />
				<div id="contacto_<?php echo $cita->id;?>" style="display: none">
					<?php if(isset($cita->cel1)){?>
						<div class="lineal"><strong>Celular</strong>:<?php echo $cita->cel1;?></div>
					<?php }?>
					<?php if(isset($cita->cel2)){?>
						<div class="lineal"><strong>Celular</strong>:<?php echo $cita->cel2;?></div>
					<?php }?>
					<?php if(isset($cita->radio)){?>
						<div class="lineal"><strong>Radio</strong>:<?php echo $cita->radio;?>,<strong>ID</strong>:<?php echo $cita->radio_id;?></div>
					<?php }?>
					<?php if(isset($cita->tel_casa)){?>
						<div class="lineal"><strong>Casa</strong>:<?php echo $cita->tel_casa;?></div>
					<?php }?>
					<?php if(isset($cita->tel_oficina)){?>
						<div class="lineal"><strong>Oficina</strong>:<?php echo $cita->tel_oficina;?><strong>Ext.</strong>:<?php echo $cita->ext_oficina;?></div>
					<?php }?>
				</div>
			</td>
<!--
			<td>
				<a href="<?php echo site_url();?>/cita/cambiar_status_cita/<?php echo $cita->id;?>/Confirmada">
					<img src="<?php echo base_url();?>/assets/img/circulo_verde.png" width="16" height="16">
				</a>
				<a href="<?php echo site_url();?>/cita/cambiar_status_cita/<?php echo $cita->id;?>/Reservada">
					<img src="<?php echo base_url();?>/assets/img/circulo_amarillo.png" width="16" height="16">
				</a>
				<a href="<?php echo site_url();?>/cita/cambiar_status_cita/<?php echo $cita->id;?>/Cancelada">
					<img src="<?php echo base_url();?>/assets/img/circulo_rojo.png" width="16" height="16">
				</a>
				<a href="<?php echo site_url();?>/cita/cambiar_status_cita/<?php echo $cita->id;?>/Libre">
					<img src="<?php echo base_url();?>/assets/img/circulo_gris.png" width="16" height="16">
				</a>
				<a href="<?php echo site_url()?>/cita/detalle/<?php echo $cita->id;?>">
					<img src="<?php echo base_url();?>/assets/img/detalle.png" width="16" height="16" id="detalle">
				</a>
				<a href="<?php echo site_url()?>/cita/agendar/<?php echo $cita->paciente;?>">
					<img src="<?php echo base_url();?>/assets/img/agregar.png" width="16" height="16" id="detalle">
				</a>
				<a href="<?php echo site_url()?>/cita/modificar/<?php echo $cita->id;?>">Modificar</a>
				<a href="<?php echo site_url()?>/cita/borrar/<?php echo $cita->id;?>">Borrar</a>
			</td>
-->		
		</tr>
	<?php
		}
	?>
	</tbody>
</table>