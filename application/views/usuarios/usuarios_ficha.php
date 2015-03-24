<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>	
		
	</head>
	<body>
   
	<?php 
		if(isset($tipo)){
			echo '<div><span id="'.$tipo.'">';
			echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
			echo '</span></div>';
		}
		foreach ($resultados as $datos)
		?>
	<form action="" method="post" name="formulario" id="formulario">
	<div id="form">
	<fieldset >
			<legend>Alta de usuarios</legend>
				<input type="hidden" id= "id_usr" name="id_usr" value="<?php echo $datos['id_usr'];?>"
				<label>Nombre(s):</label>
				<span class="lineal"><?php	echo $datos['nombre']; ?></span>
				
				<label>Apellido Paterno:</label>
				<span class="lineal"><?php echo $datos['ap']; ?></span>
				
				<label>Apellido Materno:</label>
				<span class="lineal"><?php echo $datos['am']; ?></span>
			
				<!--
				<label>Usuario:</label>
				<span class="lineal"><input type="text" name="nick" value="<?php echo set_value('nick');?>"/><?php echo form_error('nick')?></span>
				
				<label>Contrase&ntilde;a:</label>
				<span class="lineal"><input type="password" name="pass" /><?php echo form_error('pass');?></span>
			
				
				<label>Tipo:</label>
				<span class="lineal">
				<select>
					<option></option>
					<option>Administrador</option>
					<option>Doctor</option>
					<option>Recepcionista</option>
				</select>
				</span> -->
				
			
		</fieldset>
		<fieldset>
			<legend>Horarios de trabajo</legend>
			<table class="tabla_formulario">
				<tr>
					<th>D&iacute;as</th><th>Hora de entrada:</th><th>Hora de salida:</th>
				</tr>
				<?php foreach ($resultados as $datos){?>
				<tr><td><?php echo $datos['dias'];?></td>
					<td><?php echo $datos['hora_ini'];?></td>
					<td><?php echo $datos['hora_fin'];?></td>
				</tr>
				<?php } ?>
		
			</table>

		</fieldset>
		<div class="botones" align="left" >
			
			<input type="button" value="Modificar" onclick='document.location.href = "<?php echo site_url();?>/usuarios/modificar/<?php echo $datos['id_usr'];?>"'/>
			<input type="button" value="Aceptar y Nuevo"  onclick='document.location.href = "<?php echo site_url();?>/usuarios/aceptar_nuevo"' />
			<input type="button" value="Cerrar"  onclick='document.location.href = "<?php echo site_url();?>/usuarios/cerrar"' />
			
		</div>

		<!--
		<div class="botones" align="left" >
			<input type="submit" value="Guardar" />
			<input type="reset" value="Limpiar" />
		</div>-->
		</div>

		</form>
	</body>
</html>