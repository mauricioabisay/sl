<html>
	<head>
		<link href="<?php echo base_url();?>/assets/css/main_css.php" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
	</head>
	<body>
<table class="listado_oculto" style="display:block">
	<thead>
		<tr>
			<th colspan="3"><?php echo $titulo;?></th>
		</tr>
		<tr>
			<th>L&iacute;m.Inferior</th>
			<th>L&iacute;m.Superior</th>
			<th>Diagn&oacute;stico</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($tabla as $fila){
		?>
				<tr>
					<td><?php echo $fila->valor_inf;?></td>
					<td><?php echo $fila->valor_sup;?></td>
					<td><?php echo $fila->diagnostico;?></td>
				</tr>
		<?php
			}
		?>
	</tbody>
</table>
</body>
</html>