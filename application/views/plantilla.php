<?php
if (!$this->session->userdata('usuario')){
	$datos['tipo_mensaje'] = 'error';
	$datos['mensaje'] = 'Para acceder al sistema debes proporcionar tu nombre de usuario y constrase�a';
	$this->load->view('inicio_sesion',$datos);
	exit();
}
?>
<html>
	<head>
		<title>Sabor and Light|Administraci&oacute;n de Pacientes</title>
		<link rel="shortcut icon" type="image/ico" href="<?php echo base_url();?>/assets/img/favicon.ico" />
		<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
		<script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery-ui.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery.ui.datepicker-es.js"></script>
		<script src="<?php echo base_url();?>/assets/js/jquery.agregarcampo.js"></script>
	</head>
	<body>
		<div class="head">
			<img src="<?php echo base_url();?>/assets/img/logo1.png" width="126px" height="80px">
		</div>
		<div class="banner" style="padding: 0.2em;margin: 0.5em">
			<?php if(isset($id_paciente)){?>
					<iframe id="info_mini" allowtransparency="yes" frameborder="0" width="100%" height="100%" scrolling="no" src="<?php echo site_url();?>/banner/banner_paciente/<?php echo $id_paciente;?>"> 
					</iframe>
			<?php }else{?>
					<iframe id="info_mini" allowtransparency="yes" frameborder="0" width="100%" height="100%" scrolling="no" src="<?php echo site_url();?>/banner/banner_main"> 
					</iframe>
			<?php }?>
		</div>
		<div id="menuM" class="menu" align="center"><?php $this->load->view($menu);?></div>
		<div class="content" <?php echo (isset($listado))?'':'style="width: 97%;height: 70%;position: fixed;top: 153px;left: 1%;"';?>>
			<?php if(isset($listado)){?>
					<div class="panelizq">
						<iframe id="listado_mini" allowtransparency="yes" frameborder="0" width="97%" height="100%" scrolling="no" src="<?php echo $listado;?>"> 
						</iframe>
					</div>
					<div id="espacio" class="area_trabajo">
						<iframe id="contenido" allowtransparency="yes" frameborder="0" width="100%" height="100%" src="<?php echo $pagina_frame;?>">	
						</iframe>
					</div>
			<?php }else{?>
					<div id="espacio" class="area_trabajo">
						<?php $this->load->view($pagina);?>
					</div>
			<?php }?>
		</div>
		<div class="foot" style="padding-top:0em;margin-bottom:0.2em">
			<?php if(isset($id_paciente)){?>
				<div align="center">
					<a href="#" onclick="$('#blog').css('display','block');">
						<img style="position:fixed;bottom:3%" src="<?php echo base_url();?>/assets/img/tab.png" />
					</a>
				</div>
				<div id="blog" style="display:none;width:100%;height:100%">
					<a href="#" style="position:fixed;bottom:28%" onclick="$('#blog').css('display','none');">
						<img src="<?php echo base_url();?>/assets/img/tab.png" />
					</a>
					<iframe align="center" scrolling="yes" allowtransparency="yes" frameborder="0" width="60%" height="25%" src="<?php echo site_url();?>/comentario/agregar/<?php echo $id_paciente;?>" style="position:fixed;bottom:3%;left:20%">
					</iframe>
				</div>
			<?php }?>
			Versi&oacute;n 2.0 Actualizada el 22 de Marzo de 2014
		</div>
	</body>
</html>