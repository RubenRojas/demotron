<div class="container formularioOrdenCompra">
<div class="row">
	<h3 class="center"><?=$titulo?></h3>
	<form action="../ordenCompra" method="post" id="form">
		<div class="col s12 m3">
			<label for="">Fecha</label>
			<input type="date" name="fecha" value="<?=$HOY?>">
		</div>
		<div class="col s12 m3">
			<label for="">N° Folio</label>
			<input type="text" name="folio" value="<?=$nFolio?>" onchange="getEstadoFolio(this.value)" id="folioOC">
		</div>
		<div class="col s12 m6">
			<label for="">Proveedor</label>
			<select name="proveedor" id="proveedor" required onchange="getDataProveedor(this.value);">
				<option value=""></option>
				<?php
				while ($arr = $proveedores->fetch_assoc()) {
					?>
					<option value="<?=$arr['id']?>"><?=$arr['razon_social']?></option>
					<?php
				}
				?>
			</select>
		</div>
		
		<div class="col s12 m4">
			<label for="">Rut</label>
			<input type="text" name="rut_prov" id="rut_prov">
		</div>
		<div class="col s12 m4">
			<label for="">Att</label>
			<input type="text" name="rep_prov" id="rep_prov">
		</div>
		<div class="col s12 m4">
			<label for="">Fono</label>
			<input type="text" name="fono_prov" id="fono_prov">
		</div>
		<div class="col s12 m12">
			<label for="">Direccion</label>
			<input type="text" name="dir_prov" id="dir_prov">
		</div>
	</div>
</div>

<div class="contenedor formularioOrdenCompra">

	<div class="row">
		<div class="divider"></div>
		<div class="col s12" style="padding: 15px;">
			<input type="checkbox" id="valores_iva" onchange="calcula_valor();" name="valores_iva" value="SI" />
      		<label for="valores_iva">Valores con IVA incluído</label>
		</div>
		<table class="listaProdOc" style="margin-bottom: 2px; margin-top: 15px;">
			<thead>
				<tr>
					<th width="3%">N°</th>
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
		for ($i=0; $i < 15; $i++) { 
			?>
			<div class="item_oc">
				<a href="Javascript:borra_linea(<?=$i?>)" class="borra_linea"><i class="fa fa-trash"></i></a>
				<input type="text" name="item_<?=$i?>" style="width: 3%" value=<?=$i+1?> disabled>
				<input type="text" name="cant_<?=$i?>" id="cant_<?=$i?>" style="width: 5%" onchange="calcula_valor()"  autocomplete="off">
				<select name="unidad_<?=$i?>" id="unidad_<?=$i?>" style="width: 6%;" class="browser-default"><?=$un?></select>
				<select name="cc_<?=$i?>" id="cc_<?=$i?>" style="width: 9%;" class="browser-default"><?=$cc?></select>
				<input type="text" name="parte_<?=$i?>"  id="parte_<?=$i?>" style="width: 12%"  autocomplete="off">
				<input type="text" name="detalle_<?=$i?>" id="detalle_<?=$i?>" style="width: 45%"  autocomplete="off" onkeyup="update_contador(<?=$i?>)">
				<span class="contador" id="contador_<?=$i?>">45</span>
				<input type="text" name="valor_<?=$i?>"  id="valor_<?=$i?>" style="width: 10%" onchange="format_input(this), calcula_valor()"  autocomplete="off">
				<input type="text" name="total_<?=$i?>" id="total_<?=$i?>" style="width: 10%">
				<input type="hidden" name="id_prod_<?=$i?>" id="id_prod_<?=$i?>">
			</div>
			<?php
		}
		?>
		<table class="totalesOC">
			<tr style="height: 27px;">
				<td>NETO</td>
				<td><input type="text" name="neto" id="neto_oc"></td>
			</tr>
			<tr style="height: 27px;">
				<td>IVA</td>
				<td><input type="text" name="iva" id="iva_oc" ></td>
			</tr>
			<tr style="height: 27px;">
				<td>TOTAL</td>
				<td><input type="text" name="total" id="total_oc" ></td>
			</tr>
		</table>

		<div class="col s12 m9">
			<div class="col s12 m4">
				<label for="">SC N°</label>
				<input type="text" name="sol_compra">
			</div>
			<div class="col s12 m4">
				<label for="">Cotización N°</label>
				<input type="text" name="cotizacion">
			</div>
			<div class="col s12 m4">
				<label for="">Forma de Pago</label>
				<select name="forma_pago" id="" required> <?=$fp_oc?> </select>
			</div>
			<div class="col s12 m8">
				<label for="">Notas</label>
				<textarea name="notas" id="" cols="30" rows="10" style="height:60px;"></textarea>
			</div>
			<div class="col s12 m4">
				<label for="">Centro Costo OC</label>
				<select name="centro_costo" id="" required> <?=$cc_oc?> </select>
			</div>
		</div>

		<div class="col s12">
			<a href="Javascript:salir();" class="btn red left">Cancelar</a>
			<input type="submit" value="Generar Orden de Compra" class="btn btn_sys right">
		</div>
	</form>
	</div>
</div>

<script>
	// Prevent the backspace key from navigating back.
$(document).unbind('keydown').bind('keydown', function (event) {
    var doPrevent = false;
    if (event.keyCode === 8) {
        var d = event.srcElement || event.target;
        if ((d.tagName.toUpperCase() === 'INPUT' && 
             (
                 d.type.toUpperCase() === 'TEXT' ||
                 d.type.toUpperCase() === 'PASSWORD' || 
                 d.type.toUpperCase() === 'FILE' || 
                 d.type.toUpperCase() === 'SEARCH' || 
                 d.type.toUpperCase() === 'EMAIL' || 
                 d.type.toUpperCase() === 'NUMBER' || 
                 d.type.toUpperCase() === 'SELECT' ||
                 d.type.toUpperCase() === 'DATE' )
             ) || 
             d.tagName.toUpperCase() === 'TEXTAREA') {
            doPrevent = d.readOnly || d.disabled;
        }
        else {
            doPrevent = true;
        }
    }

    if (doPrevent) {
        event.preventDefault();
    }
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
                      }
                  }));
              }
          });
      },
      minLength: 2,
          select: function(event, ui) {
              var url = ui.item.nombre;
              $("#detalle_<?=$i?>").val(ui.item.nombre);
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

	$(function() {
      <?php
      for ($i = 0; $i < 15; $i++) {
      	?>
      	$("#parte_<?=$i?>").autocomplete({
          source: function( request, response ) {
          $.ajax({
              url: "/demotron/productos/"+$("#parte_<?=$i?>").val()+"/buscarParte",
              data: {nombre: request.term},
              dataType: "json",
              success: function( data ) {
              console.log(data);
              response( $.map( data, function( item ) {
                      return {
                          label: item.parte,
                          value: item.parte,
                          id: item.id,
                          detalle: item.nombre
                      }
                  }));
              }
          });
      },
      minLength: 2,
          select: function(event, ui) {
              var url = ui.item.nombre;
              $("#parte<?=$i?>").val(ui.item.parte);
              $("#id_prod_<?=$i?>").val(ui.item.id);
              $("#detalle_<?=$i?>").val(ui.item.detalle);              	
              
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

function salir(){

	respuesta = confirm ( '¿Seguro que quieres salir?' );

	if ( respuesta ) {
		location.href = "/demotron/ordenCompra";
	} else {
		return false;
	}
	
}



	
</script>