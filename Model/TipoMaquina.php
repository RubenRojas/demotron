<?php

class TipoMaquina{
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
		$id = insert("tipo_maquina", $this->toArray(), $mysqli);
		$this->id = $id;
	}
	public function updateDB($mysqli){
		update("tipo_maquina", $this->toArray(), array("id"=>$this->id), array("limit"=>"1"), $mysqli);
	}

	public function get($var){
		return $this->$var;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getTipoMaquinas($mysqli){
		$lista = select("tipo_maquina", array("*"), array(), array("order by"=>"nombre asc"), $mysqli);
		return $lista;
	}
	public static function getTipoMaquinaById($id, $mysqli){
		$user = select("tipo_maquina", array("*"), array("id"=>$id), array("limit"=>"1"), $mysqli);
		return $user;
	}	
	public static function borrarTipoMaquina($id, $mysqli){
		deleteDB("tipo_maquina", array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
}