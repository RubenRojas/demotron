<?php
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('MAQUINA', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 1: CREATE 2: READ 3: UPDATE 4: DELETE */
}
else{
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}

//listado de usuarios
$app->get('/maquina', function() use($mysqli, $pUser){
	$result = Maquina::getMaquinas($mysqli);
	$titulo = "Listado Maquinas";

	if(in_array("2", $pUser)){
		View::view("maquina", "listado", compact("result", "titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}

})->name("listadoMaquinas");

//formulario nuevo usuario
$app->get('/maquina/nuevo', function() use($mysqli, $pUser){
	$titulo = "Nueva Maquina";
	$equipos = TipoMaquina::getTipoMaquinas($mysqli);

	if(in_array("1", $pUser)){
		View::view("maquina", "nuevo", compact("titulo", "equipos"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
});

//agregar nuevo usuario
$app->post('/maquina', function() use($mysqli, $app){
	// Para acceder a los datos recibidos del formulario
	$datosform = $app->request;

	$equipo	= $datosform->post('equipo');
	$marca	= $datosform->post('marca');
	$placa	= $datosform->post('placa');
	$codigo	= $datosform->post('codigo');
	$modelo	= $datosform->post('modelo');
	$anio	= $datosform->post('anio');
	$chasis	= $datosform->post('chasis');
	$serie	= $datosform->post('serie');


	$nMaquina 	= new Maquina("", $equipo, $marca, $placa, $codigo, $modelo, $anio, $chasis, $serie);

	$nMaquina->insertDB($mysqli); //usuario agregado a la BD

	if($nMaquina->get("id")!= NULL){		
		$_SESSION['mensaje']['tipo']='SUCCESS';
		$_SESSION['mensaje']['texto'] = "Maquina ingresada al Sistema";	
	}
	else{
		$_SESSION['mensaje']['tipo']='ERROR';
		$_SESSION['mensaje']['texto'] = "Hubo una falla: ".$mysqli->error.".<br>No se ingresó al Sistema";		
	}

	$app->response->redirect($app->urlFor('listadoMaquinas'), 303);
});

//pagina editar
$app->get('/maquina/:idContrato/editar', function($idContrato) use ($mysqli, $pUser) {
	$titulo ="Editar Maquina";

	$maquina = Maquina::getMaquinaById($idContrato, $mysqli);
	$equipos = TipoMaquina::getTipoMaquinas($mysqli);

	if(in_array("3", $pUser)){
		View::view("maquina", "editar", compact("titulo", "maquina", "equipos"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	} 
});

//editar usuario
$app->put('/maquina/:idContrato',function($idContrato) use($mysqli,$app) {

	$datosform 	= $app->request;
	$equipo		= $datosform->post('equipo');
	$marca		= $datosform->post('marca');
	$placa		= $datosform->post('placa');
	$codigo		= $datosform->post('codigo');
	$modelo		= $datosform->post('modelo');
	$anio		= $datosform->post('anio');
	$chasis		= $datosform->post('chasis');
	$serie		= $datosform->post('serie');
	

	$nContrato 	= new Maquina($idContrato, $equipo, $marca, $placa, $codigo, $modelo, $anio, $chasis, $serie);

	$nContrato->updateDB($mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se ha actualizado correctamente";

	$app->response->redirect($app->urlFor('listadoMaquinas'), 303);
});

//pagina Borrar
$app->get('/maquina/:idusuario/borrar', function($usuarioID) use ($mysqli, $pUser) {
	$titulo ="Borrar Maquina";
	$user = Maquina::getMaquinaById($usuarioID, $mysqli);

	if(in_array("4", $pUser)){
		View::view("maquina", "borrar", compact("titulo", "user"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});
//borrar usuario
$app->delete('/maquina/:idusuario',function($idusuario) use($mysqli,$app) {

	Maquina::borrarMaquina($idusuario, $mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se realizado correctamente el borrado.";

	$app->response->redirect($app->urlFor('listadoMaquinas'), 303);
});

//otras rutas de contrato
//pagina detalle
$app->get('/maquina/:idContrato/detalle', function($idContrato) use ($mysqli, $pUser) {
	$titulo ="Detalle Maquina";

	$maquina = Maquina::getMaquinaById($idContrato, $mysqli);
	$equipos = TipoMaquina::getTipoMaquinas($mysqli);

	if(in_array("3", $pUser)){
		View::view("maquina", "detalle", compact("titulo", "maquina", "equipos"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	} 
});