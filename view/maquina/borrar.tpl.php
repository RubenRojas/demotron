<div class="container">	
	<form action="../<?=$user['id']?>" method="post">
		<div class="row">
			<h3 class="center"><?=$titulo?></h3>
			<p class="center">¿Deseas borrar la maquina <b><?=$user['nombre']?> <?=$user['modelo']?> [<?=$user['codigo']?>]</b>?</p>		
			<div class="col s12">
				<input type="hidden" name="_METHOD" value="DELETE"/>
				<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
				<input type="submit" value="Borrar" class="btn btn_sys right">
			</div>
		</div>
	</form>
</div>