<html>
		if($menor){
			$this->load->view('calculo_energetico/extras/calculo_infante');
		}else{
			$this->load->view('calculo_energetico/extras/calculo_adulto');
		}
	?>
	<div class="botones" align="center">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Restaurar" />
	</div>
	<!--</div>-->
	<!--<div class="columnader">
		<?php $this->load->view('calculo_energetico/extras/ficha_ejercicio');?>
	</div>-->
</form>
<script>
$('#formulario').submit(function(){setTimeout(function(){
		parent.listado_mini.location='<?php echo site_url()?>/calculo/listado_mini/<?php echo $id_paciente;?>';
	},100);});
</script>
</body>
</html>