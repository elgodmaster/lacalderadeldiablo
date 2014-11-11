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


function traerTurnos() {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos 
			where activo = 1
			order by fechautilizacion,horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorId($id) {
	$sql = "select t.idturno,t.refcancha,t.fechautilizacion,t.horautilizacion,t.refcliente,t.fechacreacion,t.usuacrea,c.nombre
			from lcdd_turnos t
			inner join lcdd_clientes c on t.refcliente = c.idcliente
			where activo = 1 and idturno = ".$id;
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDia($fecha) {
	$sql = "select t.idturno,t.refcancha,t.fechautilizacion,t.horautilizacion,t.refcliente,t.fechacreacion,t.usuacrea,c.nombre
			from lcdd_turnos t
			inner join lcdd_clientes c on t.refcliente = c.idcliente 
			where activo = 1 and t.fechautilizacion = '".$fecha."' order by t.horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDiaAgrupado($fecha) {
	$sql = "select 
			    max(case
			        when t.refcancha = 1 then c.nombre
			        else ''
			    end) as Cancha1,
			    max(case
			        when t.refcancha = 2 then c.nombre
			        else ''
			    end) as Cancha2,
			    max(case
			        when t.refcancha = 3 then c.nombre
			        else ''
			    end) as Cancha3,
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
			    t.fechautilizacion,
			    t.horautilizacion
			from
			    lcdd_turnos t
			        inner join
			    lcdd_clientes c ON t.refcliente = c.idcliente
			where
			    t.fechautilizacion = '".$fecha."' and t.activo = 1
			group by t.fechautilizacion , t.horautilizacion
			order by t.horautilizacion";
	$res = $this->query($sql,0);
	return $res;
}

function traerTurnosPorDiaCanchaFecha($fecha,$horario,$refcancha) {
	$sql = "select c.nombre,t.idturno,c.idcliente
			from lcdd_turnos t 
			inner join lcdd_clientes c on t.refcliente = c.idcliente
			where t.activo = 1 and t.fechautilizacion = '".$fecha."' and hour(t.horautilizacion) = '".$horario."' and t.refcancha =".$refcancha;
	$res = $this->query($sql,0);

	return $res;
}

function hayTurnos($fecha,$horario,$refcancha) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where activo = 1 and fechautilizacion = '".$fecha."' and hour(horautilizacion) = '".$horario."' and refcancha =".$refcancha;
	$res = $this->query($sql,0);

	if (mysql_num_rows($res) > 0) {
    		return 'Ya esta ocupado ese turno';
    	} else {
    		return '';
    }
}

function existeTurno($fecha,$horario,$refcancha,$id) {
	$sql = "select idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea
			from lcdd_turnos where activo = 1 and fechautilizacion = '".$fecha."' and hour(horautilizacion) = '".$horario."' and refcancha =".$refcancha;
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
			where		t.activo = 1 and t.fechautilizacion = '".$fecha."'";	
	$res = $this->query($sql,0);
	return $res;
}

function insertarTurno($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea) {
	$sql		=	"insert into lcdd_turnos(idturno,refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea,activo)
					values
						('',
						".$refcancha.",
						'".$fechautilizacion."',
						'".$horautilizacion.":00:00',
						".$refcliente.",
						null,
						'".utf8_decode($usuacrea)."',
						1)";
	if ($this->hayTurnos($fechautilizacion,$horautilizacion,$refcancha) == '') {
		$res		=	$this->query($sql,1);
	} else {
		return 'Ya existe un turno';	
	}
	return '';
}

function modificarTurno($id,$refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea) {
	$sql		=	"update lcdd_turnos set
						refcancha = ".$refcancha.",
						fechautilizacion = '".$fechautilizacion."',
						horautilizacion = '".$horautilizacion.":00:00',
						refcliente = ".$refcliente.",
						usuacrea = '".utf8_decode($usuacrea)."'
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
	echo $res;
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