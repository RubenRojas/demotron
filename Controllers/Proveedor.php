<?php
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('PROVEEDOR', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 1: CREATE 2: READ 3: UPDATE 4: DELETE */
}
else{
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}

//listado de usuarios
$app->get('/proveedor', function() use($mysqli, $pUser){
	$result = Proveedor::getProveedores($mysqli);
	$titulo = "Listado Proveedores";

	if(in_array("2", $pUser)){
		View::view("proveedor", "listado", compact("result", "titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}

})->name("listadoProveedores");

//formulario nuevo usuario
$app->get('/proveedor/nuevo', function() use($mysqli, $pUser){
	$titulo = "Nuevo Proveedor";

	if(in_array("1", $pUser)){
		View::view("proveedor", "nuevo", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
});

//agregar nuevo usuario
$app->post('/proveedor', function() use($mysqli, $app){
	// Para acceder a los datos recibidos del formulario
	$datosform = $app->request;

	$razon_social 	= $datosform->post('razon_social');
	$rut 			= $datosform->post('rut');
	$representante 	= $datosform->post('representante');
	$fono 			= $datosform->post('fono');
	$email 			= $datosform->post('email');
	$direccion 		= $datosform->post('direccion');

	$nProveedor 	= new Proveedor("" ,$razon_social ,$rut ,$representante ,$fono ,$email ,$direccion);

	$nProveedor->insertDB($mysqli); //usuario agregado a la BD

	if($nProveedor->get("id")!= NULL){		
		$_SESSION['mensaje']['tipo']='SUCCESS';
		$_SESSION['mensaje']['texto'] = "Proveedor ingresado al Sistema";	
	}
	else{
		$_SESSION['mensaje']['tipo']='ERROR';
		$_SESSION['mensaje']['texto'] = "Hubo una falla: ".$mysqli->error.".<br>No se ingresó al Sistema";		
	}

	$app->response->redirect($app->urlFor('listadoProveedores'), 303);
});

//pagina editar
$app->get('/proveedor/:idContrato/editar', function($idContrato) use ($mysqli, $pUser) {
	$titulo ="Editar Proveedor";

	$origen = Proveedor::getProveedorById($idContrato, $mysqli);

	if(in_array("3", $pUser)){
		View::view("proveedor", "editar", compact("titulo", "origen"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});

//editar usuario
$app->put('/proveedor/:idContrato',function($idContrato) use($mysqli,$app) {

	$datosform 			= $app->request;
	$razon_social 	= $datosform->post('razon_social');
	$rut 			= $datosform->post('rut');
	$representante 	= $datosform->post('representante');
	$fono 			= $datosform->post('fono');
	$email 			= $datosform->post('email');
	$direccion 		= $datosform->post('direccion');

	$nContrato 	= new Proveedor($idContrato ,$razon_social ,$rut ,$representante ,$fono ,$email ,$direccion);


	$nContrato->updateDB($mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se ha actualizado correctamente";

	$app->response->redirect($app->urlFor('listadoProveedores'), 303);
});

//pagina Borrar
$app->get('/proveedor/:idusuario/borrar', function($usuarioID) use ($mysqli, $pUser) {
	$titulo ="Borrar Proveedor";
	$user = Proveedor::getProveedorById($usuarioID, $mysqli);

	if(in_array("4", $pUser)){
		View::view("proveedor", "borrar", compact("titulo", "user"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});
//borrar usuario
$app->delete('/proveedor/:idusuario',function($idusuario) use($mysqli,$app) {

	Proveedor::borrarProveedor($idusuario, $mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se realizado correctamente el borrado.";

	$app->response->redirect($app->urlFor('listadoProveedores'), 303);
});

//otras rutas de contrato

//pagina detalle
$app->get('/proveedor/:idContrato/detalle', function($idContrato) use ($mysqli, $pUser) {
	$titulo ="Detalle Proveedor";

	$origen = Proveedor::getProveedorById($idContrato, $mysqli);

	if(in_array("2", $pUser)){
		View::view("proveedor", "detalle", compact("titulo", "origen"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	 
});
$app->get('/proveedor/:idContrato/detalleOc', function($idContrato) use ($mysqli, $pUser) {

	$origen = Proveedor::getProveedorById($idContrato, $mysqli);
	echo json_encode($origen);

});