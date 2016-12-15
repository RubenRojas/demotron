<?php

class Origen{
	private $id;
	private $nombre;
	
	public function __construct($id_ing, $nombre_ing){
		$this->id 			= $id_ing;
		$this->nombre 		= $nombre_ing;
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
		$id = insert("origen", $this->toArray(), $mysqli);
		$this->id = $id;
	}
	public function updateDB($mysqli){
		update("origen", $this->toArray(), array("id"=>$this->id), array("limit"=>"1"), $mysqli);
	}

	public function get($var){
		return $this->$var;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getOrigenes($mysqli){
		$lista = select("origen", array("*"), array(), array("order by"=>"nombre asc"), $mysqli);
		return $lista;
	}
	public static function getOrigenById($id, $mysqli){
		$user = select("origen", array("*"), array("id"=>$id), array("limit"=>"1"), $mysqli);
		return $user;
	}	
	public static function borrarOrigen($id, $mysqli){
		deleteDB("origen", array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
}