<div class="container">
	<form method="post" action="cambioEstadoOc" enctype="multipart/form-data" id="form">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="info">
				Ingresar los numeros de orden de compra, separados por coma, sin espacios entre ellos.
			</div>
			<div class="col s12 m12">
				<label for="">Ingresar N° de Oc</label>
				<textarea name="listaOc" id="" cols="30" rows="10" style="height:120px"></textarea>
			</div>
			<div class="col s12">
				<label for="">Seleccionar Nuevo Estado</label>
				<select name="estado" id="">
					<option value=""></option>
					<?php
					while ($arr = $estados->fetch_assoc()) {
						?>
						<option value="<?=$arr['id']?>"><?=$arr['nombre']?></option>
						<?php
					}
					?>
				</select>
			</div>
			
			<div class="col s12">
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Guardar" class="btn btn_sys right">
			</div>
		</div>
	</form>
</div>
<script>
	$("#form").keypress(function(e){
		if (e.which == 13){
            return false;
        }
	});	
</script>