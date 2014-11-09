<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosClientes {

/* logica de negocios para los clientes */

function generarNroCliente($nombre) {
	$primerasLetras = substr(trim($nombre),0,2);
	$sql = "select idcliente from lcdd_clientes order by idcliente desc";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		$num = mysql_result($res,0,0);	
	} else {
		$num = 1;
	}
	$nroCliente = $primerasLetras.str_pad($num,4,'0',STR_PAD_LEFT);
	return $nroCliente;
}


//el utf8_decode($cadena) este va en todos los campos que sean tipo string o cadena o varchar

function insertarCliente($nombre,$nrocliente,$email,$nrodocumento) {
	$sql	=	"insert into lcdd_clientes(idcliente,nombre,nrocliente,email,nrodocumento)
					values
						('',
						 nombre			=	'".$nombre."',
						 nrocliente		=	'".utf8_decode($this->generarNroCliente($nombre))."',
						 email			=	'".$email."',
						 nrodocumento	=	'".$nrodocumento."')";
	$res	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}
}

	

	function eliminarCliente($id) {
		$sqlD = "delete from lcdd_clientes idcliente =".$id;
		$this->query($sqlD,0);
	
		$sql = "delete from lcdd_clientes where idcliente =".$id;
		$this->query($sql,0);
		return true;
}


function modificarCliente($id,$nombre,$nrocliente,$email,$nrodocumento) {
	$sql = "update lcdd_clientes 			
			SET
			nombre = '".$nombre."',
			nrocliente = ".$nrocliente.",
			email = ".$email.",
			nrodocumento = ".$nrodocumento.",
			WHERE idcliente = ".$id;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;

}


function traerClientePorId($id) {
	$sql	=	"select idcliente from lcdd_clientes where idcliente =".$id;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function traerClientePorNroCliente($nrocliente) {
	$sql	=	"select nrocliente from lcdd_cliente where nrocliente =".$nrocliente;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function traerClientePorNroDocumento($nrodocumento) {
	$sql	=	"select nrodocumento from lcdd_cliente where nrodocumento =".$nrodocumento;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
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