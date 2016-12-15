<?php

class Producto{
	private $id;
	private $nombre;
	private $parte;
	
	public function __construct($id_ing, $nombre_ing, $parte_ing){
		$this->id 			= $id_ing;
		$this->nombre 		= $nombre_ing;
		$this->parte 		= $parte_ing;
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
		$id = insert("producto", $this->toArray(), $mysqli);
		$this->id = $id;
	}
	public function updateDB($mysqli){
		update("producto", $this->toArray(), array("id"=>$this->id), array("limit"=>"1"), $mysqli);
	}

	public function get($var){
		return $this->$var;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getProductos($mysqli){
		$lista = select("producto", array("*"), array(), array("order by"=>"nombre asc"), $mysqli);
		return $lista;
	}
	public static function getProductoById($id, $mysqli){
		$user = select("producto", array("*"), array("id"=>$id), array("limit"=>"1"), $mysqli);
		return $user;
	}	
	public static function getProductoByNombre($nombre, $mysqli){
		$user = select("producto", array("*"), array("nombre"=>$nombre), array("limit"=>"1"), $mysqli);
		return $user;
	}	
	public static function borrarProducto($id, $mysqli){
		deleteDB("producto", array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
	public static function buscar($nombre, $mysqli){
		 $query ="select id, nombre, parte from producto where nombre like '$nombre%' order by nombre asc";
		 $result = $mysqli->query($query);
		 $ret = array();
		 while ($arr = $result->fetch_assoc()) {
		 	array_push($ret, $arr);
		 }
		 return $ret;
	}
	public static function buscarParte($nombre, $mysqli){
		 $query ="select id, nombre, parte from producto where parte like '%$nombre%' order by nombre asc";
		 $result = $mysqli->query($query);
		 $ret = array();
		 while ($arr = $result->fetch_assoc()) {
		 	array_push($ret, $arr);
		 }
		 return $ret;
	}
}