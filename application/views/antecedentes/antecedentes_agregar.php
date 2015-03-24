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
<body>
<?php 
if(isset($tipo)){
	echo '<div><span id="'.$tipo.'">';
	echo '<img src="'.base_url().'/assets/img/'.$tipo.'.png" height="15px" width="15px"><strong>'.$mensaje.'</strong>';
	echo '</span></div>';
}
?>
<form action="<?php echo site_url();?>/antecedentes/agregar/<?php echo $id_paciente;?>" method="post" id="formulario" target="contenido" style="width:100%">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<fieldset>
	<legend>Antecedentes No Patol&oacute;gicos</legend>
	<?php $this->load->view('antecedentes/extras/antecedentes_agregar_alcohol');?>
	<?php $this->load->view('antecedentes/extras/antecedentes_agregar_tabaco');?>
	<?php $this->load->view('antecedentes/extras/antecedentes_agregar_ejercicio');?>
	<?php
		if($mujer){
	?>
	<fieldset>
		<legend>Ciclo Menstrual</legend>
		<div class="lineal">
			<label>¿Presenta irregularidades en su ciclo menstrual?</label>
			<input name="ciclo_regular" type="radio" value="Si" <?php echo set_radio('ciclo_regular','Si');?> /><label>Si</label>
			<input name="ciclo_regular" type="radio" value="No" <?php echo set_radio('ciclo_regular','No');?> /><label>No</label>
		</div>
	</fieldset>
	<?php					
			$this->load->view('antecedentes/extras/antecedentes_agregar_embarazo');
	?>
	<?php	
		}else{
	?>
		<input type="hidden" name="embarazo"  value="No" />
		<input type="hidden" name="lactancia"  value="No" />
		<input type="hidden" name="ciclo_regular" value="No" />
	<?php
		}
	?>
</fieldset>
<div class="botones" align="center">
	<input type="submit" value="Guardar" />
	<input type="reset" value="Restaurar"/>
</div>
</form>
<script>
$('#formulario').submit(function(){setTimeout(function(){
		parent.listado_mini.location='<?php echo site_url()?>/antecedentes/listado_mini/<?php echo $id_paciente;?>';
	},200);});
</script>
</body>
</html>