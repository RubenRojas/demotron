<div class="container">
	<h3 class="center"><?=$titulo?></h3>
	<a href="proveedor/nuevo" class="btn btn_sys right btn_nuevo">Nuevo Proveedor</a>
	<table id="listado" style="font-size: .85em;">
		<thead>
			<th>Razon Social</th>
			<th>Rut</th>
			<th>Rep</th>
			<th>Fono</th>
			<th>Detalle</th>
			<th>Editar</th>
			<th>Borrar</th>
		</thead>
		<tbody>
	<?php
	$arr = array();
	while ($arr = $result->fetch_assoc()) {
		?>
			<tr>
				<td><?=$arr['razon_social']?></td>
				<td><?=$arr['rut']?></td>
				<td><?=$arr['representante']?></td>
				<td><?=$arr['fono']?></td>
				<td><a href="proveedor/<?=$arr['id']?>/detalle">Detalle</a></td>
				<td><a href="proveedor/<?=$arr['id']?>/editar">Editar</a></td>
				<td><a href="proveedor/<?=$arr['id']?>/borrar">Borrar</a></td>
			</tr>
		<?php
	}
	?>
		</tbody>
	</table>
	
</div>