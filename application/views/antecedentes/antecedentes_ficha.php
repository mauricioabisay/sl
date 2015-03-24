<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<form action="<?php echo site_url();?>/antecedentes/modificar_detalle" method="post" id="ficha" style="width:100%">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<fieldset>
	<legend>Antecedentes No Patol&oacute;gicos</legend>
	<?php $this->load->view('antecedentes/extras/antecedentes_ficha_alcohol');?>
	<?php $this->load->view('antecedentes/extras/antecedentes_ficha_tabaco');?>
	<?php $this->load->view('antecedentes/extras/antecedentes_ficha_ejercicio');?>
	<?php
		if($mujer){
	?>
	<fieldset>
		<legend>Ciclo Menstrual</legend>
		<div class="lineal">
		<label>¿Presenta irregularidades en su ciclo menstrual?</label>
		<?php echo $antecedentes->ciclo_regular;?>
		</div>
	</fieldset>
	<?php
			$this->load->view('antecedentes/extras/antecedentes_ficha_embarazo');	
		}else{
	?>
	<input type="hidden" name="embarazo"  value="No" />
	<?php
		}
	?>
</fieldset>
<div class="botones" align="center">
	<input type="button" " value="Modificar" onclick="window.location.href='<?php echo site_url();?>/antecedentes/modificar/<?php echo $antecedentes->id;?>'" style="margin: 4em;margin-top: 1em;font-size: 95%;padding: 0.2em;" />
</div>
</form>
</body>
</html>