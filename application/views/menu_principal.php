<ul>
	<li><a href="<?php echo site_url();?>/paciente/busqueda">B&uacute;squeda</a></li>
	<li class="inactivo"><a href="<?php echo site_url();?>/paciente/detalle/">Ficha de Identidad</a></li>
	<li class="inactivo"><a href="#">Ant.Patol&oacute;gicos</a></li>
	<li class="inactivo"><a href="<?php echo site_url()?>/antecedentes/antecedente/">Ant.No Patol&oacute;gicos</a></li>
	<li class="inactivo"><a href="<?php echo site_url()?>/evdietetica/agregar/">Eval.Diet&eacute;tica</a></li>
	<li class="inactivo"><a href="<?php echo site_url();?>/evaluacion/agregar/">Eval.Antropom&eacute;tica</a></li>
	<li class="inactivo"><a href="#">C&aacute;lc.Energ&eacute;tico</a></li>
	<li class="inactivo"><a href="#">Plan de Alimentaci&oacute;n</a></li>
<?php if($this->session->userdata('tipo')==1){?>
<a href="#">Admin.del Sistema</a>
		<ul id="sub_admin">		
			<li><a href="<?php echo site_url();?>/usuario/listado">Usuarios</a></li>
			<li><a href="<?php echo site_url();?>/patologias/index">Patolog&iacute;as</a></li>
			<li><a href="<?php echo site_url();?>/plan_alimenticio/agregar_plan_nuevo">Plan de Alimentaci&oacute;n</a></li>
		</ul>
<?php }?>
<?php if($this->session->userdata('tipo')<=2){?>
<?php }?>
</ul>