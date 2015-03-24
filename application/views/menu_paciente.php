<ul>
	<li>
<a href="<?php echo site_url();?>/paciente/busqueda">B&uacute;squeda</a>
	</li>
	<li>
<a href="<?php echo site_url();?>/paciente/detalle/<?php echo $id_paciente;?>">Ficha de Identidad</a>
	</li>
	<li>
<a href="<?php echo site_url();?>/antecedentes_patologicos/antecedente/<?php echo $id_paciente;?>">Ant.Patol&oacute;gicos</a>
	</li>
	<li>
<a href="<?php echo site_url()?>/antecedentes/antecedente/<?php echo $id_paciente;?>">Ant.No Patol&oacute;gicos</a>
	</li>
	<li>
<a href="<?php echo site_url()?>/evdietetica/index/<?php echo $id_paciente;?>">Eval.Diet&eacute;tica</a>
	</li>
	<li>
<a href="<?php echo site_url();?>/evaluacion/evaluacion/<?php echo $id_paciente;?>">Eval.Antropom&eacute;tica</a>
	</li>
	<li>
<a href="<?php echo site_url();?>/calculo/index/<?php echo $id_paciente;?>">C&aacute;lc. Energ&eacute;tico</a>
	</li>
	<li>
<a href="<?php echo site_url();?>/plan_alimenticio/index/<?php echo $id_paciente;?>">Plan de Alimentaci&oacute;n</a>
	</li>
	<li>
<a href="<?php echo site_url();?>/medicamento/index/<?php echo $id_paciente;?>">Medicamentos</a>
	</li>
	<li <?php echo (isset($menu_opcion_actual)&&($menu_opcion_actual=='laboratorio'))?'class="seleccionado"':'';?>>
<a href="<?php echo site_url();?>/laboratorio/index/<?php echo $id_paciente;?>">Laboratorios</a>
	</li>
<?php if($this->session->userdata('tipo')==1){?>	
	<li onmouseout='$("#sub_admin").css("display","none")' onmouseover='$("#sub_admin").css("display","block")'>
<a href="#">Admin.del Sistema</a>
		<ul id="sub_admin">
			<li><a href="<?php echo site_url();?>/cita/index_admin">Agenda</a></li>
			<li><a href="<?php echo site_url();?>/usuario/listado">Usuarios</a></li>
			<li><a href="<?php echo site_url();?>/variables_sistema/index">Variables del sistema</a></li>
			<li><a href="<?php echo site_url();?>/patologias/index">Patolog&iacute;as</a></li>
			<li><a href="<?php echo site_url();?>/plan_alimenticio/agregar_plan_nuevo">Plan de Alimentaci&oacute;n</a></li>
		</ul>
	</li>
<?php }?>
<?php if($this->session->userdata('tipo')<=2){?>
	<li><a href="<?php echo site_url();?>/cita/citas_doctor">Agenda</a></li>
<?php }?>
	<li>
<a href="<?php echo site_url();?>/welcome/cerrar_sesion">Salir</a>
	</li>
</ul>