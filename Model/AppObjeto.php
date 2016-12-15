<?php

/**
* Clase Usuario: Es la clase que gestiona el usuario de la aplicación.
*/
class AppObjeto{
	private $objeto;
	private $nombre;
	private $id;

	public function __construct($objeto, $nombre){
		$this->nombre = $nombre;
		$this->objeto = $objeto;
	}
	public function toString(){
		$str = "";
		foreach ($this as $nombre => $valor) {
		      $str.="$nombre: $valor<br>";
		}
		return $str;
	}
	public function toArray(){
		$arr = array();
		foreach ($this as $nombre => $valor) {
		      $arr[$nombre] = $valor;
		}
		return $arr;
	}	
	public function insertDB($mysqli){
		$id = insert($this->objeto, $this->toArray(), $mysqli);
		$this->id = $id;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getObjeto($objeto, $mysqli){
		$lista = select("app_".$objeto, array("id, nombre"), array(), array("order by"=>"nombre asc"), $mysqli);
		return $lista;
	}

	public static function getObjetoByNombre($objeto, $mysqli){
		$lista = select("app_objeto", array("id, nombre"), array("nombre"=>$objeto), array("limit"=>"1"), $mysqli);
		return $lista;
	}
	
}