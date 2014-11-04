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
	
		
}


?>