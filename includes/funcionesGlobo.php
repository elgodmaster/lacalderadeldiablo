<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

class ServiciosGlobo {


function insertarContacto($nombre,$correo,$ciudad,$telefonomovil,$telefonofijo,$mensaje) {
	$sql	=	"insert into dbcontactos(idcontacto,nombre,correo,ciudad,telefonomovil,telefonofijo,mensaje)
					values
						('',
						 '".utf8_decode($nombre)."',
						 '".utf8_decode($correo)."',
						 '".utf8_decode($ciudad)."',
						 '".$telefonomovil."',
						 '".$telefonofijo."',
						 '".utf8_decode($mensaje)."')";
	//return $sql;
	$res	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}
}

function query($sql,$accion) {
		
		
		
		$hostname = "gl0b0.db.11976330.hostedresource.com";
		$database = "gl0b0";
		$username = "rasp2316";
		$password = "VLPStSTo%C8";
		
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