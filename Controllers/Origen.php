<?php
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('ORIGEN', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 1: CREATE 2: READ 3: UPDATE 4: DELETE */
}
else{
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}

//listado de usuarios
$app->get('/origenes', function() use($mysqli, $pUser){
	$result = Origen::getOrigenes($mysqli);
	$titulo = "Listado Origen Usuario";

	if(in_array("2", $pUser)){
		View::view("origen", "listado", compact("result", "titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}

})->name("listadoOrigenes");

//formulario nuevo usuario
$app->get('/origenes/nuevo', function() use($mysqli, $pUser){
	$titulo = "Nuevo Origen";

	if(in_array("1", $pUser)){
		View::view("origen", "nuevo", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
});

//agregar nuevo usuario
$app->post('/origenes', function() use($mysqli, $app){
	// Para acceder a los datos recibidos del formulario
	$datosform = $app->request;


	$nombre 	= $datosform->post('nombre');
	$nOrigen 	= new Origen("", $nombre);

	$nOrigen->insertDB($mysqli); //usuario agregado a la BD

	if($nOrigen->get("id")!= NULL){		
		$_SESSION['mensaje']['tipo']='SUCCESS';
		$_SESSION['mensaje']['texto'] = "Origen ingresado al Sistema";	
	}
	else{
		$_SESSION['mensaje']['tipo']='ERROR';
		$_SESSION['mensaje']['texto'] = "Hubo una falla: ".$mysqli->error.".<br>No se ingresó al Sistema";		
	}

	$app->response->redirect($app->urlFor('listadoOrigenes'), 303);
});

//pagina editar
$app->get('/origenes/:idContrato/editar', function($idContrato) use ($mysqli, $pUser) {
	$titulo ="Editar Origen";

	$origen = Origen::getOrigenById($idContrato, $mysqli);

	if(in_array("3", $pUser)){
		View::view("origen", "editar", compact("titulo", "origen"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});

//editar usuario
$app->put('/origenes/:idContrato',function($idContrato) use($mysqli,$app) {

	$datosform 			= $app->request;
	$nombre 			= $datosform->post('nombre');
	


	$nContrato = new Origen($idContrato, $nombre);

	$nContrato->updateDB($mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se ha actualizado correctamente";

	$app->response->redirect($app->urlFor('listadoOrigenes'), 303);
});

//pagina Borrar
$app->get('/origenes/:idusuario/borrar', function($usuarioID) use ($mysqli, $pUser) {
	$titulo ="Borrar Origen";
	$user = Origen::getOrigenById($usuarioID, $mysqli);

	if(in_array("4", $pUser)){
		View::view("origen", "borrar", compact("titulo", "user"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});
//borrar usuario
$app->delete('/origenes/:idusuario',function($idusuario) use($mysqli,$app) {

	Origen::borrarOrigen($idusuario, $mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se realizado correctamente el borrado.";

	$app->response->redirect($app->urlFor('listadoOrigenes'), 303);
});

//otras rutas de contrato
