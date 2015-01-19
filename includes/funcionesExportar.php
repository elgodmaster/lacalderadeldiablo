<?php

date_default_timezone_set('America/Buenos_Aires');


class ServiciosExportar {

function ExportarWeb() {
	
//EXPORT DE LA TABLA 	lcdd_administrativo
	//recorro la tabla para crear los insert
	$sql = "SELECT idadministrativo,
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
		FROM lcdd_administrativo order by idadministrativo";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_administrativo(idadministrativo,
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
												Values
													(".$row[0].",
													 ".$row[1].",
													 ".$row[2].",
													 ".$row[3].",
													 ".$row[4].",
													 ".$row[5].",
													 ".$row[6].",
													 ".$row[7].",
													 ".$row[8].",
													 ".$row[9].",
													 ".$row[10].",
													 ".$row[11].",
													 ".$row[12].",
													 ".$row[13].",
													 ".$row[14].",
													 ".$row[15].",
													 ".$row[16].",
													 ".$row[17].",
													 ".$row[18].");";	
	}
	
	//creo el eliminar
	$eliminarTabla = "DROP TABLE lcdd_administrativo;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = "
		CREATE TABLE `lcdd_administrativo` (
	  `idadministrativo` int(11) NOT NULL AUTO_INCREMENT,
	  `importecanchas` decimal(18,2) DEFAULT NULL,
	  `importebar` decimal(18,2) DEFAULT NULL,
	  `importesueldos` decimal(18,2) DEFAULT NULL,
	  `importegastosvarios` decimal(18,2) DEFAULT NULL,
	  `importemercaderia` decimal(18,2) DEFAULT NULL,
	  `importegas` decimal(18,2) DEFAULT NULL,
	  `importeluz` decimal(18,2) DEFAULT NULL,
	  `importetelefono` decimal(18,2) DEFAULT NULL,
	  `importeagua` decimal(18,2) DEFAULT NULL,
	  `importeinmobiliario` decimal(18,2) DEFAULT NULL,
	  `importeimpuestos` decimal(18,2) DEFAULT NULL,
	  `importeautonomos` decimal(18,2) DEFAULT NULL,
	  `importeingresosbrutos` decimal(18,2) DEFAULT NULL,
	  `importeaportes` decimal(18,2) DEFAULT NULL,
	  `importesmunicipal` decimal(18,2) DEFAULT NULL,
	  `importefiestas` decimal(18,2) DEFAULT NULL,
	  `anio` smallint(6) DEFAULT NULL,
	  `mes` smallint(6) DEFAULT NULL,
	  PRIMARY KEY (`idadministrativo`)
	) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_administrativo

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************

//EXPORT DE LA TABLA 	se_usuarios
	//recorro la tabla para crear los insert
	$sql = "SELECT idusuario,
					usuario,
					password,
					refroll,
					email,
					nombrecompleto
				FROM se_usuarios";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($rowU = mysql_fetch_array($res)) {
		$insert = $insert." insert into se_usuarios(idusuario,
													usuario,
													password,
													refroll,
													email,
													nombrecompleto)
												Values
													(".$rowU[0].",
													 '".$rowU[1]."',
													 '".$rowU[2]."',
													 '".$rowU[3]."',
													 '".$rowU[4]."',
													 '".$rowU[5]."');";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE se_usuarios;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `se_usuarios` (
	  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
	  `usuario` varchar(10) NOT NULL,
	  `password` varchar(10) NOT NULL,
	  `refroll` varchar(20) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `nombrecompleto` varchar(70) NOT NULL,
	  PRIMARY KEY (`idusuario`)
	) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
	";	
	
	//$this->query($crearTabla,0);
	

//FIN DEL EXPORT DE LA TABLA se_usuarios
	
	
////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************

//EXPORT DE LA TABLA 	lcdd_tipoventa
	//recorro la tabla para crear los insert
	$sql = "SELECT idtipoventa,
				tipoventa,
				precio,
				detalle,
				refvalores
			FROM lcdd_tipoventa;";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($rowU = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_tipoventa(idtipoventa,
														tipoventa,
														precio,
														detalle,
														refvalores)
												Values
													(".$rowU[0].",
													 '".$rowU[1]."',
													 ".$rowU[2].",
													 '".$rowU[3]."',
													 ".$rowU[4].");";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE lcdd_tipoventa;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `lcdd_tipoventa` (
		  `idtipoventa` int(11) NOT NULL AUTO_INCREMENT,
		  `tipoventa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
		  `precio` decimal(10,0) NOT NULL,
		  `detalle` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `refvalores` smallint(6) DEFAULT NULL,
		  PRIMARY KEY (`idtipoventa`)
		) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	

//FIN DEL EXPORT DE LA TABLA se_usuarios
	
	
	$armarExportador = $eliminarTabla.$crearTabla.$insert;
	
	$this->query($armarExportador,0);
	
	echo $armarExportador;
}

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