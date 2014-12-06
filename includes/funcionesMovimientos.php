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



/* fin */

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