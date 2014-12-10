<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReportes {

function ingresosCanchas($anio,$mes,$dia) {
	$sql = "select 
				sum(v.importe) as importe,
				tv.detalle,
				count(tv.detalle) as tipo,
				(case when v.cancelado = 0 then count(v.cancelado) else 0 end) as completos,
				(case when v.cancelado = 1 then count(v.cancelado) else 0 end) as cancelados,
				v.reftipoventa
			from
				lcdd_ventas v
					inner join
				lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
					inner join
				lcdd_valores vv ON vv.idvalor = tv.refvalores
			where
				vv.descripcion = 'Canchas'
					and year(v.fechacreacion) = ".$anio."
					and month(v.fechacreacion) = ".$mes."
					and day(v.fechacreacion) = ".$dia."
			group by tv.detalle , v.reftipoventa, v.cancelado
		
		order by v.reftipoventa";	
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function ingresosVentas($anio,$mes,$dia) {
	$sql = "select 
				sum(v.importe) as importe,
				tp.tipoproducto,
				sum(v.cantidad) as Cantidad
			from
				lcdd_ventas v
					inner join
				lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
					inner join
				lcdd_valores vv ON vv.idvalor = tv.refvalores
					inner join
				lcdd_productos p on p.idproducto = v.refproducto
					inner join
				lcdd_tipoproducto tp on tp.idtipoproducto = p.reftipoproducto
			where
				vv.descripcion = 'Productos'
					and year(v.fechacreacion) = ".$anio."
					and month(v.fechacreacion) = ".$mes."
					and day(v.fechacreacion) = ".$dia."
					and tp.activo = 1
			group by tp.tipoproducto
		
		order by tp.tipoproducto";	
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function ingresosFiestas($anio,$mes,$dia) {
	$sql = "select 
				sum(v.importe) as importe,
				tv.detalle,
				count(tv.detalle) as tipo,
				(case when v.cancelado = 0 then count(v.cancelado) else 0 end) as completos,
				(case when v.cancelado = 1 then count(v.cancelado) else 0 end) as cancelados,
				v.reftipoventa
			from
				lcdd_ventas v
					inner join
				lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
					inner join
				lcdd_valores vv ON vv.idvalor = tv.refvalores
			where
				vv.descripcion = 'Fiestas'
					and year(v.fechacreacion) = ".$anio."
					and month(v.fechacreacion) = ".$mes."
					and day(v.fechacreacion) = ".$dia."
			group by tv.detalle , v.reftipoventa, v.cancelado
		
		order by v.reftipoventa";	
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function query($sql,$accion) {
		
		
		
		$hostname = "localhost";
		$database = "lacalderadeldiablo";
		$username = "root";
		$password = "";
		
/*		$hostname = "db494455387.db.1and1.com";
		$database = "db494455387";
		$username = "dbo494455387";
		$password = "Admin1234";*/
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		/*
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		*/
                $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>