<div class="container formularioOrdenCompra">
<div class="row">
	<h3 class="center"><?=$titulo?></h3>
	<form action="../<?=$oc['folio']?>" method="post" id="form">
		<div class="col s12 m3">
			<label for="">Fecha</label>
			<input type="date" name="fecha" value="<?=$oc['fecha']?>">
		</div>
		<div class="col s12 m3">
			<label for="">N° Folio</label>
			<input type="text" name="folio" value="<?=$oc['folio']?>" onchange="getEstadoFolio(this.value)" id="folioOC">

		</div>
		<div class="col s12 m6">
			<label for="">Proveedor</label>
			<select name="proveedor" id="proveedor" required onchange="getDataProveedor(this.value);">
				<option value=""></option>
				<?php
				while ($arr = $proveedores->fetch_assoc()) {

					?>
					<option value="<?=$arr['id']?>" <?php if($oc['proveedor'] == $arr['id']){ ?> selected <?php } ?>><?=$arr['razon_social']?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div class="col s12 m4">
			<label for="">Rut</label>
			<input type="text" name="rut_prov" value="<?=$oc['rut']?>" id="rut_prov">
		</div>
		<div class="col s12 m4">
			<label for="">Att</label>
			<input type="text" name="rep_prov" value="<?=$oc['representante']?>" id="rep_prov">
		</div>
		<div class="col s12 m4">
			<label for="">Fono</label>
			<input type="text" name="fono_prov" value="<?=$oc['fono']?>" id="fono_prov">
		</div>
		<div class="col s12 m12">
			<label for="">Direccion</label>
			<input type="text" name="dir_prov" value="<?=$oc['direccion']?>" id="dir_prov">
		</div>
	</div>
</div>
<div class="contenedor formularioOrdenCompra">
	<div class="col s12" style="padding: 15px;">
		<input type="checkbox" id="valores_iva" onchange="calcula_valor();" name="valores_iva" value="SI" <?php if($oc['valores_iva']=="SI"){ ?> checked <?php }  ?>/>
  		<label for="valores_iva">Valores con IVA incluído</label>
	</div>
	<div class="row">
		<div class="divider"></div>
		<table class="prodOC" style="margin-bottom: 2px; margin-top: 15px;">
			<thead>
				<tr>
					<th width="3%">ITEM</th>
					<th width="5%">CANT</th>
					<th width="6%">UNIDAD</th>
					<th width="9%">CARGO</th>
					<th width="12%">PARTE</th>
					<th width="">DETALLE</th>
					<th width="10%">VALOR</th>
					<th width="10%">TOTAL</th>
				</tr>
			</thead>
		</table>
<?php
for ($i=0; $i < count($productos); $i++){ 
	mysqli_data_seek ($unidadesProducto, 0) ;//reset result set
	mysqli_data_seek ($maquinas, 0) ;//reset result set
	mysqli_data_seek ($centroCosto, 0) ;//reset result set
	
	
	//mysql_data_seek($centroCostoProduto, 0) ;//reset result set

	?>
	<div class="item_oc">
		<a href="Javascript:borra_linea(<?=$i?>)" class="borra_linea"><i class="fa fa-trash"></i></a>
		<input type="text" name="item_<?=$i?>" style="width: 3%" value=<?=$i+1?> disabled>
		
		<input type="text" name="cant_<?=$i?>" value="<?=$productos[$i]['cant']?>" id="cant_<?=$i?>" style="width: 5%" onchange="calcula_valor()">
		
		<select name="unidad_<?=$i?>" id="unidad_<?=$i?>" style="width: 6%;" class="browser-default">
		<option value=""></option>
		<?php while ($arr = $unidadesProducto->fetch_assoc()) {					?>
			<option value="<?=$arr['id']?>" <?php if($productos[$i]['unidad'] == $arr['id']){ ?> selected <?php } ?>><?=$arr['nombre']?></option>
		<?php } ?>
		</select>
		
		<select name="cc_<?=$i?>" id="cc_<?=$i?>" style="width: 9%;" class="browser-default">
			<option value=""></option>
		<?php

		while ($arr = $centroCosto->fetch_assoc()) {?>
		<option value="CC_<?=$arr['id']?>"  <?php if($productos[$i]['cargo'] == "CC_".$arr['id']){ ?> selected <?php } ?> ><?=$arr['nombre']?></option>
		<?php
		}
		?>

		<option value="">------</option>
		<?php
		while ($arr = $maquinas->fetch_assoc()) { ?>
			<option value="MQ_<?=$arr['id']?>"  <?php if($productos[$i]['cargo'] == "MQ_".$arr['id']){ ?> selected <?php } ?> ><?=$arr['codigo']?></option>			
		<?php
		}
		?>
		</select>
		
		<input type="text" name="parte_<?=$i?>" style="width: 12%" value="<?=$productos[$i]['parte']?>">
		
		<input type="text" name="detalle_<?=$i?>" id="detalle_<?=$i?>" value="<?=htmlspecialchars($productos[$i]['prod'])?>" style="width: 45%" onkeyup="update_contador(<?=$i?>)">
		<span class="contador" id="contador_<?=$i?>">45</span>
		
		<input type="text" name="valor_<?=$i?>"  id="valor_<?=$i?>" style="width: 10%" value="<?=number_format($productos[$i]['valor'])?>" onchange="format_input(this), calcula_valor()" >
		
		<input type="text" name="total_<?=$i?>" id="total_<?=$i?>" value="<?=number_format($productos[$i]['total'])?>" style="width: 10%">
		
		<input type="hidden" name="id_prod_<?=$i?>" id="id_prod_<?=$i?>">
	</div>
	<?php
}
for ($i=count($productos); $i < 15; $i++) { 
			?>
			<div class="item_oc">
				<a href="Javascript:borra_linea(<?=$i?>)" class="borra_linea"><i class="fa fa-trash"></i></a>
				<input type="text" name="item_<?=$i?>" style="width: 3%" value=<?=$i+1?> disabled>
				<input type="text" name="cant_<?=$i?>" id="cant_<?=$i?>" style="width: 5%" onchange="calcula_valor()">
				<select name="unidad_<?=$i?>" id="unidad_<?=$i?>" style="width: 6%;" class="browser-default"><?=$un?></select>
				<select name="cc_<?=$i?>" id="cc_<?=$i?>" style="width: 9%;" class="browser-default"><?=$cc?></select>
				<input type="text" name="parte_<?=$i?>" style="width: 12%">
				<input type="text" name="detalle_<?=$i?>" id="detalle_<?=$i?>" style="width: 45%" onkeyup="update_contador(<?=$i?>)">
				<span class="contador" id="contador_<?=$i?>">45</span>
				<input type="text" name="valor_<?=$i?>"  id="valor_<?=$i?>" style="width: 10%" onchange="format_input(this), calcula_valor()">
				<input type="text" name="total_<?=$i?>" id="total_<?=$i?>" style="width: 10%">
				<input type="hidden" name="id_prod_<?=$i?>" id="id_prod_<?=$i?>">
			</div>
			<?php
		}
?>
		<table class="totalesOC">
			<tr style="height: 27px;">
				<td>NETO</td>
				<td><input type="text" name="neto" value="<?=number_format($oc['neto'])?>" id="neto_oc"></td>
			</tr>
			<tr style="height: 27px;">
				<td>IVA</td>
				<td><input type="text" name="iva" value="<?=number_format($oc['iva'])?>" id="iva_oc" ></td>
			</tr>
			<tr style="height: 27px;">
				<td>TOTAL</td>
				<td><input type="text" name="total" value="<?=number_format($oc['total'])?>" id="total_oc" ></td>
			</tr>
		</table>

		<div class="col s12 m9">
			<div class="col s12 m4">
				<label for="">SC N°</label>
				<input type="text" name="sol_compra" value="<?=$oc['sol_compra']?>">
			</div>
			<div class="col s12 m4">
				<label for="">Cotización N°</label>
				<input type="text" name="cotizacion" value="<?=$oc['cotizacion']?>">
			</div>
			<div class="col s12 m4">
				<label for="">Forma de Pago</label>
				<select name="forma_pago" id="" required>
				<?php while ($arr = $formaPagoOC->fetch_assoc()) {					?>
					<option value="<?=$arr['id']?>" <?php if($oc['forma_pago'] == $arr['id']){ ?> selected <?php } ?>><?=$arr['nombre']?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col s12 m8">
				<label for="">Notas</label>
				<textarea name="notas" id="" cols="30" rows="10" style="height:60px;"> <?=$oc['notas']?></textarea>
			</div>
			<div class="col s12 m4">
				<label for="">Centro Costo OC</label>
				<select name="centro_costo" id="">
				<?php while ($arr = $centroCostoOc->fetch_assoc()) {					?>
					<option value="<?=$arr['id']?>" <?php if($oc['centro_costo'] == $arr['id']){ ?> selected <?php } ?>><?=$arr['nombre']?></option>
				<?php } ?>
				</select>
			</div>
		</div>

		<div class="col s12">
			<input type="hidden" name="_METHOD" value="PUT"/>
			<a href="Javascript:window.history.back();" class="btn red left">Cancelar</a>
			<input type="submit" value="Guardar Cambios" class="btn btn_sys right">
		</div>
	</form>
	</div>
</div>

<script>
	$(document).ready(function(){
		check_contador();
	});
	$(function() {
      <?php
      for ($i = 0; $i < 15; $i++) {
      	?>
      	$("#detalle_<?=$i?>").autocomplete({
          source: function( request, response ) {
          $.ajax({
              url: "/demotron/productos/"+$("#detalle_<?=$i?>").val()+"/buscar",
              data: {nombre: request.term},
              dataType: "json",
              success: function( data ) {
              console.log(data);
              response( $.map( data, function( item ) {
                      return {
                          label: item.nombre,
                          value: item.nombre,
                          id: item.id,
                      }
                  }));
              }
          });
      },
      minLength: 2,
          select: function(event, ui) {
              var url = ui.item.nombre;
              $("#detalle_<?=$i?>").val(ui.item.nombre);
              $("#id_prod_<?=$i?>").val(ui.item.id);              
          }, 
          html: false,
          open: function(event, ui) {
              $(".ui-autocomplete").css("z-index", 1000);
          }
      });
      	<?php
      }
      ?>
  });



	
</script>