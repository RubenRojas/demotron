<div class="contenedor">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>
		<a href="cheques/nuevo" class="btn btn_sys right btn_nuevo">Nuevo Cheque</a>
		<table id="listado">
			<thead>
				<th>Boucher</th>	
				<th>Serie</th>
				<th>OC</th>
				<th>Proveedor</th>
				<th>F. Emision</th>
				<th>F. Cobro</th>
				<th>Monto</th>
				<th>Editar</th>
				<th>Imagen</th>
			</thead>
			<tbody>
				
				<?php
				while ($arr = $result->fetch_assoc()) {
							?>
					<tr>
						<td><?=$arr['boucher']?></td>
						<td><?=$arr['serie']?></td>
						<td><a href="ordenCompra/<?=$arr['oc']?>/detalle"><?=$arr['oc']?></a></td>
						<td><?=$arr['razon_social']?></td>
						<td class="center"><?=$arr['fecha_emision']?></td>
						<td class="center"><?=$arr['fecha_cobro']?></td>
						<td>$<?=number_format($arr['monto'])?>.-</td>
						<td class="center"><a href="cheques/<?=$arr['serie']?>/editar">Editar</a></td>
						<td class="center"><a href="cheques/<?=$arr['oc']?>/imagen" target="_blank">IMG</a></td>
					</tr>
					<?php
				}
				?>
				
			</tbody>
		</table>
	</div>
</div>