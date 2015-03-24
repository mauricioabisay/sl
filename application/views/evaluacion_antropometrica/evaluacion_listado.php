<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado" style="width: 100%">
	<thead>
		<tr><td class="nuevo" align="center"><a href="<?php echo site_url();?>/evaluacion/agregar/<?php echo $id_paciente;?>">Nueva Evaluaci&oacute;n</a></td></tr>
		<tr>
			<th colspan="3">&nbsp;</th>
			<th colspan="2">Grasa Corporal Tanita</th>
			<th colspan="2">Grasa Corporal Pliegues</th>
			<th colspan="3">&nbsp;</th>
		</tr>
		<tr>
			<th>Fecha</th>
			<th>Peso</th>
			<th>Estatura</th>
			<th>%</th>
			<th>Kilogramos</th>
			<th>%</th>
			<th>Kilogramos</th>
			<th>Masa Magra</th>
			<th>Kilos de Agua</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($resultados) && $resultados != FALSE)
		foreach ($resultados as $evaluacion) {
	?>
		<tr>
			<td><?php echo $evaluacion->fecha;?></td>
			<td><?php echo $evaluacion->peso;?><strong>kgs.</strong></td>
			<td><?php echo $evaluacion->estatura;?><strong>mts.</strong></td>
			<td><?php echo $evaluacion->grasa;?></td>
			<td><?php $aux_kg_grasa = $evaluacion->peso*($evaluacion->grasa/100);echo number_format($aux_kg_grasa,2);?><strong>kgs.</strong></td>
			<?php
				if($evaluacion->p_biciptal>0&&$evaluacion->p_triciptal>0&&$evaluacion->p_subescapular>0&&$evaluacion->p_suprailiaco>0){
					$aux_eval_fecha = DateTime::createFromFormat('d-m-Y',$evaluacion->fecha_eval);
					$edad = date_diff($aux_eval_fecha, $fecha_nac);
					$valor = $evaluacion->p_biciptal + $evaluacion->p_triciptal + $evaluacion->p_subescapular + $evaluacion->p_suprailiaco;
					if($valor<15){
						$grasa_pliegues = FALSE;
					}else{
						$valor = ceil($valor);
						$aux = $valor%5;
						if($aux>=3){
							$valor_aux = $valor+(5-$aux);
						}else{
							$valor_aux = $valor-$aux;
						}
						mysql_connect($this->db->hostname,$this->db->username,$this->db->password);
						mysql_select_db('sl');
						$sql = 'select * from ';
						if($mujer){
							$sql.='tabla_pliegues_mujeres ';
						}else{
							$sql.='tabla_pliegues_hombres ';
						}
						$sql.= 'where sumatoria = '.$valor_aux.'';
						$res = mysql_query($sql);
						if($res){
							$tabla_pliegues = mysql_fetch_array($res,MYSQL_BOTH);
							if((17<=$edad->y)&&($edad->y<=29)){
								$grasa_pliegues = $tabla_pliegues['17-29'];
							}else if((30<=$edad->y)&&($edad->y<=39)){
								$grasa_pliegues = $tabla_pliegues['30-39'];
							}else if((40<=$edad->y)&&($edad->y<=49)){
								$grasa_pliegues = $tabla_pliegues['40-49'];
							}else if(50<=$edad->y){
								$grasa_pliegues = $tabla_pliegues['50mas'];
							}else{
								$grasa_pliegues = FALSE;
							}	
						}else{
							$grasa_pliegues = FALSE;
						}
					}
			?>
			<?php if($grasa_pliegues){?>
					<td><?php echo ($grasa_pliegues)?$grasa_pliegues:'';?></td>
					<td><?php echo ($grasa_pliegues)?number_format(($evaluacion->peso*($grasa_pliegues/100)),2):'';?><strong>kgs.</strong></td>
			<?php }else{?>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
			<?php }?>
					
			<?php
				}else{?>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
			<?php }?>
			
			<?php
			$sql = 'select * from eval_tanita ';
			$sql.= 'where id_eval = '.$evaluacion->id.' and concepto="General" ';
			mysql_connect($this->db->hostname,$this->db->username,$this->db->password);
			mysql_select_db('sl');
			$res = mysql_query($sql);
			if(($res)&&(mysql_num_rows($res)>0)){$tanita = mysql_fetch_object($res);?>
				<td><?php echo $tanita->masa_magra;?></td>
				<td><?php echo $tanita->agua_total;?></td>
			<?php
			}else{?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php }?>
			<td>
				<a href="<?php echo site_url()?>/evaluacion/detalle/<?php echo $evaluacion->id;?>">Detalle</a>
				<a href="<?php echo site_url()?>/evaluacion/modificar/<?php echo $evaluacion->id;?>">Modificar</a>
				<!--<a href="<?php echo site_url()?>/evaluacion/borrar/<?php echo $evaluacion->id;?>">Borrar</a>-->
			</td>		
		</tr>
	<?php
		}
	?>
	</tbody>
</table>
</body>
</html>
