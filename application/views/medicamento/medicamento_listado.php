<html>
<head>
<div id="horario_molde" style="display: none">
<table class="listado">
<!--<a onclick="open('<?php echo site_url()?>/medicamento/modificar_id/<?php echo $medicamento->id;?>','aux','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=255')"><img height="24" width="24" src="<?php echo base_url();?>assets/img/modificar.png"></a>-->
<a href="<?php echo site_url()?>/medicamento/borrar_id/<?php echo $medicamento->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/borrar.png"></a>
<!--<a onclick="open('<?php echo site_url()?>/medicamento/modificar_id/<?php echo $medicamento->id;?>','aux','toolbar=NO,location=NO,status=NO,menubar=NO,width=300,height=255')"><img height="24" width="24" src="<?php echo base_url();?>assets/img/modificar.png"></a>-->
<a href="<?php echo site_url()?>/medicamento/borrar_id/<?php echo $medicamento->id;?>"><img height="24" width="24" src="<?php echo base_url();?>assets/img/borrar.png"></a>
<?php }?>
			<label>A&ntilde;o</label>
			<div id="horarios_0">
			<?php 
					<select name="minutos[]">
					<select name="ampm[]">
		<?php for($i=1; $i < $num; $i++){?>
				<label>Nombre:</label><input type="text" size="15" name="nombre[]" value="<?php echo (isset($nombre))?$nombre[$i]:'';?>" />
			<select name="fecha_ini_mes[]">
			<label>A&ntilde;o</label>
				<?php if($i+1 < $num){?>
					<select name="minutos[]">
					<select name="ampm[]">
	</fieldset>
<script>