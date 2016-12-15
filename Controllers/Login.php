<?php


$app->post('/login', function() use($mysqli, $app){
	// Para acceder a los datos recibidos del formulario
	$datosform = $app->request;

	$correo = $mysqli->real_escape_string($datosform->post('correo'));
	$pass 	= $mysqli->real_escape_string($datosform->post('pass'));
	$nUser 	= Usuario::getUserLogin($correo, $pass, $mysqli);
	if(isset($nUser['id'])){
		$_SESSION['id'] = $nUser['id'];
		$_SESSION['nombre'] = $nUser['nombre'];
		$_SESSION['correo'] = $nUser['correo'];
		$_SESSION['mensaje']['tipo']='SUCCESS';
		$_SESSION['mensaje']['texto'] = "Bienvenido, ".$nUser['nombre'];		
	}
	else{
		$_SESSION['mensaje']['tipo']='ERROR';
		$_SESSION['mensaje']['texto'] = "Correo o contraseña incorrectos. Intente Nuevamente";
	}
	$app->response->redirect('/demotron');
});

$app->get('/exit', function() use($app){
	session_destroy();
	$app->response->redirect('/demotron');
});