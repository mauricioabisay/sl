<fieldset>
	<legend>Mifflin <?php echo $mifflin['total'];?> Kcal.</legend>
	<table class="listado" style="font-size: 80%">
		<thead>
			<tr>
				<th>Gasto</th>
				<th>F&oacute;rmula</th>
				<th>Sustituci&oacute;n</th>
				<th>Kcal.</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Gasto Energ&eacute;tico</td>
				<td><?php echo $mifflin['formula'];?></td>
				<td><?php echo $mifflin['sustitucion'];?></td>
				<td><strong><?php echo $mifflin['total'];?></strong></td>
			</tr>
		</tbody>
	</table>
</fieldset>