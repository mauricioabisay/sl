<html>
<head>
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
<body style="margin-bottom:0;padding-bottom:0">
<div class="panelizq" style="position:fixed;left:0%;top:1%;width:15%;height:93%;margin-bottom:0;padding-bottom:0">
<table class="listado_mini">
	<thead>
		<tr><td class="nuevo" align="center"><a href="<?php echo site_url();?>/comentario/agregar/<?php echo $id_paciente;?>">Nuevo</a></td></tr>
		<tr>
			<th>Fecha</th>
			<th>Opc.</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $c) {
	?>
		<tr>
			<td><a href="<?php echo site_url()?>/comentario/detalle/<?php echo $c->id;?>"><?php echo $c->fecha;?></a></td>
			<td>
				<a href="<?php echo site_url()?>/comentario/borrar/<?php echo $c->id;?>"><img width="15px" height="15px" src="<?php echo base_url()?>/assets/img/borrar.png"></a>
			</td>		
		</tr>
	<?php
		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" align="center">
				<?php echo $this->pagination->create_links();?>
			</td>
		</tr>
	</tfoot>
</table>
</div>
<div id="espacio" class="area_trabajo" style="position:absolute;left:20%;top:0;width:80%">
<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
	<form action="<?php echo site_url();?>/comentario/detalle/<?php echo $id_paciente;?>" method="post" id="formulario" style="width:100%;margin-bottom:0;padding-bottom:0">
	<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
	<fieldset>
		<legend>Comentarios del d&iacute;a <?php echo ($comentario)?DateTime::createFromFormat('Y-m-d',$comentario->fecha)->format('d-m-Y'):date('d-m-Y');?>:</legend>
		<?php echo $comentario->comentario;?>
	</fieldset>
	</form>
</div>
</body>
</html>