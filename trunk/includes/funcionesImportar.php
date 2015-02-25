<?php

date_default_timezone_set('America/Buenos_Aires');


class ServiciosImportar {


function subirArchivo($file) {
	$dir_destino = '../archivos/';
	$imagen_subida = $dir_destino . utf8_decode(str_replace(' ','',basename($_FILES[$file]['name'])));
	
	//$noentrar = '../imagenes/index.php';
	//$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$idInmueble.'/'.'index.php';
	
	if (!file_exists($dir_destino)) {
    	mkdir($dir_destino, 0777);
	}
	
	 
	if(!is_writable($dir_destino)){
		
		echo "no tiene permisos";
		
	}	else	{
		if ($_FILES[$file]['tmp_name'] != '') {
			if(is_uploaded_file($_FILES[$file]['tmp_name'])){
				/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
				echo "Mostrar contenido\n";
				echo $imagen_subida;*/
				if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
					
					$archivo = utf8_decode($_FILES[$file]["name"]);
					$tipoarchivo = $_FILES[$file]["type"];
					
					/*if ($this->existeArchivo($idInmueble,$archivo,$tipoarchivo) == 0) {
						$sql	=	"insert into pifotos(idfoto,refinmueble,imagen,type) values ('',".$idInmueble.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
						$this->query($sql,1);
					}
					echo "";
					
					copy($noentrar, $nuevo_noentrar);
	*/
				} else {
					echo "Posible ataque de carga de archivos!\n";
				}
			}else{
				echo "Posible ataque del archivo subido: ";
				echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
			}
		}
	}
	return utf8_decode(str_replace(' ','',basename($_FILES[$file]['name'])));
}


function ImportarLocal($archivo) {
	
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


function ImportarWeb($archivo) {
	
	$sqlImportar = '';
	$queries = explode(';', file_get_contents('../archivos/'.$archivo));
	
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