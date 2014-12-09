<?php

include ('../includes/funcionesGlobo.php');

$serviciosGlobo  = new ServiciosGlobo();


$accion = $_POST['accion'];


switch ($accion) {
	
	case 'insertarContacto':
		insertarContacto($serviciosGlobo);
		break;	
}

function insertarContacto($serviciosGlobo) {
	$nombre			=	$_POST['nombre'];
	$correo			=	$_POST['correo'];
	$ciudad			=	$_POST['ciudad'];
	$telefonomovil	=	$_POST['telefonomovil'];
	$telefonofijo	=	$_POST['telefonofijo'];
	$mensaje		=	$_POST['mensaje'];
	echo $serviciosGlobo->insertarContacto($nombre,$correo,$ciudad,$telefonomovil,$telefonofijo,$mensaje);
}

?>

