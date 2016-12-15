<div class="container">
	<form method="post" action="../<?=$maquina['id']?>" enctype="multipart/form-data">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="col s12 m2">
				<label for="">Codigo</label>
				<input type="text" name="codigo" value="<?=$maquina['codigo']?>">
			</div>
			
			<div class="col s12 m4">
				<label for="">Equipo</label>
				<select name="equipo" id="" class="browser-default">
					<option value="">Seleccionar</option>
					<?php
					while ($arr = $equipos->fetch_assoc()) {
						?>
						<option value="<?=$arr['id']?>"
						<?php if($arr['id']==$maquina['equipo']){ ?> selected <?php } ?>><?=$arr['nombre']?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col s12 m4">
				<label for="">Marca</label>
				<input type="text" name="marca" value="<?=$maquina['marca']?>">
			</div>
			<div class="col s12 m2">
				<label for="">Placa</label>
				<input type="text" name="placa" value="<?=$maquina['placa']?>">
			</div>

			<div class="col s12 m2">
				<label for="">Año</label>
				<input type="text" name="anio" value="<?=$maquina['anio']?>">
			</div>
			<div class="col s12 m3">
				<label for="">Modelo</label>
				<input type="text" name="modelo" value="<?=$maquina['modelo']?>">
			</div>
			<div class="col s12 m3">
				<label for="">Chasis</label>
				<input type="text" name="chasis" value="<?=$maquina['chasis']?>">
			</div>
			<div class="col s12 m4">
				<label for="">Serie Motor</label>
				<input type="text" name="serie" value="<?=$maquina['serie']?>">
			</div>
			
			<div class="col s12">
				<input type="hidden" name="_METHOD" value="PUT"/>
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Guardar" class="btn btn_sys right">
			</div>
		</div>
	</form>
</div>