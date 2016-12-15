<?php

class Proveedor{
	
	private $id;
	private $razon_social;
	private $rut;
	private $representante;
	private $fono;
	private $email;
	private $direccion;


	public function __construct($id_ing ,$razon_social_ing ,$rut_ing ,$representante_ing ,$fono_ing ,$email_ing ,$direccion_ing){
		$this->id 			= $id_ing;
		$this->razon_social = $razon_social_ing;
		$this->rut 			= $rut_ing;
		$this->representante= $representante_ing;
		$this->fono 		= $fono_ing;
		$this->email 		= $email_ing;
		$this->direccion 	= $direccion_ing;
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
		$id = insert("proveedor", $this->toArray(), $mysqli);
		$this->id = $id;
	}
	public function updateDB($mysqli){
		update("proveedor", $this->toArray(), array("id"=>$this->id), array("limit"=>"1"), $mysqli);
	}

	public function get($var){
		return $this->$var;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getProveedores($mysqli){
		$lista = select("proveedor", array("*"), array(), array("order by"=>"razon_social asc"), $mysqli);
		return $lista;
	}
	public static function getProveedorById($id, $mysqli){
		$user = select("proveedor", array("*"), array("id"=>$id), array("limit"=>"1"), $mysqli);
		return $user;
	}	
	public static function borrarProveedor($id, $mysqli){
		deleteDB("proveedor", array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
	public static function updateDBArray($id, $arr, $mysqli){
		update("proveedor", $arr, array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
}