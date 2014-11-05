<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosProductos {

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


Function query($sql,$accion) {
		
		
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