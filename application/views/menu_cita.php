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
	<li><a href="<?php echo site_url();?>/cita/busqueda_pacientes">Cita Recurrente</a></li>
	<li>
<a href="<?php echo site_url();?>/welcome/cerrar_sesion">Salir</a>
	</li>
</ul>