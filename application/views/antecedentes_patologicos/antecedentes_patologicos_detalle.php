<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
	
	
</head>
<body>
	<div id='form'>
	<form method="post" action="<?php echo site_url()?>/antecedentes_patologicos/detalle/<?php echo $id_paciente?>" name="formulario" id="formulario">
		<input type="hidden" name="paciente" value="<?php echo $id_paciente?>" />
		<?php 
		if(isset($tipo)){
			echo '<div><span id="'.$tipo.'">';
			echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
			echo '</span></div>';
		}
		?>
	<fieldset  class="columnaizq">
			<legend>Antecedentes Patol&oacute;gicos</legend>
			<fieldset>
				<legend>Antecedentes Heredofamiliares</legend>
										
				<table class="listado">
					<tr>
						<th>Fecha</th><th>Patolog&iacute;a</th><th>Parentesco</th>
					</tr>
					<?php 
					
					if($personales != NULL){
					foreach($personales as $i => $dato){
						if($dato['hereditaria']=='Si'){
						
					?>
					<tr>
						<td><input disabled size="8" value="<?php echo $dato['fecha_id'];?>"/></td>
						<td><?php echo $dato['patologia'];?></td>
						<td><?php echo $dato['parentesco'];
								  if($dato['otro_parentesco']!= NULL && $dato['parentesco'] == NULL)
								  	echo $dato['otro_parentesco'];
								  elseif($dato['otro_parentesco']!= NULL && $dato['parentesco'] != NULL)
								  	echo ','.$dato['otro_parentesco'];?></td>
					</tr>
					<?php }
						}
					}
					else{
							echo '<tr><td colspan="2">';
							echo 'No hay antecedentes heredofamiliares registrados';	
							echo '</td></tr>';
						}
					 ?>
				</table>
			</fieldset>
			<fieldset>
				<legend>Antecedentes Personales</legend>
				<table class="listado">
					<tr>
						<th>Fecha</th><th>Clasificaci&oacute;n</th><th>Patolog&iacute;a</th><th>Status</th><th></th>
					</tr>
					<?php 
					
					if($personales != NULL){
					foreach($personales as $l => $dato){
						if($dato['hereditaria']=='No'){
							
					 ?>
					<tr>
						<td><input disabled size="8" value="<?php echo $dato['fecha_id'];?>"/></td>
						<td><?php echo $dato['clasificacion'];?></td>
						<td><?php echo $dato['patologia'];?></td>
						<td><?php echo $dato['status'];?></td>
					</tr>
				<?php }}
					}
					else{
						echo '<tr><td colspan="4">';
						echo 'No hay antecedentes personales registrados';		
						echo '</td></tr>';
					}
				?>
				</table>
			</fieldset>			
		</fieldset>
	</form>
</div>
</body>
</html>