<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosMovimientos {

/* logica de negocios para la configuraciones */

//el utf8_decode($cadena) este va en todos los campos que sean tipo string o cadena o varchar

//$idVenta,$Venta,$precio,$detalle

function insertarMovimiento($reftipoventa,$refventa,$monto,$fechacreacion,$usuacrea,$refid,$observacion) {
	
	$sql	=	"INSERT INTO lcdd_movimientos
					(idmovimiento,
					reftipoventa,
					refventa,
					monto,
					fechacreacion,
					usuacrea,
					refid,
					observacion)
				VALUES
					('',
					".$reftipoventa.",
					".$refventa.",
					".$monto.",
					null,
					'".utf8_decode($usuacrea)."',
					".$refid.",
					'".utf8_decode($observacion)."')";
	//return $sql;
	$res 	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}
}

function eliminarMovimiento($id) {
	$sql = "delete from lcdd_movimientos where idmovimiento =".$id;
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}


function traerMovimienosClientes($idcliente) {
	$sql = "select
r.fechacreacion,
				r.precio,
				r.observacion,
				r.idtipoventa,
				r.tipoventa,
				r.idcliente,
				r.cliente,
				r.fechautilizacion,
				r.horautilizacion,
				r.usuacrea,
				r.idmovimiento
from (
select 
				m.fechacreacion,
				tv.precio,
				m.observacion,
				tv.idtipoventa,
				tv.tipoventa,
				c.idcliente,
				t.cliente,
				t.fechautilizacion,
				t.horautilizacion,
				t.usuacrea,
				m.idmovimiento
			from
				lcdd_tipoventa tv
					inner join
				lcdd_valores v ON tv.refvalores = v.idvalor
					inner join
				lcdd_movimientos m ON m.reftipoventa = tv.idtipoventa
					inner join
				lcdd_turnos t ON t.idturno = m.refid
					inner join
				lcdd_clientes c ON c.idcliente = t.refcliente
			where
				v.descripcion in ('Canchas') and c.idcliente = ".$idcliente."
                
union all

select 
				m.fechacreacion,
				m.monto as precio,
				m.observacion,
				tv.idtipoventa,
				tv.tipoventa,
				c.idcliente,
				c.nombre as cliente,
				'' as fechautilizacion,
				'' as horautilizacion,
				m.usuacrea,
				m.idmovimiento
			from
				lcdd_tipoventa tv
					inner join
				lcdd_valores v ON tv.refvalores = v.idvalor
					inner join
				lcdd_movimientos m ON m.reftipoventa = tv.idtipoventa
					inner join
				lcdd_clientes c ON c.idcliente = m.refid
			where
				v.descripcion in ('Clientes') and c.idcliente = ".$idcliente."
	) as r
    
    order by r.fechacreacion desc,r.fechautilizacion,
				r.horautilizacion";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerMovimienosClientesMovimientos($idcliente,$idmovimiento) {
	$sql = "select
r.fechacreacion,
				r.precio,
				r.observacion,
				r.idtipoventa,
				r.tipoventa,
				r.idcliente,
				r.cliente,
				r.fechautilizacion,
				r.horautilizacion,
				r.usuacrea,
				r.idmovimiento
from (
select 
				m.fechacreacion,
				tv.precio,
				m.observacion,
				tv.idtipoventa,
				tv.tipoventa,
				c.idcliente,
				t.cliente,
				t.fechautilizacion,
				t.horautilizacion,
				t.usuacrea,
				m.idmovimiento
			from
				lcdd_tipoventa tv
					inner join
				lcdd_valores v ON tv.refvalores = v.idvalor
					inner join
				lcdd_movimientos m ON m.reftipoventa = tv.idtipoventa
					inner join
				lcdd_turnos t ON t.idturno = m.refid
					inner join
				lcdd_clientes c ON c.idcliente = t.refcliente
			where
				v.descripcion in ('Canchas') and c.idcliente = ".$idcliente." and m.idmovimiento = ".$idmovimiento."
                
union all

select 
				m.fechacreacion,
				tv.precio,
				m.observacion,
				tv.idtipoventa,
				tv.tipoventa,
				c.idcliente,
				c.nombre as cliente,
				'' as fechautilizacion,
				'' as horautilizacion,
				m.usuacrea,
				m.idmovimiento
			from
				lcdd_tipoventa tv
					inner join
				lcdd_valores v ON tv.refvalores = v.idvalor
					inner join
				lcdd_movimientos m ON m.reftipoventa = tv.idtipoventa
					inner join
				lcdd_clientes c ON c.idcliente = m.refid
			where
				v.descripcion in ('Clientes') and c.idcliente = ".$idcliente." and m.idmovimiento = ".$idmovimiento."
	) as r
    
    order by r.fechautilizacion,
				r.horautilizacion";
	//return $sql;
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


/* fin */

function query($sql,$accion) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
/*		$hostname = "localhost";
		$database = "lacalder_diablo";
		$username = "lacalderadeldiab";
		$password = "caldera4415";*/
		
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