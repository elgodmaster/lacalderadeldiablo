<?php

include ('../includes/funcionesClientes.php');

$serviciosClientes  = new ServiciosClientes();

$accion = $_POST['accion'];


switch ($accion) {
	
	case 'insertarCliente':
		insertarCliente($serviciosClientes);
		break;	
	case 'generarNroCliente':
		generarNroCliente($serviciosProductos);
		break;

	case 'eliminarCliente':
		eliminarCliente($serviciosProductos);
		break;

	case 'modificarCliente':
		modificarCliente($serviciosProductos);
		break;

	case 'traerClientePorId':
		traerClientePorId($serviciosProductos);
		break;
		
	case 'traerClientePorNroCliente':
		traerClientePorNroCliente($serviciosProductos);
		break;	
	case 'traerClientePorNroDocumento':
		traerClientePorNroDocumento($serviciosProductos);
		break;
		
}

function insertarCliente($serviciosClientes) {
	$nombre			=	$_POST['nombre'];
	$nrocliente		=	$_POST['nrocliente'];
	$email			=	$_POST['email'];
	$nrodocumento	=	$_POST['nrodocumento'];
	echo $serviciosClientes->insertarCliente($nombre,$nrocliente,$email,$nrodocumento);
}


function eliminarCliente($serviciosProductos) {
	$id 			=	$_POST['id'];

	$res 			= $serviciosProductos->eliminarCliente($id);
	echo $res;
}


function modificarCliente($serviciosProductos) {
	$id 			=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$nrocliente		=	$_POST['nrocliente'];
	$email			=	$_POST['email'];
	$nrodocumento	=	$_POST['nrodocumento']; 
	
	$res 			= $serviciosProductos->modificarCliente($id,$nombre,$nrocliente,$email,$nrodocumento);
	echo $res;
}

function traerClientePorId($serviciosProductos) {
	$id 	=	$_POST['id'];
	
	$res 	= $serviciosProductos->traerClientePorId($id);
	echo $res;
}



function traerClientePorNroCliente($serviciosProductos) {
	$nrodocumento	=	$_POST['nrodocumento'];
	
	$res 			= $serviciosProductos->traerClientePorNroCliente($nrodocumento);
	echo $res;
}

function traerClientePorNroDocumento($serviciosProductos) {
	$codigobarra 	=	$_POST['$codigobarra'];
	
	$res			= $serviciosProductos->traerClientePorNroDocumento($codigobarra);
	echo $res;
}

?>

