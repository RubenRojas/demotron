<div class="container">
	<form method="post" action="../<?=$origen['id']?>" enctype="multipart/form-data">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="col s12 m6">
				<label for="">Razon Social</label>
				<input type="text" name="razon_social" value="<?=$origen['razon_social']?>" required>
			</div>
			<div class="col s12 m3">
				<label for="">Rut</label>
				<input type="text" name="rut" value="<?=$origen['rut']?>" id="rut_cl" required>
			</div>
			<div class="col s12 m3">
				<label for="">Representante</label>
				<input type="text" name="representante" value="<?=$origen['representante']?>">
			</div>
			<div class="col s12 m3">
				<label for="">Fono</label>
				<input type="text" name="fono" value="<?=$origen['fono']?>">
			</div>
			<div class="col s12 m3">
				<label for="">Email</label>
				<input type="email" name="email" value="<?=$origen['email']?>">
			</div>
			<div class="col s12 m6">
				<label for="">Direccion</label>
				<input type="text" name="direccion" value="<?=$origen['direccion']?>">
			</div>
			
			<div class="col s12">
				<input type="hidden" name="_METHOD" value="PUT"/>
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Guardar" class="btn btn_sys right">
			</div>
		</div>
	</form>
</div>