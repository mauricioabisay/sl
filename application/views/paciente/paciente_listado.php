<?php $this->load->view('paciente/paciente_buscar');?>
	<?php if(isset($resultados) && $resultados != FALSE){foreach ($resultados as $paciente) {?>
<a href="<?php echo site_url()?>/paciente/modificar/<?php echo $paciente->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/modificar.png"></a>
	<?php }}?>
	</tbody>