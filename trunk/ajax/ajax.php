<?php

include ('../includes/funcionesHTML.php');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesProductos.php');


$ServiciosFunciones = new ServiciosHTML();

$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosProductos  = new ServiciosProductos();

$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'TraerProductosTop':
		TraerProductosTop($serviciosProductos);
		break;
	case 'insertarCategoria':
		insertarCategoria($serviciosProductos);
		break;
	case 'TraerCategoriasPorId':
		TraerCategoriasPorId($serviciosProductos);
		break;
	case 'modificarCategoria':
		modificarCategoria($serviciosProductos);
		break;
	case 'eliminarCategoria':
		eliminarCategoria($serviciosProductos);
		break;
	case 'insertarProducto':
		insertarProducto($serviciosProductos);
		break;
	case 'modificarProducto':
		modificarProducto($serviciosProductos);
		break;
	case 'modificarDatos':
		modificarDatos($serviciosProductos);
		break;
	case 'eliminarProducto':
		eliminarProducto($serviciosProductos);
		break;
	case 'TraerProductosPorId':
		TraerProductosPorId($serviciosProductos);
		break;
		
}


function TraerCategoriasPorId($serviciosProductos) {
	$id = $_POST['id'];
	$res = $serviciosProductos->TraerCategoriasPorId($id);
	echo $res;
}

function TraerProductosPorId($serviciosProductos) {
	$id		=	$_POST['id'];
	$res	=	$serviciosProductos->TraerProductosPorId($id);
	echo 	mysql_result($res,0,0).'/*/'
			.mysql_result($res,0,1).'/*/'
			.mysql_result($res,0,2).'/*/'
			.mysql_result($res,0,3).'/*/'
			.mysql_result($res,0,4).'/*/'
			.mysql_result($res,0,5).'/*/'
			.mysql_result($res,0,6).'/*/'
			.mysql_result($res,0,7).'/*/'
			.mysql_result($res,0,8).'/*/'
			.mysql_result($res,0,9);
}


function eliminarProducto($serviciosProductos) {
	$id		=	$_POST['id'];
	echo $serviciosProductos->eliminarProducto($id);
}

function modificarDatos($serviciosProductos) {
	$numeracion		=	$_POST['numeracion'];
	$id				=	$_POST['idproducto'];
	$dato			=	$_POST['pedido'];
	$res = $serviciosProductos->modificarDatos($dato,$id,$numeracion);
	echo $res;
}

function modificarProducto($serviciosProductos) {
	$email			=	$_POST['email'];
	$password		=	$_POST['password'];
	$fecha			=	$_POST['fecha'];
	$refcategoria	=	$_POST['refcategoria'];
	$id				=	$_POST['idproducto'];
	
	$res = $serviciosProductos->modificarProducto($email,$password,$fecha,$refcategoria,$id);
	
	for ($i=1;$i<7;$i++) {
		$serviciosProductos->modificarDatos(($_POST['pedido'.$i]=='') ? '' : $_POST['pedido'.$i] ,$id ,$i);	
	}
	
	echo $res;
		
}


function insertarProducto($serviciosProductos) {
	$email			=	$_POST['email'];
	$password		=	$_POST['password'];
	$fecha			=	$_POST['fecha'];
	$refcategoria	=	$_POST['refcategoria'];
	
	$pedido1		=	($_POST['pedido1']=='') ? '' : $_POST['pedido1'];	
	$pedido2		=	($_POST['pedido2']=='') ? '' : $_POST['pedido2'];
	$pedido3		=	($_POST['pedido3']=='') ? '' : $_POST['pedido3'];
	$pedido4		=	($_POST['pedido4']=='') ? '' : $_POST['pedido4'];
	$pedido5		=	($_POST['pedido5']=='') ? '' : $_POST['pedido5'];
	$pedido6		=	($_POST['pedido6']=='') ? '' : $_POST['pedido6'];
	
	$res = $serviciosProductos->insertarProducto($email,$password,$fecha,$refcategoria);
	
	
	$resD = $serviciosProductos->insertarDatos(	$pedido1,$pedido2,$pedido3,$pedido4,$pedido5,$pedido6,$res);
	
	
	echo $resD;
}


function eliminarCategoria($serviciosProductos) {
	$id = $_POST['id'];
	$res = $serviciosProductos->eliminarCategoria($id);
	echo '';	
}

function modificarCategoria($serviciosProductos) {
	$categoria	= str_replace("'","",$_POST['nombre']);
	$id			= $_POST['id'];
	$res = $serviciosProductos->modificarCategoria($categoria,$id);
	echo $res;
}

function insertarCategoria($serviciosProductos) {
	$categoria = str_replace("'","",$_POST['nombre']);
	$res = $serviciosProductos->insertarCategoria($categoria);
	echo $res;
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->login($email,$pass);
}

function TraerProductosTop($serviciosProductos) {
	echo $serviciosProductos->TraerProductosTop();
}


function modificarCliente($serviciosClientes) {
	$url			=	$_POST['url'];
	$acceso			=	$_POST['acceso'];
	$refformapago	=	$_POST['formapago'];
	$id				=	$_POST['id'];
	$fechabaja		=	$_POST['fechabaja'];

    $serviciosClientes->modificarCliente($id,$url,$refformapago,$acceso,$fechabaja);        	
	
	$datos = $serviciosClientes->TraerDatosDeFacturacion($id);
	
	$nombre				=	utf8_decode(str_replace("'","",$_POST['nombre']));
	$direccion			=	utf8_decode(str_replace("'","",$_POST['direccion']));
	$ciudad				=	utf8_decode(str_replace("'","",$_POST['ciudad']));
	$pais				=	utf8_decode(str_replace("'","",$_POST['pais']));
	$nif				=	str_replace("'","",$_POST['nif']);
	$telefonofijo		=	str_replace("'","",$_POST['telefonofijo']);
	$telefonomovil		=	str_replace("'","",$_POST['telefonomovil']);
	
	if (mysql_num_rows($datos) > 0) {
		$serviciosClientes->modificarDatosFacturacion($id,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	} else {
		$serviciosClientes->insertarDatosFacturacion($id,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	}
	echo "";
}

?>