<div class="container">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>
		<div class="info"><p>Listado resumen de las ordenes de compra para firmar, con el valor acumulado según fecha. <b>Valores Iva Inc.</b></p></div>
		 <div class="panel">
            <h6><span>Fecha Inicial</span>: <?=$fecha_i?></h6>
            <h6><span>Fecha Final</span>: <?=$fecha_f?></h6>
        </div>
	</div>
	<table class="informe">
		<thead>
			<tr>
				<th></th>
				<th colspan="2">Acumulado</th>
				<th colspan="2">Pendiente</th>
			</tr>
			<tr>
				<th>Centro Costo</th>
				<th>Cant.</th>
				<th>Monto</th>
				<th>Cant.</th>
				<th>Monto</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sumaCantAcum = 0;
			$sumaTotalAcum = 0;
			$sumaCantPendiente = 0;
			$sumaTotalPendiente = 0;
			while ($arr = $oc->fetch_assoc()) {
				?>
				<tr>
					<td class="txt_left"><?=$arr['nombre']?></td>
					<td class="txt_right"><?=number_format($arr['cantAcum'])?></td>
					<td class="txt_right">$<?=number_format($arr['totalAcum'])?>.-</td>
					<td class="txt_right"><?=number_format($arr['cantPendiente'])?></td>
					<td class="txt_right">$<?=number_format($arr['totalPendiente'])?>.-</td>
				</tr>
				<?php
				$sumaCantAcum += $arr['cantAcum'];
				$sumaTotalAcum += $arr['totalAcum'];
				$sumaCantPendiente += $arr['cantPendiente'];
				$sumaTotalPendiente += $arr['totalPendiente'];
			}
			?>
			<tr>
				<td><b>Totales</b></td>
				<td class="txt_right"><b><?=number_format($sumaCantAcum)?></b></td>
				<td class="txt_right"><b>$<?=number_format($sumaTotalAcum)?>.-</b></td>
				<td class="txt_right"><b><?=number_format($sumaCantPendiente)?></b></td>
				<td class="txt_right"><b>$<?=number_format($sumaTotalPendiente)?>.-</b></td>
			</tr>

		</tbody>
	</table>
</div>
