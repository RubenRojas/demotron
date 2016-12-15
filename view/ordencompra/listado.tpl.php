
<div class="contenedor">
	<h3 class="center"><?=$titulo?></h3>
	<div class="info">
		Listado con las ultimas 150 ordenes de compra.
	</div>
	<a href="ordenCompra/nuevo" class="btn btn_sys right btn_nuevo">Nueva Orden de Compra</a>
	<table id="listado" >
		<thead>
			<th>Folio</th>
			<th>CC</th>
			<th>Fecha</th>
			<th>Proveedor</th>
			<th>Total</th>
			<th>Estado</th>
			<th>IMG</th>
			<th>VER</th>
			<th>EDITAR</th>
		</thead>
		<tbody>
	<?php
	$arr = array();
	while ($arr = $result->fetch_assoc()) {
		?>
			<tr>
				<td><?=$arr['folio']?></td>
				<td><?=$arr['cc']?></td>
				<td><?=$arr['fecha']?></td>
				<td><?=substr($arr['razon_social'], 0, 50)?></td>
				<td class="txt_right">$<?=number_format($arr['total'])?>.-</td>
				<td><?=$arr['estadoOc']?></td>
				<td><a href="ordenCompra/<?=$arr['folio']?>/escaneada" target="_blank">IMG</a></td>
				<td><a href="ordenCompra/<?=$arr['folio']?>/detalle">VER</a></td>
				<td><a href="ordenCompra/<?=$arr['folio']?>/editar">EDITAR</a></td>

			</tr>
		<?php
	}
	?>
		</tbody>
	</table>
	
</div>
