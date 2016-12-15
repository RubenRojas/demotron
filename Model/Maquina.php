<?php

class Maquina{
	private $id;
	private $equipo;
	private $marca;
	private $placa;
	private $codigo;
	private $modelo;
	private $anio;
	private $chasis;
	private $serie;




	public function __construct($id_ing, $equipo_ing, $marca_ing, $placa_ing, $codigo_ing, $modelo_ing, $anio_ing, $chasis_ing, $serie_ing){

		$this->id	 	= $id_ing;
		$this->equipo	= $equipo_ing;
		$this->marca	= $marca_ing;
		$this->placa	= $placa_ing;
		$this->codigo	= $codigo_ing;
		$this->modelo	= $modelo_ing;
		$this->anio	 	= $anio_ing;
		$this->chasis	= $chasis_ing;
		$this->serie	= $serie_ing;
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
		$id = insert("maquina", $this->toArray(), $mysqli);
		$this->id = $id;
	}
	public function updateDB($mysqli){
		update("maquina", $this->toArray(), array("id"=>$this->id), array("limit"=>"1"), $mysqli);
	}

	public function get($var){
		return $this->$var;
	}

	/****************************
	STATIC METHODS
	****************************/
	public static function getMaquinas($mysqli){
		$lista = select("maquina", array("*"), array(), array("order by"=>"nombre asc"), $mysqli);

		$query = "select maquina.id, maquina.equipo, maquina.marca,	maquina.placa,	maquina.codigo,	maquina.modelo,	maquina.anio,	maquina.chasis,	maquina.serie, tipo_maquina.nombre from maquina inner join tipo_maquina on tipo_maquina.id = maquina.equipo order by maquina.codigo";
		$lista = $mysqli->query($query);
		return $lista;
	}
	public static function getMaquinaById($id, $mysqli){
		$user = select("maquina", array("*"), array("id"=>$id), array("limit"=>"1"), $mysqli);
		$query = "select maquina.id, maquina.equipo, maquina.marca,	maquina.placa,	maquina.codigo,	maquina.modelo,	maquina.anio,	maquina.chasis,	maquina.serie, tipo_maquina.nombre from maquina inner join tipo_maquina on tipo_maquina.id = maquina.equipo where maquina.id='$id' limit 1";
		$lista = $mysqli->query($query);
		$user = $lista->fetch_assoc();
		return $user;
	}	
	public static function borrarMaquina($id, $mysqli){
		deleteDB("maquina", array("id"=>$id), array("limit"=>"1"), $mysqli);
	}
}