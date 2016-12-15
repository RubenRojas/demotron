<?php

/**
* Clase Usuario: Es la clase que gestiona el usuario de la aplicación.
*/
class Usuario{
	private $id;
	private $nombre;
	private $correo;
	private $pass;
	private $origen;

	public function __construct($id_ing, $nombre_ing, $correo_ing, $pass_ing, $origen_ing){
		$this->nombre 	= $nombre_ing;
		$this->correo 	= $correo_ing;
		$this->pass 	= $pass_ing;
		$this->id 		= $id_ing;
		$this->origen 	= $origen_ing;
	}
	public function toArray(){
		$arr = array();
		foreach ($this as $nombre => $valor) {
		      $arr[$nombre] = $valor;
		}
		return $arr;
	}	
	public function toString(){
		$str = "";
		foreach ($this as $nombre => $valor) {
		      $str.="$nombre: $valor<br>";
		}
		return $str;
	}
	
	public function insertDB($mysqli){
		$id = insert("usuario", $this->toArray(), $mysqli);
		$this->id = $id;
	}
	public function updateDB($mysqli){
		update("usuario", $this->toArray(), array("id"=>$this->id), array("limit"=>"1"), $mysqli);
	}

	public function insertPermiso($objeto, $permiso, $mysqli){
		insert("usuario_permiso", array("objeto"=>$objeto, "permiso"=>$permiso, "usuario"=>$this->id), $mysqli);
	}

	public function borraPermisos($mysqli){
		deleteDB("usuario_permiso", array("usuario"=>$this->id), array(), $mysqli);
	}

	public function get($var){
		return $this->$var;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getUsuarios($mysqli){
		$lista = select("usuario", array("*"), array(), array("order by"=>"nombre asc"), $mysqli);
		return $lista;
	}
	public static function getPermisos($id, $mysqli){
		$perm = array();
		$obj = array();
		$objetos 	= AppObjeto::getObjeto("objeto", $mysqli);
		
		while ($arr = $objetos->fetch_assoc()) {
			$obj['nombre']	= $arr['nombre'];
			$obj['id'] 		= $arr['id'];
			$obj['permisos']= array();
			
			$query = "select app_permiso.nombre, app_permiso.id from app_permiso inner join usuario_permiso on usuario_permiso.permiso = app_permiso.id where usuario_permiso.usuario='$id' and usuario_permiso.objeto = '$arr[id]'";
			$result = $mysqli->query($query);
			while ($arr2 = $result->fetch_assoc()) {
				array_push($obj['permisos'], $arr2['id']);
			}
			array_push($perm, $obj);
		}
		return $perm;
	}
	public static function getUserById($id, $mysqli){
		$user = select("usuario", array("*"), array("id"=>$id), array("limit"=>"1"), $mysqli);
		return $user;
	}
	public static function getUserLogin($correo, $pass, $mysqli){
		$user = select("usuario", array("*"), array("correo"=>$correo, "pass"=>$pass), array("limit"=>"1"), $mysqli);
		return $user;
	}
	public static function borrarUsuario($id, $mysqli){
		deleteDB("usuario", array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
	public static function getPermisosObjeto($id, $objeto, $mysqli){
		$permisos = select("usuario_permiso", array("permiso"), array("usuario"=>$id, "objeto"=>$objeto), array("order by"=>"permiso asc"), $mysqli);
		$ret = array();
		while ($arr = $permisos->fetch_assoc()) {
			array_push($ret, $arr['permiso']);
		}
		return $ret;
	}
}