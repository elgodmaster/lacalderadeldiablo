<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosAdministrativo {

/* logica de negocios para la configuraciones */

//el utf8_decode($cadena) este va en todos los campos que sean tipo string o cadena o varchar

function yaExiste($anio,$mes) {
	$sql = "select idadministrativo from lcdd_administrativo where anio = ".$anio." and mes = ".$mes;
	$res	=	$this->query($sql,0);
	if (mysql_num_rows($res) > 0) {
		return true;
	} else {
		return false;
	}
}

function insertarAdministrativo($importecanchas,$importebar,$importesueldos,$importegastosvarios,$importemercaderia,$importegas,$importeluz,$importetelefono,$importeagua,$importeinmobiliario,$importeimpuestos,$importeautonomos,$importeingresosbrutos,$importeaportes,$importesmunicipal,$importefiestas,$anio,$mes) {
	$sql = 	"INSERT INTO lcdd_administrativo
				(idadministrativo,
				importecanchas,
				importebar,
				importesueldos,
				importegastosvarios,
				importemercaderia,
				importegas,
				importeluz,
				importetelefono,
				importeagua,
				importeinmobiliario,
				importeimpuestos,
				importeautonomos,
				importeingresosbrutos,
				importeaportes,
				importesmunicipal,
				importefiestas,
				anio,
				mes)
			VALUES
				('',
				".$importecanchas.",
				".$importebar.",
				".$importesueldos.",
				".$importegastosvarios.",
				".$importemercaderia.",
				".$importegas.",
				".$importeluz.",
				".$importetelefono.",
				".$importeagua.",
				".$importeinmobiliario.",
				".$importeimpuestos.",
				".$importeautonomos.",
				".$importeingresosbrutos.",
				".$importeaportes.",
				".$importesmunicipal.",
				".$importefiestas.",
				".$anio.",
				".$mes.")";
	
	if ($this->yaExiste($anio,$mes) == false) {
		$res	=	$this->query($sql,1);
		if ($res == false) {
			return 'Error al insertar datos';
		} else {
			return '';
		}
	} else {
		return 'Ya esta cargado ese año y mes';
	}
}

function traerAdministrato() {
	$sql = "select
				idadministrativo,
				importecanchas,
				importebar,
				importesueldos,
				importegastosvarios,
				importemercaderia,
				importegas,
				importeluz,
				importetelefono,
				importeagua,
				importeinmobiliario,
				importeimpuestos,
				importeautonomos,
				importeingresosbrutos,
				importeaportes,
				importesmunicipal,
				importefiestas,
				anio,
				mes
			from lcdd_administrativo
			order by anio desc,mes desc";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerAdministratoId($id) {
	$sql = "select
				idadministrativo,
				importecanchas,
				importebar,
				importesueldos,
				importegastosvarios,
				importemercaderia,
				importegas,
				importeluz,
				importetelefono,
				importeagua,
				importeinmobiliario,
				importeimpuestos,
				importeautonomos,
				importeingresosbrutos,
				importeaportes,
				importesmunicipal,
				importefiestas,
				anio,
				mes
			from lcdd_administrativo
			where idadministrativo = ".$id."
			order by anio desc,mes desc";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerAdministratoMesDia($anio,$mes) {
	$sql = "select
				idadministrativo,
				importecanchas,
				importebar,
				importesueldos,
				importegastosvarios,
				importemercaderia,
				importegas,
				importeluz,
				importetelefono,
				importeagua,
				importeinmobiliario,
				importeimpuestos,
				importeautonomos,
				importeingresosbrutos,
				importeaportes,
				importesmunicipal,
				importefiestas,
				anio,
				mes
			from lcdd_administrativo
			where anio = ".$anio." and mes = ".$mes." 
			order by anio desc,mes desc";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function modificarAdministrativo($id,$importecanchas,$importebar,$importesueldos,$importegastosvarios,$importemercaderia,$importegas,$importeluz,$importetelefono,$importeagua,$importeinmobiliario,$importeimpuestos,$importeautonomos,$importeingresosbrutos,$importeaportes,$importesmunicipal,$importefiestas,$anio,$mes) {
	$sql = "UPDATE lcdd_administrativo
			SET
			importecanchas = ".$importecanchas.",
			importebar = ".$importebar.",
			importesueldos = ".$importesueldos.",
			importegastosvarios = ".$importegastosvarios.",
			importemercaderia = ".$importemercaderia.",
			importegas = ".importegas.",
			importeluz = ".$importeluz.",
			importetelefono = ".$importetelefono.",
			importeagua = ".$importeagua.",
			importeinmobiliario = ".$importeinmobiliario.",
			importeimpuestos = ".$importeimpuestos.",
			importeautonomos = ".$importeautonomos.",
			importeingresosbrutos = ".$importeingresosbrutos.",
			importeaportes = ".$importeaportes.",
			importesmunicipal = ".$importesmunicipal.",
			importefiestas = ".$importefiestas.",
			anio = ".$anio.",
			mes = ".$mes."
			WHERE idadministrativo = ".$id;	
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}
}

function traerMontosAdministrativos($anio,$mes) {
	$sqlCanchas = "SELECT 
				    sum(v.importe) as importe
				FROM
				    lcdd_ventas v
				        INNER JOIN
				    lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
				        LEFT JOIN
				    lcdd_productos p ON v.refproducto = p.idproducto
				inner join
					lcdd_valores vv on tv.refvalores = vv.idvalor
				where vv.descripcion in ('Canchas') 
					  and year(v.fechacreacion) = ".$anio."
					  and month(v.fechacreacion) = ".$mes."
					  and v.cancelado = 0";
	$resCanchas = $this->query($sqlCanchas,0);
	
	$importeCanchas = 0;
	if (mysql_num_rows($resCanchas)>0) {
		$importeCanchas = mysql_result($resCanchas,0,0);	
	} else {
		$importeCanchas = 0;
	}
	
	
	$sqlFiestas = "SELECT 
				sum(v.importe) as importe
			FROM
				lcdd_ventas v
					INNER JOIN
				lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
					LEFT JOIN
				lcdd_productos p ON v.refproducto = p.idproducto
			inner join
				lcdd_valores vv on tv.refvalores = vv.idvalor
			where vv.descripcion in ('Fiestas') 
				  and year(v.fechacreacion) = ".$anio."
				  and month(v.fechacreacion) = ".$mes."
				  and v.cancelado = 0";
	$resFiestas = $this->query($sqlFiestas,0);
	
	$importeFiestas = 0;
	if (mysql_num_rows($resFiestas)>0) {
		$importeFiestas = mysql_result($resFiestas,0,0);	
	} else {
		$importeFiestas = 0;
	}
	
	
	$sqlBar = "SELECT 
				    sum(v.importe) as importe
				FROM
				    lcdd_ventas v
				        INNER JOIN
				    lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
				        LEFT JOIN
				    lcdd_productos p ON v.refproducto = p.idproducto
				inner join
					lcdd_valores vv on tv.refvalores = vv.idvalor
				where vv.descripcion in ('Productos') 
					  and year(v.fechacreacion) = ".$anio."
					  and month(v.fechacreacion) = ".$mes."
					  and v.cancelado = 0
					  and p.egreso = 0";
	$resBar = $this->query($sqlBar,0);
	
	$importeBar = 0;
	if (mysql_num_rows($resBar)>0) {
		$importeBar = mysql_result($resBar,0,0);	
	} else {
		$importeBar = 0;
	}
	
	$sqlGastosVarios = "SELECT 
				    sum(v.importe) as importe
				FROM
				    lcdd_ventas v
				        INNER JOIN
				    lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
				        LEFT JOIN
				    lcdd_productos p ON v.refproducto = p.idproducto
				inner join
					lcdd_valores vv on tv.refvalores = vv.idvalor
				where vv.descripcion in ('Productos') 
					  and year(v.fechacreacion) = ".$anio."
					  and month(v.fechacreacion) = ".$mes."
					  and v.cancelado = 0
					  and p.egreso = 1";
	$resGastosVarios = $this->query($sqlGastosVarios,0);
	
	$importeGastosVarios = 0;
	if (mysql_num_rows($resGastosVarios)>0) {
		$importeGastosVarios = mysql_result($resGastosVarios,0,0);	
	} else {
		$importeGastosVarios = 0;
	}
	
	$valores = array(floatval($importeCanchas),floatval($importeBar),floatval($importeFiestas),floatval($importeGastosVarios));
	return $valores;
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