<?php

class Informes{

	/**************************
	INFORMES DE ORDENES DE COMPRA
	**************************/
	public static function OC_getEstadoResumen($fecha_i, $fecha_f, $mysqli){
		$query = "select count(orden_compra.folio) as cant, sum(orden_compra.neto) as neto, sum(orden_compra.iva) as iva, sum(orden_compra.total) as total, orden_compra_estado.nombre, orden_compra_estado.id from orden_compra inner join orden_compra_estado on orden_compra.estado = orden_compra_estado.id ";
		if($fecha_i != 'fi' and $fecha_f !='ff'){
			$query.="where orden_compra.fecha between '$fecha_i' and '$fecha_f' ";
		}
		$query.='group by orden_compra_estado.nombre order by orden_compra_estado.nombre asc';
		$result = $mysqli->query($query);
		return $result;
	}

	public static function OC_getResumenFirma($fecha_i, $fecha_f, $mysqli){

		$query = "select centro_costo.nombre, 
		sum(CASE WHEN orden_compra.estado='5' THEN orden_compra.total ELSE 0 END) AS totalPendiente,
		sum(CASE WHEN orden_compra.estado='5' THEN 1 ELSE 0 END) AS cantPendiente,
		sum(case when orden_compra.estado not in('1','5','6') then orden_compra.total else 0 end) as totalAcum,
		sum(case when orden_compra.estado not in('1','5','6') then 1 else 0 end) as cantAcum 
		from orden_compra inner join centro_costo on centro_costo.id = orden_compra.centro_costo ";

		if($fecha_i != 'fi' and $fecha_f !='ff'){
			$query.="where orden_compra.fecha between '$fecha_i' and '$fecha_f' ";
		}
		$query.='group by centro_costo.nombre order by centro_costo.nombre asc';
		$result = $mysqli->query($query);
		return $result;
	}

	public static function OC_getOrdenesCompraCentroCosto($anio, $mysqli){
		$resultado = array();
		
		$query = "select id, nombre from centro_costo";
		$result = $mysqli->query($query);
		$cc = array();
		while ($arr = $result->fetch_assoc()) {
			$cc['nombre'] = $arr['nombre'];
			for ($i=1; $i <=12 ; $i++) { 
				$query = "select sum(orden_compra.total) as total from orden_compra where month(fecha)='$i' and centro_costo = $arr[id]";
				$result2 = $mysqli->query($query);
				$arr2 = $result2->fetch_assoc();
				$cc[$i] = $arr2['total'];
			}
			array_push($resultado, $cc);
			$cc = array();
		}
		return json_encode($resultado);
	}
	


	public static function OC_getInformeRobertoVentura($centro_costos, $meses,$anio, $mysqli){

		//normalizar cuotas
		$query = "select orden_compra.centro_costo, orden_compra.fecha, orden_compra.forma_pago, orden_compra.folio, (orden_compra.total / forma_pago.div) as valor, forma_pago.div, forma_pago.dias from orden_compra inner join forma_pago on forma_pago.id = orden_compra.forma_pago where orden_compra.cuota_registrada='NO' ";

		$result = $mysqli->query($query);

		while ($arr = $result->fetch_assoc()) {
			for($i=0;$i<$arr['div'];$i++){
				if($arr['forma_pago']==7 or $arr['forma_pago']==8 or $arr['forma_pago']==9 ){
					$str = "+".(($i) * $arr['dias'])." days";
				}
				else{
					$str = "+".(($i+1) * $arr['dias'])." days";	
				}
				
				$effectiveDate = date('Y-m-d', strtotime($str, strtotime($arr['fecha'])));
				$query = "insert into cuota(centro_costo, folio, valor, fecha)values('$arr[centro_costo]', '$arr[folio]', '$arr[valor]', '$effectiveDate')";
				$result2 = $mysqli->query($query);
				$query = "update orden_compra set cuota_registrada='SI' where folio='$arr[folio]' limit 1";
				$result3 = $mysqli->query($query);
				
			}
		}

		$meses = substr($meses,0,-1);
		$meses = explode("-", $meses);
		$data = array();
		
		foreach ($meses as $mes) {
			$query = "select sum(cuota.valor) as valor, cuota.centro_costo from cuota where month(cuota.fecha)=$mes and year(cuota.fecha)=$anio group by cuota.centro_costo";
			$result = $mysqli->query($query);
			while ($arr = $result->fetch_assoc()) {
				$data[$mes][$arr['centro_costo']] = $arr['valor'];
			}
			
		}
		return $data;
		
		
	}


}