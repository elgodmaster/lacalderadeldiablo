<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReportes {

function ingresosCanchas($where) {
	$sql = "select
			sum(r.importe) as importe,
			r.detalle,
			sum(r.tipo) as tipo,
			sum(r.completos) as completos,
			sum(r.cancelados) as cancelados,
			r.reftipoventa
			from
			(
			select 
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
								".$where."
						group by tv.detalle , v.reftipoventa, v.cancelado
			) as r
			group by r.detalle,r.reftipoventa
					order by r.reftipoventa";	
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function ingresosVentas($where) {
	$sql = "select 
				sum(v.importe) as importe,
				tp.tipoproducto,
				sum(v.cantidad) as Cantidad,
				p.egreso
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
					".$where."
					and tp.activo = 1
			group by tp.tipoproducto,p.egreso
		
		order by tp.tipoproducto";	
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function ingresosFiestas($where) {
	$sql = "select
				sum(r.importe) as importe,
				r.detalle,
				sum(r.tipo) as tipo,
				sum(r.completos) as completos,
				sum(r.cancelados) as cancelados,
				r.reftipoventa
				from
				(
				select 
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
				".$where."
			group by tv.detalle , v.reftipoventa, v.cancelado
		
		) as r
group by r.detalle,r.reftipoventa
		order by r.reftipoventa";	
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}
//and day(v.fechacreacion) = ".$dia."
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