<html>
<body>
			<td><?php echo ''.$medicamento->valor_frec.' veces ';?>
				<?php echo ($medicamento->tipo_frec=="Diario")?'al d&iacute;a':'por semana';?></td>
			<td><?php echo $medicamento->causa;?></td>
			<td><?php echo $medicamento->fecha_ini;?></td>
			<td><?php echo ($medicamento->status=='Activo')?'S&iacute; Consume':'No Consume';?></td>
			<td>
<a onclick="open('<?php echo site_url()?>/medicamento/detalle_id/<?php echo $medicamento->id;?>','aux','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=255')"><img height="24" width="24" src="<?php echo base_url();?>assets/img/detalle.png"></a>
			</td>		
		</tr>
	</tbody>
<?php 	}}?>
</table>
<br>
<br>
<table class="listado">