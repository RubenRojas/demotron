<?php
//PARA LOS INFORMES, BASTA CON EL PERMISO 2: READ
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('INFORMES', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 1: CREATE 2: READ 3: UPDATE 4: DELETE */
}
else{
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}
/***************************************************************/
/* 	ORDENES DE COMPRA POR ESTADO
/***************************************************************/
$app->get('/informes/oc/estado', function() use ($mysqli, $pUser) {
	$titulo ="Ordenes de Compra por Estado";
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/estado", "inicio", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
$app->get('/informes/oc/estado/:fecha_i/:fecha_f', function($fecha_i, $fecha_f) use ($mysqli, $pUser) {
	$titulo ="Ordenes de Compra por Estado";
	$oc = Informes::OC_getEstadoResumen($fecha_i, $fecha_f, $mysqli);
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/estado", "resumen", compact("titulo", "oc", "fecha_i", "fecha_f"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
/***************************************************************/
/* 	ORDENES DE COMPRA PARA FIRMA GERENCIA
/***************************************************************/
$app->get('/informes/oc/firmaGerencia', function() use ($mysqli, $pUser) {
	$titulo ="Resumen Ordenes Compra para Aprobación";
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/firmaGerencia", "inicio", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
$app->get('/informes/oc/firmaGerencia/:fecha_i/:fecha_f', function($fecha_i, $fecha_f) use ($mysqli, $pUser) {
	$titulo ="Resumen Ordenes Compra para Aprobación";
	$oc = Informes::OC_getResumenFirma($fecha_i, $fecha_f, $mysqli);
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/firmaGerencia", "resumen", compact("titulo", "oc", "fecha_i", "fecha_f"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
/***************************************************************/
/* 	ORDENES DE COMPRA POR CENTRO DE COSTO
/***************************************************************/
$app->get('/informes/oc/centroCosto', function() use ($mysqli, $pUser) {
	$titulo ="Resumen Ordenes Compra por Centro de Costo";
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/centroCosto", "inicio", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
$app->get('/informes/oc/centroCosto/:anio', function($anio) use ($mysqli, $pUser) {
	$titulo ="Resumen Ordenes Compra por Centro de Costo";
	$oc = Informes::OC_getOrdenesCompraCentroCosto($anio, $mysqli);
	$MESES = array("1"=>"Enero", "2"=>"Febrero", "3"=>"Marzo", "4"=>"Abril", "5"=>"Mayo", "6"=>"Junio", "7"=>"Julio", "8"=>"Agosto", "9"=>"Septiembre", "10"=>"Octubre", "11"=>"Noviembre", "12"=>"Diciembre");
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/centroCosto", "resumen", compact("titulo", "oc", "anio", "MESES"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
/***************************************************************/
/* 	LISTADO DE PRODUCTOS EN EL SISTEMA
/***************************************************************/
$app->get('/informes/productos/listado', function() use ($mysqli, $pUser) {
	$titulo ="Listado de Productos";
	$productos  = ProductoOC::getProductosOC($mysqli);
	if(in_array("2", $pUser)){
		View::view("informes/productos/listado", "listado", compact("titulo", "productos"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
/***************************************************************/
/* 	ORDENES DE COMPRA POR PROVEEDOR
/***************************************************************/
$app->get('/informes/oc/proveedor', function() use ($mysqli, $pUser) {
	$titulo ="Listado de OC por Proveedor";
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/proveedor", "inicio", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});

/***************************************************************/
/* 	INFORME DON ROBERTO
/***************************************************************/
$app->get('/informes/oc/pagosMes', function() use ($mysqli, $pUser) {
	$titulo ="Informe de Pagos Mensuales por Centro Costo";
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/gerencia", "inicio", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	 
});
$app->get('/informes/oc/pagosMes/:anio/:meses', function($anio, $meses) use ($mysqli, $pUser) {
	$titulo ="Informe de Pagos Mensuales por Centro Costo";
	$cc = CentroCosto::getCentroCostos($mysqli);
	$centro_costos = array();
	$MESES = array("1"=>"ENE", "2"=>"FEB", "3"=>"MAR", "4"=>"ABR", "5"=>"MAY", "6"=>"JUN", "7"=>"JUL", "8"=>"AGO", "9"=>"SEP", "10"=>"OCT", "11"=>"NOV", "12"=>"DIC");
	while ($arr = $cc->fetch_assoc()) {
		$centro_costos[$arr['id']] = $arr['nombre'];
	}

	$data = Informes::OC_getInformeRobertoVentura($centro_costos, $meses, $anio, $mysqli);

	$meses = substr($meses,0,-1);
	$lmeses = explode("-", $meses);
	if(in_array("2", $pUser)){
		View::view("informes/ordenCompra/gerencia", "resultado", compact("titulo", "data", "centro_costos", "MESES", "lmeses"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}	  
});