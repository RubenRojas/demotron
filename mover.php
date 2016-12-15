<?php

$directorio = 'c:/pruebaOc';
$ficheros2  = scandir($directorio, 1);


$inicial = $_GET['inicial'];
$final = $_GET['final'];

// Definir Inicial y final
if($inicial < $final){
	$ini = $inicial;
	$fin = $final;
}
else{
	$fin = $inicial;
	$ini = $final;
}

//Listar Ordenes a Mover
$a_mover = array();
for ($i=$ini; $i <= $fin ; $i++) { 
	array_push($a_mover, $i);
}


//Crear Carpeta Nueva
$destino = $directorio."/OC ".$ini."-".$fin;
if (!file_exists($destino)){
	mkdir($destino, 0700);
}

//Mover Archivos
foreach ($ficheros2 as $oc) {
	preg_match_all('!\d+!', $oc, $matches);
	if(in_array($matches[0][0], $a_mover) and is_file($directorio."/".$oc)){
		copy($directorio."/".$oc, $destino."/".$oc);
		unlink($directorio."/".$oc);
	}
}
