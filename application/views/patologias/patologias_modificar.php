<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
	
	<script language="JavaScript" type="text/javascript">
		//Se llama a la función consultar del controlador
		function regresar(){
			$("#form").load('consultar');
		}
	</script>
</head>
<body>
	<div id="form">
	<form method="post" action="<?php echo site_url()?>/patologias/modificar" id="formulario" name="formulario">
	<?php echo $mensaje;
	
	;?>
	<input type="hidden" name="id_patologia" value="<?php if($resultados!=NULL){ 
															 foreach ($resultados as $valores) {
																	echo $valores->id;}
															}else echo set_value('id_patologia'); ?>"/>
	<input type="hidden" name="id_clasificacion" value="<?php if($resultados!=NULL){
															 foreach ($resultados as $valores) {
																	echo $valores->id_clasificacion;}
															}else echo set_value('id_clasificacion'); ?>"/>
	<fieldset>
	<legend>Modificar Patolog&iacute;a</legend>
	
	<table class="tabla_formulario">
	<tr>
		<th>Clasificaci&oacute;n</th><th>Patolog&iacute;a</th>
	</tr>	
	<tr>
		<td>
			<div class="lineal">
			<input type="text" name="clasificacion" value="<?php if($resultados!=NULL){
															 foreach ($resultados as $valores) {
																	echo $valores->clasificacion;}
															}else echo set_value('clasificacion'); ?>"/>
			<?php echo form_error('clasificacion'); ?>												
			</div>
		</td>
	   	<td>
	   		<div class="lineal">
	   		<input type="text" name="patologia" value="<?php if($resultados!=NULL){
															 foreach ($resultados as $valores) {
																	echo $valores->nombre;}
															}else echo set_value('patologia'); ?>"/>
	   		<?php echo form_error('clasificacion'); ?>												
			</div>
	   	</td>
  	</tr>
   	</table>
   	<fieldset>
   	<legend>Recomendaciones</legend>
   			<textarea name="caracteristicas" style="width: 45em; height: 15em;"><?php if($resultados!=NULL){
																			 foreach ($resultados as $valores) {
																					echo $valores->caracteristicas;}
																			}else echo set_value('caracteristicas'); ?></textarea>
			<?php echo form_error('caracteristicas'); ?>
			
  </fieldset>
<div class="botones" align="center">
	<input type="submit" value="Aceptar"/>
	<input type="reset" value="Cancelar" onclick="regresar()"/>
</div>

</form>
</div>
</body>
</html>
	