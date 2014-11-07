<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosTurnos {

/* logica de negocios para los turnos */

function traerClientes() {
	$sql = "select idcliente,concat('Nro Cliente: ',nrocliente,' - Nombre: ',nombre,' - NroDoc: ',IFNULL(nrodocumento,''))as nombre from lcdd_clientes order by nombre";
	$res = $this->query($sql,0);
	return $res;	
}


function traerCanchas() {
	$sql = "select * from lcdd_canchas order by idcancha";
	$res = $this->query($sql,0);
	return $res;	
}


function traerTurnos() {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos order by fechautilizacion,horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorId($id) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where idturno = ".$id;
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDia($fecha) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where fechautilizacion = '".$fecha."'";
	$res = $this->query($sql,0);
	return $res;
}

function hayTurnos($fecha,$horario) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where fechautilizacion = '".$fecha."' and horautilizacion = '".$horario."' and refcancha =".$refcancha;
	$res = $this->query($sql,0);
	if (mysql_num_rows($res) > 0) {
    		return '';
    	} else {
    		return '0';
    }
}

function existeTurno($fecha,$horario,$refcancha,$id) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where fechautilizacion = '".$fecha."' and horautilizacion = '".$horario."' and refcancha =".$refcancha;
	$res = $this->query($sql,0);
	if (mysql_num_rows($res) > 0) {
			if (mysql_result($res,0,0) != $id) {
    			return '';
			} else {
				return '0';
			}
    	} else {
    		return '0';
    }
}

function insertarTurno($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea) {
	$sql		=	"insert into lcdd_turnos(idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea)
					values
						('',
						".$refcancha.",
						'".$fechautilizacion."',
						'".$horautilizacion."',
						".$refcliente.",
						null,
						'".$$usuacrea."')";
	$res		=	$this->query($sql,1);
	return $res;
}

function modificarTurno($id,$refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea) {
	$sql		=	"update lcdd_turnos set
						refcancha = ".$refcancha.",
						fechautilizacion = '".$fechautilizacion."',
						horautilizacion = '".$horautilizacion."',
						refcliente = ".$refcliente.",
						usuacrea = '".$$usuacrea."'
						where idturno = ".$id;

	$res		=	$this->query($sql,1);
	return $res;
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
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}

}

?>