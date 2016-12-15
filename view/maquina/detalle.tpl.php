<div class="container">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="col s12 m2">
				<label for="">Codigo</label>
				<span class="dato"><?=$maquina['codigo']?></span>
			</div>
			
			<div class="col s12 m4">
				<label for="">Equipo</label>
				<span class="dato"><?=$maquina['nombre']?></span>
				
			</div>
			<div class="col s12 m4">
				<label for="">Marca</label>
				<span class="dato"><?=$maquina['marca']?></span>
			</div>
			<div class="col s12 m2">
				<label for="">Placa</label>
				<span class="dato"><?=$maquina['placa']?></span>
			</div>

			<div class="col s12 m2">
				<label for="">Año</label>
				<span class="dato"><?=$maquina['anio']?></span>
			</div>
			<div class="col s12 m3">
				<label for="">Modelo</label>
				<span class="dato"><?=$maquina['modelo']?></span>
			</div>
			<div class="col s12 m3">
				<label for="">Chasis</label>
				<span class="dato"><?=$maquina['chasis']?></span>
			</div>
			<div class="col s12 m4">
				<label for="">Serie Motor</label>
				<span class="dato"><?=$maquina['serie']?></span>
			</div>
			
			<div class="col s12">
				<a href="Javascript:window.history.back();" class="btn red left">Volver</a>
				<a href="../<?=$maquina['id']?>/editar" class="btn btn_sys right">Editar</a>
			</div>
		</div>
	</form>
</div>