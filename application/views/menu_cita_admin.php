<!--
Este menu es el que se muestra al entrar a la Administracion de Pacientes
Solo 2 opciones estan activas:
1.Busqueda de Pacientes
2.Agregar Nuevo Paciente
El resto de las opciones son del Expediente de un paciente en especifico
-->
<ul>
	<li><a href="<?php echo site_url();?>/cita/listado_citas_fecha">B&uacute;squeda</a></li>
	<li><a href="<?php echo site_url();?>/cita/agregar_pre_paciente">Cita Nueva</a></li>
	<li><a href="<?php echo site_url();?>/cita/busqueda_pacientes">Cita Recurrente</a></li>	<li><a href="<?php echo site_url();?>/cita/lista_espera">Ver Lista de Espera</a></li>	<li><a href="<?php echo site_url();?>/welcome/admin_paciente">Admin.Pacientes</a></li>
	<li onmouseout='$("#sub_admin").css("display","none")' onmouseover='$("#sub_admin").css("display","block")'>	<a href="#">Admin.del Sistema</a>
		<ul id="sub_admin">
			<li><a href="<?php echo site_url();?>/usuario/listado">Usuarios</a></li>
			<li><a href="<?php echo site_url();?>/patologias/index">Patolog&iacute;as</a></li>
		</ul>
	</li>	<li>
<a href="<?php echo site_url();?>/welcome/cerrar_sesion">Salir</a>
	</li>
</ul>