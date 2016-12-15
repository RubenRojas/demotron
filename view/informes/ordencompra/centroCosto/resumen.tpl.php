<div class="container">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>
		
		 <div class="panel">
            <h6><span>Año</span>: <?=$anio?></h6>
        </div>
	</div>
	<table class="informe">
		<thead>
			<th>Centro Costo</th>
			<?php
			foreach ($MESES as $mes) {
				?>
				<th><?=substr($mes, 0, 3)?></th>
				<?php
			}
			?>
			<th>Total</th>
		</thead>
		<tbody>
			<?php
			$suma['cc'] = 0;
			$suma['total'] = 0;
			$suma['centro_costo'] = array();
			$data = json_decode($oc, true);

			for($j=1;$j<=12;$j++){
				$suma['centro_costo'][$j] = 0;
			}
			
			

			
			for ($i=0; $i < count($data); $i++) { //controla los centro_costo
				?>
				<tr>
					<td><b><?=$data[$i]['nombre']?></b></td>
					<?php	
					$suma['cc'] = 0;
					for($j=1;$j<=12;$j++){ //controla los meses
						?>
						<td style="text-align:right;">$<?=number_format($data[$i][$j])?>.-</td>
						<?php
						 $suma['cc'] += $data[$i][$j];
						 $suma['centro_costo'][$j] += $data[$i][$j];
					}
					$suma['total'] += $suma['cc'];
					?>
					<td style="text-align:right;">$<?=number_format($suma['cc'])?>.-</td>
				</tr>
				<?php
			}
			

			?>
			<tr>
				<td><b>Totales</b></td>
				<?php
				foreach ($suma['centro_costo'] as $value) {
					?>
					<td style="text-align:right;">$<?=number_format($value)?>.-</td>
					<?php
				}
				?>
				<td style="text-align:right;">$<?=number_format($suma['total'])?>.-</td>
			</tr>
		</tbody>
	</table>
</div>
