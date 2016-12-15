<div class="container">
	<div class="row">
		<h3 class="center">
			<?=$titulo?>
		</h3>
       	<h5>Seleccione Periodo</h5>
       	<div class="col s12 m6">
       		<label for="">Fecha Inicial</label>
       		<input type="date" id="fi">
       	</div>
       	<div class="col s12 m6">
       		<label for="">Fecha Final</label>
       		<input type="date" id="ff">
       	</div>
       	<a href="Javascript:setUrl();" class="btn btn_sys right">Ver Informe</a>
		
	</div>
</div>
<script>
	function setUrl(){
		var fi = $("#fi").val();
		var ff = $("#ff").val();

		

		var pathname = window.location.pathname; // Returns path only
		var pathUrl = pathname+"/"+fi+"/"+ff;
		location.href = pathUrl;
	}
</script>