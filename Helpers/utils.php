<?php
class Utils{


  public static function cambiarFormatoFecha($fecha){ 
      list($anio,$mes,$dia)=explode("-",$fecha); 
      return $dia."-".$mes."-".$anio; 
  }
  public static function isBisiesto($anio){
      return (($anio % 4 == 0) && (($anio % 100 != 0) || ($anio % 400 == 0))) ? true : false;
  }
  public static function codificar_fecha($mes, $anio){
    $MESES = array("01"=>"Enero", "02"=>"Febrero", "03"=>"Marzo", "04"=>"Abril", "05"=>"Mayo", "06"=>"Junio", "07"=>"Julio", "08"=>"Agosto", "09"=>"Septiembre", "10"=>"Octubre", "11"=>"Noviembre", "12"=>"Diciembre");
    if($mes==''){
      $mes = $MESES[date("m")];
      $anio = date("Y");
    }
    if($mes=='Enero'){
      $inicio=$anio.'-01-01';
      $fin=$anio.'-01-31';
    }
    if($mes=='Febrero'){
      if(isBisiesto($anio)){
        $inicio=$anio.'-02-01';
        $fin=$anio.'-02-29';
      }
      else{
        $inicio=$anio.'-02-01';
        $fin=$anio.'-02-28';
      }
    }
    if($mes=='Marzo'){
      $inicio=$anio.'-03-01';
      $fin=$anio.'-03-31';
    }
    if($mes=='Abril'){
      $inicio=$anio.'-04-01';
      $fin=$anio.'-04-30';
    }
    if($mes=='Mayo'){
      $inicio=$anio.'-05-01';
      $fin=$anio.'-05-31';
    }
    if($mes=='Junio'){
      $inicio=$anio.'-06-01';
      $fin=$anio.'-06-30';
    }
    if($mes=='Julio'){
      $inicio=$anio.'-07-01';
      $fin=$anio.'-07-31';
    }
    if($mes=='Agosto'){
      $inicio=$anio.'-08-01';
      $fin=$anio.'-08-31';
    }
    if($mes=='Septiembre'){
      $inicio=$anio.'-09-01';
      $fin=$anio.'-09-30';
    }
    if($mes=='Octubre'){
      $inicio=$anio.'-10-01';
      $fin=$anio.'-10-31';
    }
    if($mes=='Noviembre'){
      $inicio=$anio.'-11-01';
      $fin=$anio.'-11-30';
    }
    if($mes=='Diciembre'){
      $inicio=$anio.'-12-01';
      $fin=$anio.'-12-31';
    }

      
    $periodo=array('inicio'=>$inicio,'fin'=>$fin);

    return $periodo; //entrega el principio y el fin del mes correspondiente, en formato SQL 
  }
  public static function eliminarDir($carpeta){
    foreach(glob($carpeta . "/*") as $archivos_carpeta){
      if (is_dir($archivos_carpeta))
        eliminarDir($archivos_carpeta);
      else//si es un archivo lo eliminamos
        unlink($archivos_carpeta);
    } 
    rmdir($carpeta);
  }
}
