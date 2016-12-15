<?php
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('USUARIOS', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 
	1: CREATE
	2: READ 
	3: UPDATE 
	4: DELETE */
}
else{
	$objeto = AppObjeto::getObjetoByNombre('USUARIOS', $mysqli);
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}

//listado de usuarios
$app->get('/usuarios', function() use($mysqli, $pUser){
	$result = Usuario::getUsuarios($mysqli);
	$titulo = "Listado Usuarios";
	if(in_array("2", $pUser)){
		View::view("usuario", "listado", compact("result", "titulo"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
})->name("listadoUsuarios");


//formulario nuevo usuario
$app->get('/usuarios/nuevo', function() use($mysqli, $pUser){

	$objetos 	= AppObjeto::getObjeto("objeto", $mysqli);
	$permisos	= AppObjeto::getObjeto("permiso", $mysqli);

	$arr_obj 	= array();
	$arr_perm	= array();

	while($row = $objetos->fetch_assoc()) {
            array_push($arr_obj, $row);
    }
    while($row = $permisos->fetch_assoc()) {
            array_push($arr_perm, $row);
    }

	$titulo = "Nuevo Usuario";
	if(in_array("1", $pUser)){
		View::view("usuario", "nuevo", compact("titulo", "arr_perm", "arr_obj"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
});


//agregar nuevo usuario
$app->post('/usuarios', function() use($mysqli, $app){
	// Para acceder a los datos recibidos del formulario
	$datosform = $app->request;

	$nombre = $datosform->post('nombre');
	$correo = $datosform->post('correo');
	$pass 	= $datosform->post('pass');
	$nUser 	= new Usuario("", $nombre, $correo, $pass, "");
	$nUser->insertDB($mysqli); //usuario agregado a la BD

	if($nUser->get("id")!= NULL){
		$permisos = $datosform->post("permiso");
		if(count($permisos)>0){
			foreach ($permisos as $permiso) {
				$data = explode("_", $permiso);
				$nUser->insertPermiso($data[0], $data[1], $mysqli);
			}
		}
		
		$_SESSION['mensaje']['tipo']='SUCCESS';
		$_SESSION['mensaje']['texto'] = "Usuario Ingresado al Sistema";	
	}
	else{
		$_SESSION['mensaje']['tipo']='ERROR';
		$_SESSION['mensaje']['texto'] = "Hubo una falla. El usuario no se ingresó al Sistema";		
	}
	

	$app->response->redirect($app->urlFor('listadoUsuarios'), 303);

});

//detalle usuario
$app->get('/usuarios/:idusuario', function($usuarioID) use($mysqli, $pUser) {
	$user = Usuario::getUserById($usuarioID, $mysqli);
	$perm = Usuario::getPermisos($user['id'], $mysqli);
	
	$permisos	= AppObjeto::getObjeto("permiso", $mysqli);
	$arr_perm	= array();
	while($row = $permisos->fetch_assoc()) {
            array_push($arr_perm, $row);
    }

    $titulo = $user['nombre'];
    if(in_array("2", $pUser)){
		View::view("usuario", "detalle", compact("titulo", "user", "perm", "arr_perm"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
});

//pagina editar
$app->get('/usuarios/:idusuario/editar', function($usuarioID) use($mysqli, $pUser) {
	$titulo ="Editar Usuario";
	$user = Usuario::getUserById($usuarioID, $mysqli);

	$objetos 	= AppObjeto::getObjeto("objeto", $mysqli);
	$permisos	= AppObjeto::getObjeto("permiso", $mysqli);
	$permisos_usuario = Usuario::getPermisos($user['id'], $mysqli);

	$arr_obj 	= array();
	$arr_perm	= array();

	while($row = $objetos->fetch_assoc()) {
            array_push($arr_obj, $row);
    }
    while($row = $permisos->fetch_assoc()) {
            array_push($arr_perm, $row);
    }
    if(in_array("3", $pUser)){
		View::view("usuario", "editar", compact("titulo", "arr_perm", "arr_obj", "user", "permisos_usuario", "usuarioID"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	
	 
});

//actualizar usuario
$app->put('/usuarios/:idusuario',function($usuarioID) use($mysqli,$app) {

	$datosform = $app->request;
	$nombre = $datosform->post('nombre');
	$correo = $datosform->post('correo');
	$pass 	= $datosform->post('pass');
	$nUser 	= new Usuario($usuarioID, $nombre, $correo, $pass, "");
	
	//echo'<hr>'.var_dump($nUser->toArray()).'<hr>';
	$nUser->updateDB($mysqli);
	$nUser->borraPermisos($mysqli);

	$permisos = $datosform->post("permiso");
	if(count($permisos)>0){
		foreach ($permisos as $permiso) {
			$data = explode("_", $permiso);
			$nUser->insertPermiso($data[0], $data[1], $mysqli);
		}
	}
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Usuario ".$nUser->get("nombre")." ha sido actualizado correctamente";

	$app->response->redirect($app->urlFor('listadoUsuarios'), 303);
});


//pagina Borrar
$app->get('/usuarios/:idusuario/borrar', function($usuarioID) use($mysqli, $pUser) {
	$titulo ="Borrar Usuario";
	$user = Usuario::getUserById($usuarioID, $mysqli);

	if(in_array("4", $pUser)){
		View::view("usuario", "borrar", compact("titulo", "user"));
	}
	else{
		View::view("application", "no_permiso", compact("titulo"));
	}
	 
});
//borrar usuario
$app->delete('/usuarios/:idusuario',function() use($mysqli,$app) {
	$datosform = $app->request;
	$id = $datosform->post('id');
	Usuario::borrarUsuario($id, $mysqli);
	$nUser 	= new Usuario($id, "", "", "", "");
	$nUser->borraPermisos($mysqli);
	
	$_SESSION['mensaje']['tipo'] = "SUCCESS";
	$_SESSION['mensaje']['texto'] = "Se realizado correctamente el borrado.";

	$app->response->redirect($app->urlFor('listadoUsuarios'), 303);
});