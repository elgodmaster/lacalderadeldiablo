<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosTurnos {

/* logica de negocios para los turnos */

function traerClientes() {
	$sql = "select 
				c.idcliente,
				concat('Nro Cliente: ',
						c.nrocliente,
						' - Nombre: ',
						c.nombre,
						' - NroDoc: ',
						IFNULL(c.nrodocumento, ''),
						' - Saldo:',
						cc.saldo) as nombre
			from
				lcdd_clientes c
				inner
			join	lcdd_cuentas cc
			on c.idcliente = cc.refcliente
			order by c.nombre";
	$res = $this->query($sql,0);
	return $res;	
}


function traerCanchas() {
	$sql = "select * from lcdd_canchas order by idcancha";
	$res = $this->query($sql,0);
	return $res;	
}


function traerCanchasId($id) {
	$sql = "select cancha from lcdd_canchas where idcancha =".$id;
	$res = $this->query($sql,0);
	return $res;	
}

function traerTurnos() {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos 
			where activo = 1
			order by fechautilizacion,horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorId($id) {
	$sql = "select t.idturno,t.refcancha,t.fechautilizacion,t.horautilizacion,t.refcliente,t.fechacreacion,t.usuacrea,t.cliente,t.indefinido
			from lcdd_turnos t
			left join lcdd_clientes c on t.refcliente = c.idcliente
			where activo = 1 and idturno = ".$id;
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDia($fecha) {
	$sql = "select t.idturno,t.refcancha,t.fechautilizacion,t.horautilizacion,t.refcliente,t.fechacreacion,t.usuacrea,t.cliente
			from lcdd_turnos t
			left join lcdd_clientes c on t.refcliente = c.idcliente 
			where activo = 1 and WEEKDAY(t.fechautilizacion) = WEEKDAY('".$fecha."') order by t.horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDiaAgrupado($fecha) {
	$sql = "select 
			    max(case
			        when t.refcancha = 1 then t.cliente
			        else ''
			    end) as Cancha1,
			    max(case
			        when t.refcancha = 2 then t.cliente
			        else ''
			    end) as Cancha2,
			    max(case
			        when t.refcancha = 3 then t.cliente
			        else ''
			    end) as Cancha3,
				max(case
			        when t.refcancha = 1 then abs(t.indefinido)
			        else ''
			    end) as indefinido1,
			    max(case
			        when t.refcancha = 2 then abs(t.indefinido)
			        else ''
			    end) as indefinido2,
			    max(case
			        when t.refcancha = 3 then abs(t.indefinido)
			        else ''
			    end) as indefinido3,
				max(case
			        when t.refcancha = 1 then t.idturno
			        else ''
			    end) as turno1,
			    max(case
			        when t.refcancha = 2 then t.idturno
			        else ''
			    end) as turno2,
			    max(case
			        when t.refcancha = 3 then t.idturno
			        else ''
			    end) as turno3,
			    max(t.fechautilizacion) as fechautilizacion,
			    t.horautilizacion
			from
			    lcdd_turnos t
			        left join
			    lcdd_clientes c ON t.refcliente = c.idcliente
			where
			    WEEKDAY(t.fechautilizacion) = WEEKDAY('".$fecha."') and t.activo = 1
			group by t.horautilizacion
			order by t.horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDiaCanchaFecha($fecha,$horario,$refcancha) {
	$sql = "select t.cliente,t.idturno,c.idcliente
			from lcdd_turnos t 
			left join lcdd_clientes c on t.refcliente = c.idcliente
			where t.activo = 1 and WEEKDAY(t.fechautilizacion) = WEEKDAY('".$fecha."') and hour(t.horautilizacion) = '".$horario."' and t.refcancha =".$refcancha." order by idturno desc";
	$res = $this->query($sql,0);

	return $res;
}

function hayTurnos($fecha,$horario,$refcancha) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where activo = 1 and WEEKDAY(fechautilizacion) = WEEKDAY('".$fecha."') and hour(horautilizacion) = '".$horario."' and indefinido = 1 and refcancha =".$refcancha;
	//return $sql;
	
	$res = $this->query($sql,0);

	if (mysql_num_rows($res) > 0) {
    		return 'Ya esta ocupado ese turno';
    	} else {
    		return '';
    }
}

function existeTurno($fecha,$horario,$refcancha,$id) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where activo = 1 and WEEKDAY(fechautilizacion) = WEEKDAY('".$fecha."') and hour(horautilizacion) = '".$horario."' and refcancha =".$refcancha;
	$res = $this->query($sql,0);
	if (mysql_num_rows($res) > 0) {
			if (mysql_result($res,0,0) != $id) {
    			return 'Ya esta ocupado ese turno';
			} else {
				return '';
			}
    	} else {
    		return '';
    }
}

function traerPrimerUltimoTurno($fecha) {
	$sql = "select IFNULL(min(hour(horautilizacion)),12) as primer,IFNULL(max(hour(horautilizacion)),24) as ultimo
			from		lcdd_turnos t
			where		t.activo = 1 and WEEKDAY(t.fechautilizacion) = WEEKDAY('".$fecha."')";	
	$res = $this->query($sql,0);
	return $res;
}

function insertarTurno($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$cliente,$indefinido) {
	$sql		=	"insert into lcdd_turnos(idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea,activo,cliente,indefinido)
					values
						('',
						".$refcancha.",
						'".$fechautilizacion."',
						'".$horautilizacion.":00:00',
						".$refcliente.",
						null,
						'".utf8_decode($usuacrea)."',
						1,
						'".utf8_decode($cliente)."',
						".$indefinido.")";

	if ($this->hayTurnos($fechautilizacion,$horautilizacion,$refcancha) == '') {
		$res		=	$this->query($sql,1);
	} else {
		return 'Ya existe un turno';	
		//return $this->hayTurnos($fechautilizacion,$horautilizacion,$refcancha);
	}
	return $res;
}

function insertarTurnoVerificado($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$cliente,$indefinido) {
	$sql		=	"insert into lcdd_turnos(idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea,activo,cliente,indefinido)
					values
						('',
						".$refcancha.",
						'".$fechautilizacion."',
						'".$horautilizacion.":00:00',
						".$refcliente.",
						null,
						'".utf8_decode($usuacrea)."',
						1,
						'".utf8_decode($cliente)."',
						".$indefinido.")";

	$res		=	$this->query($sql,1);
	return $res;
}

function modificarTurno($id,$refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$indefinido) {
	$sql		=	"update lcdd_turnos set
						refcancha = ".$refcancha.",
						fechautilizacion = '".$fechautilizacion."',
						horautilizacion = '".$horautilizacion.":00:00',
						refcliente = ".$refcliente.",
						usuacrea = '".utf8_decode($usuacrea)."',
						indefinido = ".$indefinido."
						where idturno = ".$id;

	if ($this->existeTurno($fechautilizacion,$horautilizacion,$refcancha,$id) == '') {
		$res		=	$this->query($sql,1);
	} else {
		return 'Ya existe un turno';	
	}
	return '';
}

function eliminarTurno($i) {
	$sql		=	"delete from lcdd_turnos where idturno =".$i;
	$res 		=	$this->query($sql,0);
	echo '';
}

/* fin */

/* logica de negicio para los turnos y los clientes indefinidos */

function insertarTurnoCliente($refcliente,$numdia,$dia,$comienzo,$hora,$refcancha) {
	$sql 		=	"insert into lcdd_clientesturnos(idclienteturno,refcliente,numdia,dia,comienzo,hora,refcancha)
					 values
					 ('',
					 ".$refcliente.",
					 ".$numdia.",
					 '".$dia."',
					 '".$comienzo."',
					 ".$hora.",
					 ".$refcancha.")";
	$res 		=	$this->query($sql,1);
	echo $res;
}


function eliminarTurnoCliente($id) {
	$sql 		=	"delete from lcdd_clientesturnos where idclienteturno =".$id;
	$res 		=	$this->query($sql,0);
	echo "";
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
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}

}

?>