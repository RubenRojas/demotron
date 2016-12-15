<div class="container">
	<div class="row">
		<h3 class="center"><?=$titulo?></h3>

		<form action="../cheques" method="post" id="form">
			<div class="col s12 m4">
				<label for="">Folio OC</label>
				<input type="text" name="oc" value="<?=$arr['oc']?>">
			</div>
			<div class="col s12 m4">
				<label for="">Serie</label>
				<input type="text" name="serie" value="<?=$arr['serie']?>">
			</div>
			<div class="col s12 m4">
				<label for="">Boucher</label>
				<input type="text" name="boucher" value="<?=$arr['boucher']?>">
			</div>

			<div class="col s12 m3">
				<label for="">Fecha Emision</label>
				<input type="date" name="fecha_emision" value="<?=$arr['fecha_emision']?>">
			</div>
			<div class="col s12 m3">
				<label for="">Fecha Cobro</label>
				<input type="date" name="fecha_cobro" value="<?=$arr['fecha_cobro']?>">
			</div>
			<div class="col s12 m6">
				<label for="">Monto</label>
				<input type="text" name="monto" value="<?=$arr['monto']?>">
			</div>
			<div class="col s12">
				<input type="hidden" name="_METHOD" value="PUT"/>
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Guardar" class="btn btn_sys right">
			</div>
		</form>
	</div>
</div>