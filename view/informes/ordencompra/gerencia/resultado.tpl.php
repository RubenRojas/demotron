<div class="container">
	<div class="row">
		<h3 class="center">
			<?=$titulo?>
		</h3>
		<table class="informe">
			<thead>
				<th>Centro Costo</th>		
				<?php
				foreach ($lmeses as $lmes) {
					?><th><?=$MESES[$lmes]?></th><?php
				}
				?>
			</thead>
			<tbody>

				
			
				<?php
				foreach ($centro_costos as $cc_id=>$cc_nombre) {
					?>
					<tr>
						<td><?=$cc_nombre?></td>
						<?php
						foreach ($lmeses as $lmes) {
							if(isset($data[$lmes][$cc_id])){
								?><td class="numero">$<?=number_format($data[$lmes][$cc_id])?>.-</td><?php	
								$MESES[$lmes] +=$data[$lmes][$cc_id];
							}
							else{
								?><td class="numero">$0.-</td><?php		
							}
							
						}
						?>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td><b>TOTALES</b></td>
					<?php
					
					foreach ($lmeses as $lmes) {
						if(!is_string($MESES[$lmes])){
							?><td class="numero"><b>$<?=number_format($MESES[$lmes])?></b>.-</td><?php
						}
						else{
							?><td class="numero"><b>$0.-</b></td><?php	
						}
					}

					?>
				</tr>
			</tbody>
		</table>		
	</div>
</div>
