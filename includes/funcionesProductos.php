<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosProductos {


/* logica de negocio para los productos */

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


function modificarProducto($id,$nombre,$precio_unit,$precio_venta) {
	$sql = "update lcdd_productos 			
			SET
			nombre = '".$nombre."',
			precio_unit = ".$precio_unit.",
			precio_venta = ".$precio_venta.",
			stock = ".$stock.",
			stock_min = ".$stock_min.",
			reftipoproducto = ".$reftipoproducto.",
			refproveedor = ".$refproveedor.",
			codigo = ".$codigo.",
			codigobarra = ".$codigobarra.",
			caracteristicas = ".$caracteristicas.",
			WHERE idproducto = ".$id;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;

}

//1, p.nombre
function traerProductoPorId($id,$orden) {
	$sql = "select
				p.*,tp.tipoproducto,pr.proveedor
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					where		p.idproducto = ".$id." order by ".$orden;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function traerProductoPorCodigo($codigo,$orden) {
	$sql = "select
				p.*,tp.tipoproducto,pr.proveedor
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					where		p.codigo = ".$codigo." order by ".$orden;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function traerProductoPorCodigoBarra($codigobarra,$orden) {
	$sql = "select
				p.*,tp.tipoproducto,pr.proveedor
					from		lcdd_productos p

					inner
					join		lcdd_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1

					inner
					join		lcdd_proveedores pr
					on			pr.idproveedor = p.refproveedor

					where		p.codigobarra = ".$codigobarra." order by ".$orden;
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function insertarProducto($nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas ) {
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
						caracteristicas)
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
							'".$caracteristicas."')";
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