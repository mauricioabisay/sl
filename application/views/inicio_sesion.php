<html>
	<head>
		<title>Sabor and Light|Administraci&oacute;n de Pacientes</title>
		<link href="<?php echo base_url('/assets/css/main_css.php');?>" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" type="image/ico" href="<?php echo base_url();?>/assets/img/favicon.ico" />
		<link href="" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
		<div class="area_trabajo" align="center" style="display:inline">
			<div class="columnaizq">
				<img src="<?php echo base_url('/assets/img/logo.png');?>">
			</div>
			<div class="columnaizq">
			<form action="<?php echo site_url('/welcome/iniciar_sesion');?>" method="post" id="inicio_sesion">
				<fieldset>
					<legend>Inicio de Sesi&oacute;n</legend>
					<label>Nombre:</label>
					<input type="text" name="usuario" size="30"/>
					<label>Contrase&ntilde;a:</label>
					<input type="password" name="pass" size="30"/>
					<div class="botones" align="center">
						<input type="submit" value="Iniciar" />
						<input type="reset" value="Limpiar" />
					</div>
				</fieldset>
			</form>
			</div>
		</div>
		<div id="pie">
		</div>
	</body>
</html>