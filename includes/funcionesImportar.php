<?php

date_default_timezone_set('America/Buenos_Aires');


class ServiciosImportar {

function Importar($archivo) {
	
	$sqlImportar = '';
	$queries = explode(';', file_get_contents('c:/'.$archivo));
	
	foreach($queries as $query)
	{
		if($query != '')
		{
			$this->query($query,0); // Asumo un objeto conexión que ejecuta consultas
			//$sqlImportar = $sqlImportar.$query;
		}
	}
	
	/*$file = fopen('c:/'.$archivo, "r");

	while(!feof($file)) {
		$sqlImportar = $sqlImportar.fgets($file). PHP_EOL;
	}		

	fclose($file);
	*/
	//$res = $this->query($sqlImportar,0);
	
	return 'Archivo importado correctamente';
	


}

/*************************** fin del importar *********************************/


Function query($sql,$accion) {
		
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
		$password = "caldera4415";
		*/
		
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