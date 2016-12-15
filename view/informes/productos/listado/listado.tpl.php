<div class="container">
	<div class="row">
		<h3 class="center" style="margin-bottom: 110px"><?=$titulo?></h3>

		<table id="listado">
			<thead>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Valor U. Neto</th>
				<th>Ver OC</th>
			</thead>
			<tbody>
				<?php
				while ($arr = $productos->fetch_assoc()) {
					?>
					<tr>
						<td><?=$arr['codigo']?></td>
						<td><?=$arr['prod']?></td>
						<td>$<?=number_format($arr['valor'])?>.-</td>
						<td><a href="/demotron/ordenCompra/<?=$arr['folio']?>/detalle" target="_blank"><?=$arr['folio']?></a></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>