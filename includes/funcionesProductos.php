<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosProductos {

function TraerCategorias() {
		$sql = "select * from se_categorias order by categoria";
		$res = $this->query($sql,0);
		return	$res;
}

function TraerCategoriasPorId($id) {
		$sql = "select categoria from se_categorias where idcategoria =".$id;
		$res = mysql_result($this->query($sql,0),0,0);
		return	$res;
}

function insertarCategoria($categoria) {
		$sql = "insert into se_categorias(idcategoria,categoria) values ('','".utf8_decode($categoria)."')";
		$res = $this->query($sql,1) or die ('');
		return $res;
}

function modificarCategoria($categoria,$id) {
		$sql = "update se_categorias set categoria = '".utf8_decode($categoria)."' where idcategoria =".$id;
		$res = $this->query($sql,0) or die ('Hubo un error');
		return $res;	
}

function eliminarCategoria($id) {
		$sqlP = "delete from se_productos where refcategoria =".$id;
		$this->query($sqlP,0);
		$sqlC = "delete from se_categorias where idcategoria =".$id;
		$this->query($sqlC,0);
		return true;
}

function TraerCantidadCategoriasProductos($idCategoria) {
		$sql = "select count(*) 
					from 
						se_categorias c
					inner
					join
						se_productos p
					on	c.idcategoria = p.refcategoria
					where c.idcategoria = ".$idCategoria;
		$res = $this->query($sql,0);
		return $res;
}

function insertarProducto($email,$password,$fechacreacion,$refcategoria) {
		$sql = "INSERT INTO se_productos
							(idproducto,
							 email,
							 password,
							 fechacreacion,
							 refcategoria)
						VALUES
							('',
							'".utf8_decode($email)."',
							'".utf8_decode($password)."',
							'".$fechacreacion."',
							".$refcategoria.");";
		$res = $this->query($sql,1);
		return $res;
}

function insertarDatos($dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$refproducto) {
		
		$sql = "insert into 
						se_datos(iddato,datos,refproducto,numeracion) 
					values
						('','".$dato1."', ".$refproducto.", 1),
						('','".$dato2."', ".$refproducto.", 2),
						('','".$dato3."', ".$refproducto.", 3),
						('','".$dato4."', ".$refproducto.", 4),
						('','".$dato5."', ".$refproducto.", 5),
						('','".$dato6."', ".$refproducto.", 6)";
		$this->query($sql,1);
		return $sql;
}


function modificarProducto($email,$password,$fechacreacion,$refcategoria,$id) {
		$sql = "update se_productos 
					set 
							 email = '".utf8_decode($email)."',
							 password = '".utf8_decode($password)."',
							 fechacreacion = '".$fechacreacion."',
							 refcategoria = ".$refcategoria." 
					where idproducto =".$id;
		$res = $this->query($sql,0) or die ('Hubo un error');
		return $res;
}


function modificarDatos($dato,$refproducto,$numeracion) {
		
		$sql = "update
						se_datos
					set
						datos = '".$dato."'
					where refproducto = ".$refproducto." and numeracion = ".$numeracion;

		return $this->query($sql,0) or die ('Hubo un error');
}


function eliminarProducto($id) {
		$sqlD = "delete from se_datos refproducto =".$id;
		$this->query($sqlD,0);
	
		$sql = "delete from se_productos where idproducto =".$id;
		$this->query($sql,0);
		return true;
}


function TraerProductosTop() {
		$sql =		"select
					p.idproducto,
					p.fechacreacion,
					p.email,
					p.password,
					max(case d.numeracion when 1 then d.datos end) as num1,
					max(case d.numeracion when 2 then d.datos end) as num2,
					max(case d.numeracion when 3 then d.datos end) as num3,
					max(case d.numeracion when 4 then d.datos end) as num4,
					max(case d.numeracion when 5 then d.datos end) as num5,
					max(case d.numeracion when 6 then d.datos end) as num6
					from		se_productos p
					
					inner
					join		se_datos d
					on			p.idproducto = d.refproducto
					
					group by	p.idproducto,
								p.fechacreacion,
								p.email,
								p.password
					
					
					order by    p.idproducto desc,d.numeracion";
		$res = $this->query($sql,0);
		return $res;
	
}

function TraerProductosPorCategoria($idCategoria) {
		$sql =		"select
					p.idproducto,
					p.fechacreacion,
					p.email,
					p.password,
					max(case d.numeracion when 1 then d.datos end) as num1,
					max(case d.numeracion when 2 then d.datos end) as num2,
					max(case d.numeracion when 3 then d.datos end) as num3,
					max(case d.numeracion when 4 then d.datos end) as num4,
					max(case d.numeracion when 5 then d.datos end) as num5,
					max(case d.numeracion when 6 then d.datos end) as num6
					from		se_productos p
					
					left
					join		se_datos d
					on			p.idproducto = d.refproducto
					
					inner
					join		se_categorias c
					on			p.refcategoria = c.idcategoria
					
					where		c.idcategoria = ".$idCategoria."
					
					group by	p.idproducto,
								p.fechacreacion,
								p.email,
								p.password
					
					
					order by    p.idproducto desc,d.numeracion Limit 30";
		$res = $this->query($sql,0);
		return $res;
	
}


function TraerProductosPorId($idProducto) {
		$sql =		"select
					p.idproducto,
					p.fechacreacion,
					p.email,
					p.password,
					max(case d.numeracion when 1 then d.datos end) as num1,
					max(case d.numeracion when 2 then d.datos end) as num2,
					max(case d.numeracion when 3 then d.datos end) as num3,
					max(case d.numeracion when 4 then d.datos end) as num4,
					max(case d.numeracion when 5 then d.datos end) as num5,
					max(case d.numeracion when 6 then d.datos end) as num6,
					p.refcategoria
					from		se_productos p
					
					left
					join		se_datos d
					on			p.idproducto = d.refproducto
					
					inner
					join		se_categorias c
					on			p.refcategoria = c.idcategoria
					
					where		p.idproducto = ".$idProducto."
					
					group by	p.idproducto,
								p.fechacreacion,
								p.email,
								p.password,
								p.refcategoria
					
					
					order by    p.idproducto desc,d.numeracion";
		$res = $this->query($sql,0);
		return $res;
	
}


function BuscarProductosPorPedido($idCategoria,$dato) {
		$sql =		"select
					*
					from
					(select
					p.idproducto,
					p.fechacreacion,
					p.email,
					p.password,
					max(case d.numeracion when 1 then d.datos end) as num1,
					max(case d.numeracion when 2 then d.datos end) as num2,
					max(case d.numeracion when 3 then d.datos end) as num3,
					max(case d.numeracion when 4 then d.datos end) as num4,
					max(case d.numeracion when 5 then d.datos end) as num5,
					max(case d.numeracion when 6 then d.datos end) as num6
					from		se_productos p
					
					left
					join		se_datos d
					on			p.idproducto = d.refproducto
					
					inner
					join		se_categorias c
					on			p.refcategoria = c.idcategoria
					
					group by	p.idproducto,
								p.fechacreacion,
								p.email,
								p.password
					
					
					order by    p.idproducto desc,d.numeracion Limit 30) as d

					where d.num1 like '%".$dato."%' or d.num2 like '%".$dato."%' or d.num3 like '%".$dato."%' or d.num4 like '".$dato."%' or d.num5 like '%".$dato."%' or d.num6 like '%".$dato."%'";
		$res = $this->query($sql,0);
		
		
		return $res;
	
}



function BuscarProductosPorEmail($idCategoria,$email) {
		$sql =		"select
					p.idproducto,
					p.fechacreacion,
					p.email,
					p.password,
					max(case d.numeracion when 1 then d.datos end) as num1,
					max(case d.numeracion when 2 then d.datos end) as num2,
					max(case d.numeracion when 3 then d.datos end) as num3,
					max(case d.numeracion when 4 then d.datos end) as num4,
					max(case d.numeracion when 5 then d.datos end) as num5,
					max(case d.numeracion when 6 then d.datos end) as num6
					from		se_productos p
					
					left
					join		se_datos d
					on			p.idproducto = d.refproducto
					
					inner
					join		se_categorias c
					on			p.refcategoria = c.idcategoria
					
					where		p.email like '%".$email."%'
					
					group by	p.idproducto,
								p.fechacreacion,
								p.email,
								p.password
					
					
					order by    p.idproducto desc,d.numeracion Limit 30";
		$res = $this->query($sql,0);
		
		
		return $res;
	
}


Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "sistemaentradas";
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