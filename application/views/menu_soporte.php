<!--
Este menu muestra algunas opciones para soporte tecnico, como:
Alta de Modulos para Administracion de Privilegios de Usuario
-->
<ul>
	<li onmouseout='$("#sub_admin_usr").css("display","none")' onmouseover='$("#sub_admin_usr").css("display","block")'>
<a href="#">Admin.de Usuarios</a>
		<ul id="sub_admin_usr">
			<li><a href="<?php echo site_url();?>/usuario/admin_modulos">M&oacute;dulos</a></li>
			<li><a href="<?php echo site_url();?>/usuario/admin_tipos_usuario">Tipos de Usuario</a></li>
			<li><a href="<?php echo site_url();?>/usuario/admin_privilegios_usuario">Privilegios de Usuarios</a></li>
		</ul>
	</li>
	<li>
<a href="<?php echo site_url();?>/welcome/cerrar_sesion">Salir</a>
	</li>
</ul>