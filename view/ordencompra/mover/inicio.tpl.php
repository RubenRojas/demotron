<div class="container">
	<div class="row">
		<h3 class="center">
			<?=$titulo?>
		</h3>
       	<h5>Seleccione Intervalo de Oc</h5>
       	<div id="ocultar">
	       	<div class="col s12 m6">
	       		<label for="">Numero Inicial</label>
	       		<input type="number" id="fi">
	       	</div>
	       	<div class="col s12 m6">
	       		<label for="">Numero Final</label>
	       		<input type="number" id="ff">
	       	</div>
       	</div>
       	<div id="loader">
       		
       	</div>
       	<a href="Javascript:setUrl();" class="btn btn_sys right">Mover Ordenes</a>
		
	</div>
</div>
<script>
	function setUrl(){
		var fi = $("#fi").val();
		var ff = $("#ff").val();
		moverArchivos(fi, ff);

	}
</script>