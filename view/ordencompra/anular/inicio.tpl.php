<div class="contenedor">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>
		<a href="nueva" class="btn btn_sys btn_nuevo right">Nueva Anulacion</a>
		<table id="listado">
			<thead>
				<th>Tipo</th>
				<th>Serie</th>
				<th>Fecha</th>
				<th>Motivo</th>
				<th>Imagen</th>
			</thead>
			<tbody>
				<?php 
				while($arr = $result->fetch_assoc()){
					?>
					<tr>
						<td><?=$arr['tipo']?></td>
						<td><?=$arr['folio']?></td>
						<td><?=$arr['fecha']?></td>
						<td><?=$arr['motivo']?></td>
						<td><a href="/demotron/anulacion/<?=$arr['folio']?>/<?=$arr['tipo']?>/imagen" target="_blank">IMG</a></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>