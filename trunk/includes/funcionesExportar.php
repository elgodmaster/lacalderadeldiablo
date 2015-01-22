<?php

date_default_timezone_set('America/Buenos_Aires');


class ServiciosExportar {

function ExportarLocal() {
	//EXPORT DE LA TABLA 	lcdd_ventas
	//recorro la tabla para crear los insert
	$sql = "SELECT idventa,
				refproducto,
				reftipoventa,
				importe,
				fechacreacion,
				cancelado,
				usuacrea,
				fechamodificacion,
				usuamodi,
				concepto,
				observaciones,
				cantidad
			FROM lcdd_ventas order by idventa";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_ventas(idventa,
													refproducto,
													reftipoventa,
													importe,
													fechacreacion,
													cancelado,
													usuacrea,
													fechamodificacion,
													usuamodi,
													concepto,
													observaciones,
													cantidad)
												Values
													(".$row[0].",
													 ".$row[1].",
													 ".$row[2].",
													 ".$row[3].",
													 '".$row[4]."',
													 ".$row[5].",
													 '".$row[6]."',
													 '".$row[7]."',
													 '".$row[8]."',
													 '".$row[9]."',
													 '".$row[10]."',
													 ".$row[11].");";	
	}
	
	//creo el eliminar
	$eliminarTabla = "DROP TABLE lcdd_ventas;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = "
		CREATE TABLE `lcdd_ventas` (
		  `idventa` int(11) NOT NULL AUTO_INCREMENT,
		  `refproducto` int(11) DEFAULT NULL,
		  `reftipoventa` int(11) NOT NULL,
		  `importe` decimal(18,2) NOT NULL,
		  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `cancelado` bit(1) DEFAULT NULL,
		  `usuacrea` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `fechamodificacion` datetime DEFAULT NULL,
		  `usuamodi` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `concepto` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `observaciones` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `cantidad` smallint(6) DEFAULT NULL,
		  PRIMARY KEY (`idventa`)
		) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_ventas

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************



//EXPORT DE LA TABLA 	lcdd_productos
	//recorro la tabla para crear los insert
	$sql = "SELECT idproducto,
					nombre,
					precio_unit,
					precio_venta,
					stock,
					stock_min,
					reftipoproducto,
					refproveedor,
					codigo,
					codigobarra,
					caracteristicas,
					egreso
				FROM lcdd_productos order by idproducto";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_productos(idproducto,
														nombre,
														precio_unit,
														precio_venta,
														stock,
														stock_min,
														reftipoproducto,
														refproveedor,
														codigo,
														codigobarra,
														caracteristicas,
														egreso)
												Values
													(".$row[0].",
													 '".$row[1]."',
													 ".$row[2].",
													 ".$row[3].",
													 ".$row[4].",
													 ".$row[5].",
													 ".$row[6].",
													 ".$row[7].",
													 '".$row[8]."',
													 '".$row[9]."',
													 '".$row[10]."',
													 ".$row[11].");";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE lcdd_productos;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `lcdd_productos` (
		  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
		  `precio_unit` decimal(18,2) NOT NULL,
		  `precio_venta` decimal(18,2) DEFAULT NULL,
		  `stock` int(11) NOT NULL,
		  `stock_min` smallint(6) NOT NULL,
		  `reftipoproducto` int(11) NOT NULL,
		  `refproveedor` int(11) NOT NULL,
		  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
		  `codigobarra` bigint(15) DEFAULT NULL,
		  `caracteristicas` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `egreso` bit(1) DEFAULT NULL,
		  PRIMARY KEY (`idproducto`)
		) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_productos

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************



//EXPORT DE LA TABLA 	lcdd_clientes
	//recorro la tabla para crear los insert
	$sql = "SELECT idcliente,
					nombre,
					nrocliente,
					email,
					nrodocumento,
					telefono
				FROM lcdd_clientes order by idcliente";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_clientes(idcliente,
														nombre,
														nrocliente,
														email,
														nrodocumento,
														telefono)
												Values
													(".$row[0].",
													 '".$row[1]."',
													 '".$row[2]."',
													 '".$row[3]."',
													 ".$row[4].",
													 '".$row[5]."');";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE lcdd_clientes;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `lcdd_clientes` (
		  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
		  `nrocliente` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
		  `email` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `nrodocumento` int(11) DEFAULT NULL,
		  `telefono` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
		  PRIMARY KEY (`idcliente`)
		) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_clientes

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************



//EXPORT DE LA TABLA 	lcdd_cuentas
	//recorro la tabla para crear los insert
	$sql = "SELECT idcuenta,
				refcliente,
				saldo
			FROM lcdd_cuentas order by idcuenta";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_cuentas(idcuenta,
													refcliente,
													saldo)
												Values
													(".$row[0].",
													 ".$row[1].",
													 ".$row[2].");";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE lcdd_cuentas;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `lcdd_cuentas` (
		  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
		  `refcliente` int(11) NOT NULL,
		  `saldo` decimal(10,0) NOT NULL,
		  PRIMARY KEY (`idcuenta`)
		) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_cuentas

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************




//EXPORT DE LA TABLA 	lcdd_fiestas
	//recorro la tabla para crear los insert
	$sql = "SELECT idfiesta,
					nombre,
					horadesde,
					horahasta,
					dia,
					concatering,
					saldo
				FROM lcdd_fiestas order by idfiesta";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_fiestas(idfiesta,
													nombre,
													horadesde,
													horahasta,
													dia,
													concatering,
													saldo)
												Values
													(".$row[0].",
													 '".$row[1]."',
													 '".$row[2]."',
													 '".$row[3]."',
													 '".$row[4]."',
													 ".$row[5].",
													 ".$row[6].");";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE lcdd_fiestas;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `lcdd_fiestas` (
		  `idfiesta` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
		  `horadesde` time NOT NULL,
		  `horahasta` time NOT NULL,
		  `dia` date NOT NULL,
		  `concatering` bit(1) DEFAULT NULL,
		  `saldo` decimal(10,0) DEFAULT NULL,
		  PRIMARY KEY (`idfiesta`)
		) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_fiestas

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************




//EXPORT DE LA TABLA 	lcdd_movimientos
	//recorro la tabla para crear los insert
	$sql = "SELECT idmovimiento,
					reftipoventa,
					refventa,
					monto,
					fechacreacion,
					usuacrea,
					refid,
					observacion
				FROM lcdd_movimientos order by idmovimiento";
	$res = $this->query($sql,0);
	
	$insert = '';
	while ($row = mysql_fetch_array($res)) {
		$insert = $insert." insert into lcdd_movimientos(idmovimiento,
														reftipoventa,
														refventa,
														monto,
														fechacreacion,
														usuacrea,
														refid,
														observacion)
												Values
													(".$row[0].",
													 ".$row[1].",
													 ".$row[2].",
													 ".$row[3].",
													 '".$row[4]."',
													 '".$row[5]."',
													 ".$row[6].",
													 '".$row[7]."');";	
	}
	
	//creo el eliminar
	$eliminarTabla = $eliminarTabla."DROP TABLE lcdd_movimientos;";
	
	//$this->query($eliminarTabla,0);
	
	//creo la tabla
	$crearTabla = $crearTabla."
		CREATE TABLE `lcdd_movimientos` (
		  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
		  `reftipoventa` int(11) NOT NULL,
		  `refventa` int(11) NOT NULL,
		  `monto` decimal(10,0) NOT NULL,
		  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `usuacrea` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
		  `refid` int(11) NOT NULL,
		  `observacion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
		  PRIMARY KEY (`idmovimiento`)
		) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
	";	
	
	//$this->query($crearTabla,0);
	
	
//FIN DEL EXPORT DE LA TABLA lcdd_movimientos

////*************************************************************************************************************
////*************************************************************************************************************
////*************************************************************************************************************

}

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