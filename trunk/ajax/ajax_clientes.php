<?php

include ('../includes/funcionesClientes.php');

$serviciosClientes  = new ServiciosClientes();

$accion = $_POST['accion'];


switch ($accion) {
	
	case 'insertarCliente':
		insertarCliente($serviciosClientes);
		break;	
		
}

function insertarCliente($serviciosClientes) {
	$nombre			=	$_POST['nombre'];
	$nrocliente		=	$_POST['nrocliente'];
	$email			=	$_POST['email'];
	$nrodocumento	=	$_POST['nrodocumento'];
	echo $serviciosClientes->insertarCliente($nombre,$nrocliente,$email,$nrodocumento);
}

?>