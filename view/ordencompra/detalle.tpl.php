<div class="container" style="    margin-top: 20px;">
	<div class="hide_on_print">
		<div class="col s12">
			<div id="fin_informe">
				<div class="row">
					<div class="col s12 panel">
						<h5>Orden de Compra n° <?=$oc['folio']?></h5>
						<h6><span>Estado</span>: <?=$oc['estadoOc']?></h6>
					</div>
					<div class="col s12">
						<a href="Javascript:print_orden(<?=$oc['folio']?>, <?=$oc['estado']?>);" class="btn red right" id="print_btn"><i class="fa fa-print"></i>Imprimir</a>
						<a href="Javascript:window.history.back();" class="btn blue left"><i class="fa fa-chevron-left"></i>Volver</a>

						<a href="/demotron/ordenCompra/<?=$oc['folio']?>/escaneada" target="_blank" class="btn orange darken-1 left" style="margin-left: 10px;"><i class="fa fa-file-image-o"></i>Escaneada</a>

						<a href="/demotron/ordenCompra/<?=$oc['folio']?>/editar" class="btn left" style="margin-left: 10px;"><i class="fa fa-pencil-square-o"></i>Editar</a>
					</div>
				</div>
			</div>
		</div>
		<div class="separador" style="height: 0px; border-bottom: 2px solid #ECECEC;"></div>
	</div>
</div>


<div class="container">
	<div class="ordenCompra">
		<img src="/demotron/Assets/img/logo.png" alt="" class="logo">
		<h4 class="center tituloOc">ORDEN DE COMPRA</h4>
		<table class="fechaOc">
			<tr>
				<td>Fecha</td>
				<td><?=$oc['fecha']?></td>
			</tr>
			<tr>
				<td><b>Folio</b></td>
				<td><b><?=$oc['folio']?></b></td>
			</tr>
			<tr>
				<td>C.C.</td>
				<td><?=$oc['cc']?></td>
			</tr>
		</table>
		
        

		<table class="datosEmp">
			<tr><td>Rut:</td>	<td>78.066.340-5</td></tr>
			<tr><td>Dir.:</td>	<td>Long. Sur Km 241, Alto Pangue, San Rafael - Talca</td></tr>
			<tr><td>Fono:</td>	<td>071/970663-970664</td></tr>
			<tr><td>Giro:</td>	<td>Construccion</td></tr>
			<tr><td>Mail:</td>	<td>adquisicionesdemotron@gmail.com</td></tr>
		</table>

		<table class="datosProv">
			
			<tr><td>Sr</td>	<td><?=$oc['razon_social']?></td></tr>
			<tr><td>Rut</td>	<td><?=$oc['rut']?></td></tr>
			<tr><td>Att.</td>	<td><?=$oc['representante']?></td></tr>
			<tr><td>Fono</td>	<td><?=$oc['fono']?></td></tr>
			<tr><td>Dir </td>	<td><?=$oc['direccion']?></td></tr>
			<tr><td>Mail</td>	<td><?=$oc['email']?></td></tr>
			<tr><td>Ref</td>	<td>FACTURA Nº </td></tr>

		</table>

		<table class="prodOC">
			<thead>
				<tr>
					<th width="4%">ITEM</th>
					<th width="5%">CANT</th>
					<th width="5%">UNIDAD</th>
					<th width="12%">CARGO</th>
					<th width="11%">PARTE</th>
					<th width="43%">DETALLE</th>
					<th width="10%">VALOR</th>
					<th width="10%">TOTAL</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$cont=1;
					foreach ($productos as $producto) {
						?>
						<tr>
							<td><?=$cont?></td>
							<td><?=$producto['cant']?></td>
							<td><?=$producto['un']?></td>
							<td><?=substr($producto['cargo_c'],0,10)?></td>
							<td><?=$producto['parte']?></td>
							<td><?=$producto['prod']?></td>
							<td><?=number_format($producto['valor'])?></td>
							<td><?=number_format($producto['valor'] * $producto['cant'])?></td>
						</tr>
						<?php
						$cont++;
					}
					for ($i=$cont; $i <=15 ; $i++) { 
						?>
						<tr>
							<td><?=$i?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>

		<table class="totalesOC">
			<tr>
				<td>NETO</td>
				<td>$<?=number_format($oc['neto'])?>.-</td>
			</tr>
			<tr>
				<td>IVA</td>
				<td>$<?=number_format($oc['iva'])?>.-</td>
			</tr>
			<tr>
				<td>TOTAL</td>
				<td>$<?=number_format($oc['total'])?>.-</td>
			</tr>
		</table>

		<table class="otrosDatos">
			<tr>
				<td style="width: 15%; font-weight: bold;">SC N°</td>
				<td><?=$oc['sol_compra']?></td>
				<td style="width: 15%; font-weight: bold;">COTIZACION</td>
				<td><?=$oc['cotizacion']?></td>
			</tr>
		</table>

		<div class="nota">
			<label for="">Nota:</label>
			<span><?=nl2br($oc['notas'])?></span>
		</div>
	
		<div class="formaPago">
			<span><?=$oc['fp']?></span>
			<label for="">Forma de Pago</label>
		</div>
		
		<div class="disclaim">
			<p>Señor Proveedor:</p>

			<p><b style="font-size: .95em; line-height: 1; text-transform: uppercase;">1.- El numero de esta orden de compra debe indicarse en la guia o factura de entrega</b></p>

			<p>2.- Si no puede dar cumplimiento a la entrega de materiales, comuniquelo oportunamente</p>
			<p>3.- La empresa Demotron S.A. Puede anular esta orden de compra si no fuese cumplido el plazo estipulado</p>
		</div>

		<table class="vb">
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				
				<td>V°B° GERENCIA</td>
				<td>V°B° ADQUISICIONES</td>
			</tr>
		</table>
		<div class="codBarra">

			<img src="/demotron/Assets/barcodeGen/html/image.php?filetype=PNG&dpi=120&scale=1&rotation=0&font_family=Arial.ttf&font_size=7&text=<?=$oc['folio']?>&thickness=35&code=BCGcode128" alt="">	
		</div>
		
	</div>

	<?php
	if($cheques->num_rows > 0){
		?>
		<div class="row listaCheques hide_on_print z-depth-1">
			<h5 class="center">Listado Cheques</h5>
			<table id="">
				<thead>
					<th>Boucher</th>	
					<th>Serie</th>
					<th>F. Emision</th>
					<th>F. Cobro</th>
					<th>Monto</th>
				</thead>
				<tbody>
					
					<?php
					while ($chk = $cheques->fetch_assoc()) {
						?>
						<tr>
							<td><?=$chk['boucher']?></td>
							<td><?=$chk['serie']?></td>
							<td><?=$chk['fecha_emision']?></td>
							<td><?=$chk['fecha_cobro']?></td>
							<td>$<?=number_format($chk['monto'])?>.-</td>
							<td class="center"><a href="/demotron/cheques/<?=$oc['folio']?>/imagen" target="_blank">IMG</a></td>
						</tr>
						<?php
					}
					?>
					
				</tbody>
			</table>
		</div>
		<?php
	}
	?>

	<div class="hide_on_print">
	<div class="separador"></div>
		<div class="col s12">
			<div id="fin_informe">
				<div class="row">
					<div class="col s12">
						<a href="Javascript:window.print();" class="btn red right" id="print_btn"><i class="fa fa-print"></i>Imprimir</a>
						<a href="/demotron/ordenCompra" class="btn btn_sys left"><i class="fa fa-chevron-circle-left"></i>Volver</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div id="modal1" class="modal">
<div class="modal-content center">
  <h4>Actualizar Estado Oc</h4>
  <p>¿Desea cambiar el estado Actual (Imprimir) a <b>ESP. GERENCIA</b>?</p>
</div>
<div class="modal-footer">
  <a href="#!" class=" modal-action modal-close waves-effect btn btn_sys" onclick="cambiarEstadoOc('<?=$oc['folio']?>')">Cambiar Estado</a>
  <a href="#!" class=" modal-action modal-close waves-effect btn left red">NO cambiar Estado</a>
</div>
</div>

<script>
	function print_orden(folio, estado){
		console.log(estado);
		if(estado==1){
		 $('#modal1').openModal();
		}
		window.print();
	}

</script>