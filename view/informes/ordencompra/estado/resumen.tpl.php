<div class="container">	
	<div class="row">
		<h3 class="center">
			<?=$titulo?>
		</h3>
       <div class="info">
       	<p>Resumen de Ordenes de Compra según el estado, filtrado por un rango de fecha.</p>
       </div>
        <div class="panel">
            <h6><span>Fecha Inicial</span>: <?=$fecha_i?></h6>
            <h6><span>Fecha Final</span>: <?=$fecha_f?></h6>
        </div>
		<div class="col s12 m12">
			<table class="informe">
				<thead>
					<th>Estado</th>
					<th>Cantidad</th>
					<th>Neto</th>
					<th>Iva</th>
					<th>Total</th>
					<th class="hide_on_print">Detalle</th>
				</thead>
				<tbody>
					<?php
						$sumaCant	= 0;
						$sumaNeto	= 0;
						$sumaIva	= 0;
						$sumaTotal	= 0;
					while($arr = $oc->fetch_assoc()){

						?>
						<tr>
							<td><?=$arr['nombre']?></td>
							<td class="txt_right"><?=$arr['cant']?></td>
							<td class="txt_right">$<?=number_format($arr['neto'])?>.-</td>
							<td class="txt_right">$<?=number_format($arr['iva'])?>.-</td>
							<td class="txt_right">$<?=number_format($arr['total'])?>.-</td>
							<td class="hide_on_print"><?=$arr['id']?></td>
						</tr>
						<?php
						$sumaCant += $arr['cant'];
						$sumaNeto += $arr['neto'];
						$sumaIva += $arr['iva'];
						$sumaTotal += $arr['total'];

					}
					?>
						<tr>
							<td><b>TOTALES</b></td>
							<td class="txt_right"><b><?=number_format($sumaCant)?></b></td>
							<td class="txt_right"><b>$ <?=number_format($sumaNeto)?>.-</b></td>
							<td class="txt_right"><b>$ <?=number_format($sumaIva)?>.-</b></td>
							<td class="txt_right"><b>$ <?=number_format($sumaTotal)?>.-</b></td>
							<td class="hide_on_print"></td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
