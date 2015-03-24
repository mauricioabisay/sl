<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<a href="<?php echo site_url()?>/evaluacion/detalle/<?php echo $id_evaluacion;?>">Regresar a la Evaluaci&oacute;n</a>
<form method="post" id="ficha">
<input type="hidden" name="paciente" value="<?php echo $id_paciente;?>" />
<input type="hidden" name="evaluacion" value="<?php echo $id_evaluacion;?>" />
<fieldset>
	<legend>Preguntas de Seguimiento</legend>
	<fieldset>
		<legend>Experiencia Personal</legend>
		<div class="lineal">
			<label>&iquest;Siente que perdi&oacute; peso?</label>
			<span><?php echo $preguntas->perdida_peso;?></span>
		</div>
		<div class="lineal">
			<label>	&iquest;Qu&eacute; funciona tanto que no quiere modificar?</label>
			<span><?php echo $preguntas->conservar;?></span>
		</div>
		<div class="lineal">
			<label>Cumplimiento:</label>
			<span><?php echo $preguntas->cumplimiento;?></span>
		</div>
		<div class="lineal">
			<label>Motivaci&oacute;n:</label>
			<span><?php echo $preguntas->motivacion;?></span>
		</div>
		<div class="lineal">
			<label>Desgaste:</label>
			<span><?php echo $preguntas->desgaste;?></span>
		</div>
		<div class="lineal">
			<label>Meta establecida:</label>
			<span><?php echo $preguntas->meta_valor;?></span><strong>kgs.</strong>
		</div>
		<div class="lineal">
			<label>Fecha para alcanzar su meta:</label>
			<span><?php echo $preguntas->meta_fecha;?></span>
		</div>
		
		<div class="lineal">
			<label>&iquest;Hizo las tareas establecidas?</label>
			<span><?php echo $preguntas->hizo_tareas;?></span>
		</div>
		<?php if(stristr($preguntas->hizo_tareas,'No')){?>
				<div class="lineal">
					<label>&iquest;Porqu&eacute;?</label>
					<span><?php echo $preguntas->tareas;?></span>
				</div>
		<?php }?>
	</fieldset>
	<fieldset>
		<legend>Episodios</legend>
		<div class="lineal">
			<label>&iquest;Tuvo episodios de hambre(sensaci&oacute;n en est&oacute;mago)?</label>
			<span><?php echo $preguntas->hambre;?></span>
		</div>
		<div class="lineal">
			<?php
			$aux_tiempo = DateTime::createFromFormat('H:i:s',$preguntas->hambre_hora);
			if($aux_tiempo){?>
				<label>&iquest;A qu&eacute; hora?</label>
				<span><?php echo $aux_tiempo->format('h:i a');?></span>	
			<?php }?>
			<?php
			$hora_rel = FALSE;
			switch($preguntas->hambre_hora_relativa){
				case 'm':{$hora_rel='Ma&ntilde;ana';break;}
				case 'md':{$hora_rel='Medio D&iacute;a';break;}
				case 't':{$hora_rel='Tarde';break;}
				case 'n':{$hora_rel='Noche';break;}
			}
			if($hora_rel){?>
				<label>Alrededor de:</label>
				<span><?php echo $hora_rel;?></span>
			<?php }?>
		</div>
		<div class="lineal">
			<?php
			$aux_tiempo = DateTime::createFromFormat('H:i:s',$preguntas->ansiedad_hora);
			if($aux_tiempo){?>
				<label>&iquest;A qu&eacute; hora?</label>
				<span><?php echo $aux_tiempo->format('h:i a');?></span>	
			<?php }?>
		</div>
		<div class="lineal">
			<label>&iquest;Tuvo episodios de ansiedad(sensaci&oacute;n en pecho, manos y boca)?</label>
			<span><?php echo $preguntas->ansiedad;?></span>
		</div>
		<div class="lineal">
			<?php
			$aux_tiempo = DateTime::createFromFormat('H:i:s',$preguntas->ansiedad_hora);
			if($aux_tiempo){?>
				<label>&iquest;A qu&eacute; hora?</label>
				<span><?php echo $aux_tiempo->format('h:i a');?></span>	
			<?php }?>
			<?php
			$hora_rel = FALSE;
			switch($preguntas->ansiedad_hora_relativa){
				case 'm':{$hora_rel='Ma&ntilde;ana';break;}
				case 'md':{$hora_rel='Medio D&iacute;a';break;}
				case 't':{$hora_rel='Tarde';break;}
				case 'n':{$hora_rel='Noche';break;}
			}
			if($hora_rel){?>
				<label>Alrededor de:</label>
				<span><?php echo $hora_rel;?></span>
			<?php }?>
		</div>
	</fieldset>
	<fieldset>
		<legend>Alimentaci&oacute;n</legend>
		<div class="lineal">
			<label>&iquest;Desea eliminar alg&uacute;n tiempo de comida?</label>
			<span>
				<?php
					$bd = array('Des','Co1','Com','Co2','Cen');
					$normal = array('Desayuno','Colaci&oacute;n Ma&ntilde;ana','Comida','Colaci&oacute;n Tarde','Cena');
					$cadena = str_replace($bd,$normal, $preguntas->tiempo_eliminar); 
					echo $cadena;
				?>
			</span>
		</div>
		<?php if(!stristr($preguntas->tiempo_eliminar, 'No')){?>
				<div class="lineal">
					<label>&iquest;Porqu&eacute;?</label>
					<span><?php echo $preguntas->tiempo_eliminar_razon;?></span>
				</div>
		<?php }?>
		<div class="lineal">
			<label>&iquest;Desea agregar alg&uacute;n tiempo de comida?</label>
			<span>
				<?php
					$cadena = str_replace($bd,$normal, $preguntas->tiempo_agregar); 
					echo $cadena;
				?>
			</span>
		</div>
		<?php if(!stristr($preguntas->tiempo_agregar, 'No')){?>
				<div class="lineal">
					<label>&iquest;Porqu&eacute;?</label>
					<span><?php echo $preguntas->tiempo_agregar_razon;?></span>
				</div>
		<?php }?>
		<div class="lineal">
			<label>&iquest;Qu&eacute; alimentos quiere eliminar?</label>
			<span><?php echo $preguntas->alimento_eliminar;?></span>
		</div>
		<div class="lineal">
			<label>&iquest;Qu&eacute; alimentos quiere agregar?</label>
			<span><?php echo $preguntas->alimento_agregar;?></span>
		</div>
	</fieldset>
	<fieldset>
		<legend>Ejercicio</legend>
		<div class="lineal">
			<label>&iquest;Hizo ejercicio?</label>
			<?php echo $preguntas->ejercicio;?>
		</div>
		<?php if($preguntas->ejercicio=='Si'){?>
				<div class="lineal">
					<label>Duraci&oacute;n:</label>
					<span><?php echo $preguntas->ejercicio_duracion;?></span><strong>minutos</strong>
				</div>
				<div class="lineal">
					<label>Frecuencia:</label>
					<span><?php echo $preguntas->ejercicio_frec;?></span><strong>veces a la semana</strong>
				</div>
				<div class="lineal">
					<label>Tipo de ejercicio realizado:</label>
					<span><?php echo $preguntas->ejercicio_tipo;?></span>
					<?php if(stristr($preguntas->ejercicio_tipo, 'Otro')){?>
								<span><?php echo $preguntas->ejercicio_otro;?></span>
					<?php }?>
				</div>
		<?php }?>
	</fieldset>
</fieldset>
</form>
</body>
</html>