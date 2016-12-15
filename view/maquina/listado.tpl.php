<div class="container">
	<h3 class="center"><?=$titulo?></h3>
	<a href="maquina/nuevo" class="btn btn_sys right btn_nuevo">Nueva Maquina</a>
	<table id="listado" style="font-size: 0.82em;">
		<thead>
			<th>Cod.</th>
			<th>Equipo</th>
			<th>Patente</th>
			<th>Marca</th>
			<th>Modelo</th>
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
				<td><?=$arr['codigo']?></td>
				<td><?=$arr['nombre']?></td>
				<td><?=$arr['placa']?></td>
				<td><?=$arr['marca']?></td>
				<td><?=$arr['modelo']?></td>
				<td><a href="maquina/<?=$arr['id']?>/detalle">Detalle</a></td>
				<td><a href="maquina/<?=$arr['id']?>/editar">Editar</a></td>
				<td><a href="maquina/<?=$arr['id']?>/borrar">Borrar</a></td>
			</tr>
		<?php
	}
	?>
		</tbody>
	</table>
	
</div>