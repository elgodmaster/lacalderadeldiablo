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
	
	case 'traerCodigo':
		traerCodigo($serviciosProductos);
		break;	

	case 'modificarProducto':
		modificarProducto($serviciosProductos);
		break;

	case 'traerProductoPorId':
		traerProductoPorId($serviciosProductos);
		break;

	case 'traerProductoPorCodigo':
		traerProductoPorCodigo($serviciosProductos);
		break;

	case 'traerProductoPorCodigoBarra':
		traerProductoPorCodigoBarra($serviciosProductos);
		break;

	case 'eliminarProducto':
		eliminarProducto($serviciosProductos);
		break;
		
	case 'insertarProducto':
		insertarProducto($serviciosProductos);
		break;	
	case 'eliminarProveedores':
		eliminarProveedores($serviciosProductos);
		break;
	case 'modificarProveedores';
		modificarProveedores($serviciosProductos);
		break;
	case 'insertarProveedores';
		insertarProveedores($serviciosProductos);
		break;
}

function insertarProveedores($serviciosProductos) {
	$proveedor	=	$_POST['proveedor'];
	$direccion	=	$_POST['direccion'];
	$telefono	=	$_POST['telefono'];
	$cuit		=	$_POST['cuit'];
	$nombre		=	$_POST['nombre'];
	$email		=	$_POST['email'];
	echo	$serviciosProductos->insertarProveedores($proveedor,$direccion,$telefono,$cuit,$nombre,$email);
}


function eliminarProveedores($serviciosProductos) {
	$id			=	$_POST['id'];

	echo	$serviciosProductos->eliminarProveedores($id);
}

function modificarProveedores($serviciosProductos) {
	$id			=	$_POST['id'];
	$proveedor	=	$_POST['proveedor'];
	$direccion	=	$_POST['direccion'];
	$telefono	=	$_POST['telefono'];
	$cuit		=	$_POST['cuit'];
	$nombre		=	$_POST['nombre'];
	$email		=	$_POST['email'];
	echo	$serviciosProductos->modificarProveedores($id,$proveedor,$direccion,$telefono,$cuit,$nombre,$email);
}



function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->login($email,$pass);
}

function traerCodigo($serviciosProductos) {
	$codigo =	$_POST['codigo'];
	
	$res 	= $serviciosProductos->traerCodigo($codigo);
	echo $res;
}


function traerProductoPorId($serviciosProductos) {
	$id 	=	$_POST['id'];
	$orden	=	$_POST['orden'];
	
	$res 	= $serviciosProductos->traerProductoPorId($id,$orden);
	echo $res;
}

function modificarProducto($serviciosProductos) {
	$id 			=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$precio_unit	=	$_POST['precio_unit'];
	$precio_venta	=	$_POST['precio_venta'];

	$res 			= $serviciosProductos->modificarProducto($id,$nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas);
	echo $res;
}

function traerProductoPorCodigo($serviciosProductos) {
	$codigo		=	$_POST['codigo'];
	$orden		=	$_POST['orden'];
	
	$res 		= $serviciosProductos->traerProductoPorCodigo($codigo,$orden);
	echo $res;
}

function traerProductoPorCodigoBarra($serviciosProductos) {
	$codigobarra 	=	$_POST['$codigobarra'];
	$orden			=	$_POST['orden'];
	
	$res			= $serviciosProductos->traerProductoPorCodigoBarra($codigobarra,$orden);
	echo $res;
}

function insertarProducto($serviciosProductos) {
	$id 			=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$precio_unit	=	$_POST['precio_unit'];
	$precio_venta	=	$_POST['precio_venta'];
	
	$res 			= $serviciosProductos->insertarProducto($nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas);
	echo $res;
}

function eliminarProducto($serviciosProductos) {
	$id 			=	$_POST['id'];

	$res 			= $serviciosProductos->eliminarProducto($id);
	echo $res;
}

?>