<div class="container">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>
		<table id="listado">
			<thead>
				<th>Serie</th>
				<th>OC</th>
				<th>Proveedor</th>
				<th>F. Emision</th>
				<th>F. Cobro</th>
				<th>Monto</th>
				<th>Detalle</th>
			</thead>
			<tbody>
				<?php/*
				while ($arr = $result->fetch_assoc()) {
					?>
					<td><?=$arr['serie']?></td>
					<td><?=$arr['oc']?></td>
					<td><?=$arr['razon_social']?></td>
					<td><?=$arr['fecha_emision']?></td>
					<td><?=$arr['fecha_cobro']?></td>
					<td><?=$arr['monto']?></td>
					<td><?=$arr['serie']?></td>
					<?php
				}*/
				?>
			</tbody>
		</table>
	</div>
</div>