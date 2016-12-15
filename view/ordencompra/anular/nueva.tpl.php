<div class="container">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>
		<p class="info">Si selecciona OC, se anularan todos los cheques asociados a esa orden de Compra<br><b>SOLO ANULAR DOCUMENTOS DE UNA ORDEN DE COMPRA A LA VEZ.</b></p>
		
		<form action="" method="post">
			<div class="col s12">
				<div class="col s12 m4">
					<div class="col s12">
						<label for="">Tipo Documento</label>
					</div>
					<div class="col s12 m6">
						<input name="tipo" type="radio" id="test1" value="OC" onclick="bloquea_cheque();"/>
      				<label for="test1">OC</label>
					</div>
					<div class="col s12 m6">
						<input name="tipo" type="radio" id="test2" value="CHEQUE" onclick="libera_cheque();" />
      					<label for="test2">CHEQUE</label>
					</div>
					
				</div>
				<div class="col s12 m4">
					<label for="">Orden de Compra</label>
					<input type="text" name="folio" id="ordenCompra" onchange="deshabilita_cheque(this.value)">
				</div>
				<div class="col s12 m4">
					<label for="">Serie Cheque</label>
					<input type="text" name="folio" id="cheque">
				</div>
				<div class="col s12">
					<label for="">Motivo Anulacion</label>
					<textarea name="motivo" id="" cols="30" rows="20" required></textarea>
				</div>
			</div>
			<div class="col s12">
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Confirmar Anulacion" class="btn btn_sys right">
			</div>
		</form>
	</div>
</div>

<script>
function deshabilita_cheque(val){
	if(val != ''){
		$("#cheque").attr("disabled", "true");
	}
	else{
		$("#cheque").removeAttr("disabled");
	}
	
}

function bloquea_cheque(){
	$("#cheque").attr("disabled", "true");
	$("#ordenCompra").removeAttr("disabled");
}
function libera_cheque(){
	$("#ordenCompra").attr("disabled", "true");
	$("#cheque").removeAttr("disabled");
}
	
</script>