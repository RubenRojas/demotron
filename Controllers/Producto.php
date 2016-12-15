<?php
if(isset($_SESSION['id'])){
	$objeto = AppObjeto::getObjetoByNombre('PRODUCTO', $mysqli);
	$pUser = Usuario::getPermisosObjeto($_SESSION['id'], $objeto['id'], $mysqli);
	/* 1: CREATE 2: READ 3: UPDATE 4: DELETE */
}
else{
	$pUser = Usuario::getPermisosObjeto(0, $objeto['id'], $mysqli);
}



$app->get('/productos/:nombre/buscar', function($nombre) use ($mysqli, $pUser) {
	$prod = Producto::buscar($nombre, $mysqli);
	echo json_encode($prod);
});

$app->get('/productos/:nombre/buscarParte', function($nombre) use ($mysqli, $pUser) {
	$prod = Producto::buscarParte($nombre, $mysqli);
	echo json_encode($prod);
});
