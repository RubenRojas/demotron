<div class="container">
	<div class="row">
		<h3 class="center">
			<?=$titulo?>
		</h3>
       	<h5>Seleccione Año</h5>
       	<div class="col s12 ">
       		<label for="">Año</label>
       		<select name="anio" id="anio">
       			<?php
       			for ($i=2016; $i < 2025; $i++) { 
       				?>
       				<option value="<?=$i?>" 
       					<?php 
       					if($i == date('Y')){ 
       						?> selected <?php
       					} ?>
       					><?=$i?>
       						
       					</option>
       				<?php
       			}
       			?>
       		</select>
       	</div>
       	<a href="Javascript:setUrl();" class="btn btn_sys right">Ver Informe</a>
		
	</div>
</div>
<script>
	function setUrl(){
		var fi = $("#anio").val();

		

		var pathname = window.location.pathname; // Returns path only
		var pathUrl = pathname+"/"+fi;
		location.href = pathUrl;
	}
</script>