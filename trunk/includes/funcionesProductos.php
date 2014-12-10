<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosProductos {


/* logica de negocio para los tipos productos */

function traerTipoProducto() {
	$sql	=	"select idtipoproducto ,tipoproducto, activo from lcdd_tipoproducto order by tipoproducto";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function traerTipoProductoPorId($id) {
	$sql	=	"select idtipoproducto ,tipoproducto, activo from lcdd_tipoproducto where idtipoproducto =".$id;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function insertarTipoProducto($tipoproducto,$activo) {
	$sql	=	"insert into lcdd_tipoproducto(idtipoproducto,tipoproducto,activo) values
				('',
				'".utf8_decode(trim($tipoproducto))."',
				".$activo.")";
	$res	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function modificarTipoProducto($id,$tipoproducto,$activo) {
	$sql	=	"update lcdd_tipoproducto set
				tipoproducto	= '".utf8_decode(trim($tipoproducto))."',
				activo	= ".$activo."
				where idtipoproducto =".$id;
				
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return $res;
	}
}


function eliminarTipoProducto($id) {
	$sql	=	"delete from lcdd_tipoproducto where idtipoproducto =".$id;
				
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return $res;
	}
}

/* fin */

/* logica de negocio para los productos */

function existeCodigo($codigo) {
	$sql = "select * from lcdd_productos where codigo = '".$codigo."'";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res) > 0) {
    		return '';
    	} else {
    		return '0';
    	}
}

function existeCodigoMod($id,$codigo) {
	
	
	$sql = "select * from lcdd_productos where codigo = '".$codigo."'";
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

function TraerCodigo($codigo) {
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
		    caracteristicas
			FROM lcdd_productos where codigo = '".$codigo."'";

			$res = $this->query($sql,0);
			return	$res;
}


function modificarProducto($id,$nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas,$egreso) {
	$sql = "update lcdd_productos 			
			SET
			nombre = '".utf8_decode($nombre)."',
			precio_unit = ".$precio_unit.",
			precio_venta = ".$precio_venta.",
			stock = ".$stock.",
			stock_min = ".$stock_min.",
			reftipoproducto = ".$reftipoproducto.",
			refproveedor = ".$refproveedor.",
			codigo = '".utf8_decode($codigo)."',
			codigobarra = '".$codigobarra."',
			caracteristicas = '".utf8_decode($caracteristicas)."',
			egreso = ".$egreso."
			WHERE idproducto = ".$id;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;

}

//1, p.nombre
function traerProductoPorId($id) {
	$sql = "select
				p.idproducto,
					p.nombre,
					p.precio_unit,
					p.precio_venta,
					p.stock,
					p.stock_min,
					p.reftipoproducto,
					p.refproveedor,
					p.codigo,
					p.codigobarra,
					p.caracteristicas,
					tp.tipoproducto,
					pr.proveedor,
					p.egreso
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					where		p.idproducto = ".$id;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}


function traerProductosLimite($limite) {
	$sql = "select
				p.idproducto,
					p.nombre,
					p.precio_unit,
					p.precio_venta,
					p.stock,
					p.stock_min,
					p.reftipoproducto,
					p.refproveedor,
					p.codigo,
					p.codigobarra,
					p.caracteristicas,
					tp.tipoproducto,
					pr.proveedor,
					p.egreso
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					order by p.idproducto desc limit ".$limite;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}


function traerProductos() {
	$sql = "select
				p.idproducto,
					p.nombre,
					p.precio_unit,
					p.precio_venta,
					p.stock,
					p.stock_min,
					p.reftipoproducto,
					p.refproveedor,
					p.codigo,
					p.codigobarra,
					p.caracteristicas,
					tp.tipoproducto,
					pr.proveedor,
					p.egreso
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					order by p.nombre";
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}


function traerProductoPorCodigo($codigo) {
	$sql = "select
				p.idproducto,
					p.nombre,
					p.precio_unit,
					p.precio_venta,
					p.stock,
					p.stock_min,
					p.reftipoproducto,
					p.refproveedor,
					p.codigo,
					p.codigobarra,
					p.caracteristicas,
					tp.tipoproducto,
					pr.proveedor,
					p.egreso
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					where		p.codigo = '".$codigo."'";
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function traerProductoPorCodigoBarra($codigobarra) {
	$sql = "select
				p.idproducto,
					p.nombre,
					p.precio_unit,
					p.precio_venta,
					p.stock,
					p.stock_min,
					p.reftipoproducto,
					p.refproveedor,
					p.codigo,
					p.codigobarra,
					p.caracteristicas,
					tp.tipoproducto,
					pr.proveedor,
					p.egreso
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

				where		p.codigobarra = '".$codigobarra."'";
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function insertarProducto($nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas, $egreso ) {
	$sql = "INSERT INTO lcdd_productos
						(idproducto,
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
					VALUES
						('',
							'".$nombre."',
							'".$precio_unit."',
							'".$precio_venta."',
							'".$stock."',
							'".$stock_min."',
							'".$reftipoproducto."',
							'".$refproveedor."',
							'".$codigo."',
							'".$codigobarra."',
							'".$caracteristicas."',
							".$egreso.")";
	//return $sql;
	$res = $this->query($sql,1);
	return $res;					
}

function eliminarProducto($id) {
		$sqlD = "delete from lcdd_productos idproducto =".$id;
		$this->query($sqlD,0);
	
		$sql = "delete from lcdd_productos where idproducto =".$id;
		$this->query($sql,0);
		return true;
}

/* fin */


/* logica de negocio para los proveedores */

function traerProveedores() {
	$sql	=	"select idproveedor ,proveedor,direccion, telefono, cuit, nombre, email from lcdd_proveedores order by proveedor";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function traerProveedoresPorId($id) {
	$sql	=	"select idproveedor ,proveedor,direccion, telefono, cuit, nombre, email from lcdd_proveedores where idproveedor =".$id;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function insertarProveedores($proveedor,$direccion,$telefono,$cuit,$nombre,$email) {
	$sql	=	"insert into lcdd_proveedores(idproveedor,proveedor,direccion,telefono,cuit,nombre,email) values
				('',
				'".utf8_decode(trim($proveedor))."',
				'".utf8_decode(trim($direccion))."',
				'".$telefono."',
				'".$cuit."',
				'".utf8_decode(trim($nombre))."',
				'".utf8_decode(trim($email))."')";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function modificarProveedores($id,$proveedor,$direccion,$telefono,$cuit,$nombre,$email) {
	$sql	=	"update lcdd_proveedores set
				proveedor	= '".utf8_decode(trim($proveedor))."',
				direccion	= '".utf8_decode(trim($direccion))."',
				telefono	= '".$telefono."',
				cuit		= '".$cuit."',
				nombre		= '".utf8_decode(trim($nombre))."',
				email		= '".utf8_decode(trim($email))."'
				where idproveedor =".$id;
				
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return $res;
	}
}


function eliminarProveedores($id) {
	$sql	=	"delete from lcdd_proveedores where idproveedor =".$id;
				
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return $res;
	}
}
/* fin */

Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "lacalderadeldiablo";
		$username = "root";
		$password = "";
		
/*		$hostname = "";
		$database = "";
		$username = "";
		$password = "";*/
		
        

		
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