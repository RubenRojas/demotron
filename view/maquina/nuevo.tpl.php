<div class="container">
	<form method="post" action="../maquina" enctype="multipart/form-data">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="col s12 m2">
				<label for="">Codigo</label>
				<input type="text" name="codigo">
			</div>
			
			<div class="col s12 m4">
				<label for="">Equipo</label>
				<select name="equipo" id="" class="browser-default">
					<option value="">Seleccionar</option>
					<?php
					while ($arr = $equipos->fetch_assoc()) {
						?>
						<option value="<?=$arr['id']?>"><?=$arr['nombre']?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col s12 m4">
				<label for="">Marca</label>
				<input type="text" name="marca">
			</div>
			<div class="col s12 m2">
				<label for="">Placa</label>
				<input type="text" name="placa" value="">
			</div>

			<div class="col s12 m2">
				<label for="">Año</label>
				<input type="text" name="anio">
			</div>
			<div class="col s12 m3">
				<label for="">Modelo</label>
				<input type="text" name="modelo">
			</div>
			<div class="col s12 m3">
				<label for="">Chasis</label>
				<input type="text" name="chasis">
			</div>
			<div class="col s12 m4">
				<label for="">Serie Motor</label>
				<input type="text" name="serie">
			</div>
			
			<div class="col s12">
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Guardar" class="btn btn_sys right">
			</div>
		</div>
	</form>
</div>