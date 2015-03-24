<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
	
	<script language="JavaScript" type="text/JavaScript">
	   //Función que actualiza el select de las patologías cuando se elige una clasificación
	    $(document).ready(function(){
	        $("#clasificacion").change(function(event){
	            var id = $("#clasificacion").find(':selected').val();           
	            $("#patologia").load('patologias_select?id='+id);
	      
	        });
	    
	    });
    </script>
    
    <script language="JavaScript" type="text/JavaScript">
		//Función que carga los valores de la patología cuando es seleccionada	   
	    $(document).ready(function(){
	        $("#patologia").change(function(event){
	            var id = $("#patologia").find(':selected').val();           
	            $("#valores_patologia").load('buscar?id='+id);
	      
	        });
	    
	    });
	</script>
	
	<script language="JavaScript" type="text/javascript">
		//Se llama a la función agregar del controlador
		function agregar(){			
			$("#form").load('agregar');
		}
		
		//Se llama a la función eliminar del controlador
		function eliminar(){
			 var id = $("#patologia").find(':selected').val();
			$("#patologia").load('eliminar?id='+id);
		}		//Se llama a la función modificar del controlador		function modificar(){						var id = $("#patologia").find(':selected').val();			$("#form").load('modificar?id='+id);		}
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
	<form method="post" action="<?php echo site_url()?>/patologias/consultar" name="formulario" id="formulario">	
	<fieldset>
			<legend>Patolog&iacute;as</legend>
			<table class="tabla_formulario">
				<tr>
					<th>Clasificaci&oacute;n</th><th>Patolog&iacute;a</th><th colspan="3"></th>
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
			  	   	</td>
			  		<td>
						<select name="patologia" id="patologia" >
				   		</select>
			   		</td>
			   		<td>
			   			<input type="button" value="Nueva Patolog&iacute;a" onclick="agregar()"/>
			   		</td>
			   		<td>
			   			<input type="button" value="Modificar Patolog&iacute;a" onclick="modificar()"/>
			   		</td>
			   		<td>
						<input type="reset" value="Eliminar Patolog&iacute;a" onclick="eliminar()"/>
					</td>
				</tr>
			</table>
			<fieldset>
				<legend>Recomendaciones</legend>
				<div id="valores_patologia">
				</div>
			</fieldset>
			
		</fieldset>
</form>
</div>
</body>
</html>