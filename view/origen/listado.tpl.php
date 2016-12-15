<div class="container">
	<h3 class="center"><?=$titulo?></h3>
	<a href="origenes/nuevo" class="btn btn_sys right btn_nuevo">Nuevo Origen</a>
	<table id="listado" style="font-size: 0.82em;">
		<thead>
			<th>Nombre</th>
			<th>Editar</th>
			<th>Borrar</th>
		</thead>
		<tbody>
	<?php
	$arr = array();
	while ($arr = $result->fetch_assoc()) {
		?>
			<tr>
				<td><?=$arr['nombre']?></td>
				<td><a href="origenes/<?=$arr['id']?>/editar">Editar</a></td>
				<td><a href="origenes/<?=$arr['id']?>/borrar">Borrar</a></td>
			</tr>
		<?php
	}
	?>
		</tbody>
	</table>
	
</div>