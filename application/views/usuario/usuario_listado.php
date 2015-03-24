<?php $this->load->view('usuario/usuario_buscar');?>
<a href="<?php echo site_url();?>/usuario/agregar">Nuevo Usuario</a>
<table class="listado" border="0">
	<tr>
		<th>Nombre Completo</th>
		<th>Nombre de Usuario</th>
		<th>Tipo</th>
		<th>Opciones</th>
	</tr>
	<?php
		if(isset($resultados) && $resultados != FALSE){foreach ($resultados as $usuario) {?>
		<tr>
			<td><?php echo $usuario->nombre.' '.$usuario->ap.' '.$usuario->am;?></td>
			<td><?php echo $usuario->nick;?></td>
			<td><?php echo $usuario->tipo;?></td>
			<td align="center"><a href="<?php echo site_url()?>/usuario/detalle/<?php echo $usuario->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/detalle.png"></a>
<a href="<?php echo site_url()?>/usuario/modificar/<?php echo $usuario->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/modificar.png"></a>
<?php if($usuario->tipo<=2){?>
	<a href="<?php echo site_url()?>/usuario/periodo_inhabil/<?php echo $usuario->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/break.jpg"></a>
<?php }?>
<a href="<?php echo site_url()?>/usuario/borrar/<?php echo $usuario->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/borrar.png"></a>			</td>		
		</tr>
	<?php }}?>
</table>