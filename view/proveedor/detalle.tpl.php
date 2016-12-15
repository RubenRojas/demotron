<div class="container">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<div class="col s12 m6">
				<label for="">Razon Social</label>
				<span class="dato"><?=$origen['razon_social']?></span>
			</div>
			<div class="col s12 m3">
				<label for="">Rut</label>
				<span class="dato"><?=$origen['rut']?></span>
			</div>
			
			<div class="col s12 m3">
				<label for="">Fono</label>
				<span class="dato"><?=$origen['fono']?></span>
			</div>
			<div class="col s12 m6">
				<label for="">Representante</label>
				<span class="dato"><?=$origen['representante']?></span>
			</div>
			<div class="col s12 m6">
				<label for="">Email</label>
				<span class="dato"><?=$origen['email']?></span>
			</div>
			<div class="col s12 m6">
				<label for="">Direccion</label>
				<span class="dato"><?=$origen['direccion']?></span>
			</div>
			
			<div class="col s12">
				<a href="Javascript:window.history.back();" class="btn red left">Volver</a>
				<a href="../<?=$origen['id']?>/editar" class="btn btn_sys right">Editar</a>
			</div>
		</div>
</div>