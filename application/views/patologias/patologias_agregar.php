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
<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
	<div id="form">
	<form method="post" action="<?php echo site_url()?>/patologias/agregar" id="formulario" name="formulario">
	<fieldset >
	<legend>Nueva Patolog&iacute;a</legend>
	
	<table class="tabla_formulario">
	<tr>
		<th>Clasificaci&oacute;n</th><th>Patolog&iacute;a</th>
	</tr>	
	<tr>
		<td>
			<select name="clasificacion" id="clasificacion">
				<option value="-1" selected="selected">Seleccionar...</option> 
				<?php 
					foreach($clasificaciones as $i => $dato)
					{
						echo '<option value="'.$dato['id'].'">';
						echo $dato['clasificacion'];
						echo '</option>';
					}
				?>
    		</select>
    		<?php echo form_error('clasificacion'); ?>
  	   	</td>
  	   	<td>
  	   		<div class="lineal">
	  	   		<input type="text" name="nueva_patologia" value="<?php echo set_value('nueva_patologia');?>"/>
	  	   		<?php echo form_error('nueva_patologia'); ?>
  	   		</div>	
  	   	</td>
  	</tr>
   	</table>
   	<fieldset>
   	<legend>Recomendaciones</legend>
   		
			<textarea name="caracteristicas" style="width: 45em; height: 15em;"><?php echo set_value('caracteristicas');?></textarea>
			<?php echo form_error('caracteristicas'); ?>
</fieldset>

<div class="botones" align="center">
	<input type="submit" value="Agregar Patolog&iacute;a"/>
	<input type="reset" value="Cancelar" onclick="regresar()"/>
</div>

</form>
</div>
</body>
</html>
	
