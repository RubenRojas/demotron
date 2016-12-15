<div class="container">
	<form method="post" action="../formaPago" enctype="multipart/form-data">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="col s12 m12">
				<label for="">Nombre</label>
				<input type="text" name="nombre" value="">
			</div>
			
			<div class="col s12">
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Guardar" class="btn btn_sys right">
			</div>
		</div>
	</form>
</div>