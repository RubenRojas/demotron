<div class="container">
	<div class="row">
		<h3 class="center">
			<?=$titulo?>
		</h3>
       	<h5>Seleccione el o los meses</h5>
       	<div class="col s12" id="data">
       		<?php
       		$MESES = array("1"=>"Enero", "2"=>"Febrero", "3"=>"Marzo", "4"=>"Abril", "5"=>"Mayo", "6"=>"Junio", "7"=>"Julio", "8"=>"Agosto", "9"=>"Septiembre", "10"=>"Octubre", "11"=>"Noviembre", "12"=>"Diciembre");
       		foreach ($MESES as $numero => $nombre) {
       			?>
       			<div class="col s2">
       				<input type="checkbox" name="mes" value="<?=$numero?>" style="position: relative; left: 0; visibility: visible; width: 25px; height:25px"> <span style="line-height: 0; margin-top: -20px; display: block; margin-left: 28px; margin-bottom:30px;"><?=$nombre?></span>
       			</div>
       			<?php
       		}
       		?>
       	</div>
       	<h5>Ingrese el año</h5>
       	<input type="text" name="anio" value="<?=date("Y")?>" id="anio">
       	</div>
       	<a href="Javascript:setUrl();" class="btn btn_sys right">Ver Informe</a>
		
	</div>
</div>
<script>
	function setUrl(){
		var str="";
		
		console.log(str)
		$("#data").find("input:checked").each(function(index, el) {
			str = str+$(el).val()+"-";
		});
		console.log(str);
		var anio = $("#anio").val();

		var pathname = window.location.pathname; // Returns path only
		var pathUrl = pathname+"/"+anio+"/"+str;
		location.href = pathUrl;
	}
</script>