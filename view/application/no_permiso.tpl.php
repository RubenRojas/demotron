<div class="container">
	<div class="row">
		<h3 class="center">Acceso Denegado.</h3>
		<?php
		if(isset($_SESSION['id'])){
			?>
			<h5 class="center">Lo siento, pero en estos momentos no tiene autorización para acceder a este contendido.<br><br>Contáctese con el Administrador.</h5>
			<p class="center" style="width: 100%; display: flex; margin-top: 40px; "><a href="Javascript:window.history.back();" class="btn red left" style="display: block; margin:auto;">Volver</a></p>
			<h5 class="center"><i class="fa fa-ban" style="font-size: 8em; margin-top: 16px; color: #F44336;"></i></h5>
			<?php
		}
		else{
			?>
			<h5 class="center">Por razones de seguridad, su sesión ha caducado. Para continuar, vuelva a iniciar Sesión.</h5>
			<p class="center" style="width: 100%; display: flex; margin-top: 40px; "><a href="/demotron/" class="btn left btn_sys" style="display: block; margin:auto;">Iniciar Sesion</a></p>
			<?php
		}
		?>
		
		
	
		
	</div>
</div>