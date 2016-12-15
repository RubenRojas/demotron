<?php
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('TIPOMAQUINA', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 1: CREATE 2: READ 3: UPDATE 4: DELETE */
}
else{
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}

//listado de usuarios
$app->get('/tipoMaquina', function() use($mysqli, $pUser){
	$result = TipoMaquina::getTipoMaquinas($mysqli);
	$titulo = "Listado Tipos Maquina";

	if(in_array("2", $pUser)){
		View::view("tipoMaquina", "listado", compact("result", "titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}

})->name("listadoTipoMaquinas");

//formulario nuevo usuario
$app->get('/tipoMaquina/nuevo', function() use($mysqli, $pUser){
	$titulo = "Nuevo Tipo Maquina";

	if(in_array("1", $pUser)){
		View::view("tipoMaquina", "nuevo", compact("titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
});

//agregar nuevo usuario
$app->post('/tipoMaquina', function() use($mysqli, $app){
	// Para acceder a los datos recibidos del formulario
	$datosform = $app->request;


	$nombre 	= $datosform->post('nombre');
	$nTipoMaquina 	= new TipoMaquina("", $nombre);

	$nTipoMaquina->insertDB($mysqli); //usuario agregado a la BD

	if($nTipoMaquina->get("id")!= NULL){		
		$_SESSION['mensaje']['tipo']='SUCCESS';
		$_SESSION['mensaje']['texto'] = "TipoMaquina ingresado al Sistema";	
	}
	else{
		$_SESSION['mensaje']['tipo']='ERROR';
		$_SESSION['mensaje']['texto'] = "Hubo una falla: ".$mysqli->error.".<br>No se ingresó al Sistema";		
	}

	$app->response->redirect($app->urlFor('listadoTipoMaquinas'), 303);
});

//pagina editar
$app->get('/tipoMaquina/:idContrato/editar', function($idContrato) use ($mysqli, $pUser) {
	$titulo ="Editar Tipo Maquina";

	$origen = TipoMaquina::getTipoMaquinaById($idContrato, $mysqli);

	if(in_array("3", $pUser)){
		View::view("tipoMaquina", "editar", compact("titulo", "origen"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});

//editar usuario
$app->put('/tipoMaquina/:idContrato',function($idContrato) use($mysqli,$app) {

	$datosform 			= $app->request;
	$nombre 			= $datosform->post('nombre');
	


	$nContrato = new TipoMaquina($idContrato, $nombre);

	$nContrato->updateDB($mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se ha actualizado correctamente";

	$app->response->redirect($app->urlFor('listadoTipoMaquinas'), 303);
});

//pagina Borrar
$app->get('/tipoMaquina/:idusuario/borrar', function($usuarioID) use ($mysqli, $pUser) {
	$titulo ="Borrar TipoMaquina";
	$user = TipoMaquina::getTipoMaquinaById($usuarioID, $mysqli);

	if(in_array("4", $pUser)){
		View::view("tipoMaquina", "borrar", compact("titulo", "user"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});
//borrar usuario
$app->delete('/tipoMaquina/:idusuario',function($idusuario) use($mysqli,$app) {

	TipoMaquina::borrarTipoMaquina($idusuario, $mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se realizado correctamente el borrado.";

	$app->response->redirect($app->urlFor('listadoTipoMaquinas'), 303);
});

//otras rutas de contrato
