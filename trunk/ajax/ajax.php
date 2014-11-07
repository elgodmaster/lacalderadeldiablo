<?php

include ('../includes/funcionesHTML.php');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesProductos.php');
include ('../includes/funcionesTurnos.php');

$ServiciosFunciones = new ServiciosHTML();
$serviciosTurnos	= new ServiciosTurnos();
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
	case 'existeCodigo':
		existeCodigo($serviciosProductos);
		break;
	case 'existeCodigoMod':
		existeCodigoMod($serviciosProductos);
		break;
		
}

function existeCodigoMod($serviciosProductos) {
	$id		=	$_POST['id'];
	$codigo =	$_POST['codigo'];
	echo	$serviciosProductos->existeCodigoMod($id,$codigo);
}

function existeCodigo($serviciosProductos) {
	$codigo =	$_POST['codigo'];
	echo	$serviciosProductos->existeCodigo($codigo);
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
	
	$res 	= $serviciosProductos->traerProductoPorId($id);
	echo $res;
}

function modificarProducto($serviciosProductos) {
	$id 			=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$precio_unit	=	$_POST['precio_unit'];
	$precio_venta	=	$_POST['precio_venta'];
	$stock			=	$_POST['stock']; 
	$stock_min		=	$_POST['stock_min'];
	$reftipoproducto=	$_POST['reftipoproducto'];
	$refproveedor	=	$_POST['refproveedor'];
	$codigo			=	$_POST['codigo'];
	$codigobarra	=	$_POST['codigobarra'];
	$caracteristicas=	$_POST['caracteristicas'];

	$res 			= $serviciosProductos->modificarProducto($id,$nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas);
	echo $res;
}

function traerProductoPorCodigo($serviciosProductos) {
	$codigo		=	$_POST['codigo'];
	
	$res 		= $serviciosProductos->traerProductoPorCodigo($codigo);
	echo $res;
}

function traerProductoPorCodigoBarra($serviciosProductos) {
	$codigobarra 	=	$_POST['$codigobarra'];
	
	$res			= $serviciosProductos->traerProductoPorCodigoBarra($codigobarra);
	echo $res;
}

function insertarProducto($serviciosProductos) {
	
	$nombre			=	$_POST['nombre'];
	$precio_unit	=	$_POST['precio_unit'];
	$precio_venta	=	$_POST['precio_venta'];
	$stock			=	$_POST['stock']; 
	$stock_min		=	$_POST['stock_min'];
	$reftipoproducto=	$_POST['reftipoproducto'];
	$refproveedor	=	$_POST['refproveedor'];
	$codigo			=	$_POST['codigo'];
	$codigobarra	=	$_POST['codigobarra'];
	$caracteristicas=	$_POST['caracteristicas'];
	
	$res 			= $serviciosProductos->insertarProducto($nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas);
	echo $res;
}

function eliminarProducto($serviciosProductos) {
	$id 			=	$_POST['id'];

	$res 			= $serviciosProductos->eliminarProducto($id);
	echo $res;
}

?>