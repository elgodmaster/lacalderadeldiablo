<?php

include ('../includes/funcionesClientes.php');
include ('../includes/funcionesMovimientos.php');
include ('../includes/funcionesConfiguraciones.php');
include ('../includes/funcionesVentas.php');

$serviciosClientes  = new ServiciosClientes();
$serviciosMovimientos = new ServiciosMovimientos();
$serviciosConfiguraciones = new ServiciosConfiguraciones();
$serviciosVentas = new ServiciosVentas();

$accion = $_POST['accion'];


switch ($accion) {
	
	case 'insertarCliente':
		insertarCliente($serviciosClientes,$serviciosMovimientos,$serviciosVentas,$serviciosConfiguraciones);
		break;
	case 'modificarCliente':
		modificarCliente($serviciosClientes,$serviciosMovimientos,$serviciosVentas,$serviciosConfiguraciones);
		break;

	case 'generarNroCliente':
		generarNroCliente($serviciosClientes);
		break;

	case 'eliminarCliente':
		eliminarCliente($serviciosClientes);
		break;
	case 'traerClientePorId':
		traerClientePorId($serviciosClientes);
		break;
		
	case 'traerClientePorNroCliente':
		traerClientePorNroCliente($serviciosClientes);
		break;	
	case 'traerClientePorNroDocumento':
		traerClientePorNroDocumento($serviciosClientes);
		break;
		
}

/* logica de negocio para los saldos, movimientos de los clientes */


function insertarCliente($serviciosClientes,$serviciosMovimientos,$serviciosVentas,$serviciosConfiguraciones) {
	$nombre			=	$_POST['nombre'];
	$email			=	$_POST['email'];
	$nrodocumento	=	$_POST['nrodocumento'];
	$telefono		=	$_POST['telefono'];
	$saldo			=	$_POST['saldo'];
	$usuacrea		=	$_POST['usuacrea'];

	$res = $serviciosClientes->insertarCliente($nombre,'',$email,$nrodocumento,$telefono,$saldo);

	if ((integer)$res > 0) {
		if ($saldo > 0) {
			$tipoventa = mysql_result($serviciosConfiguraciones->traerTipoVentaValor('Clientes'), 0,0);
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,0,'',1,$usuacrea,'','','Idcliente:'.$res,'Carga de nuevo cliente');
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$saldo,$fechacreacion,$usuacrea,$res,'Carga de nuevo cliente');
		}
		$res = '';			
	}

	echo $res;
}


function modificarCliente($serviciosClientes,$serviciosMovimientos,$serviciosVentas,$serviciosConfiguraciones) {
	$id 			=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$email			=	$_POST['email'];
	$nrodocumento	=	$_POST['nrodocumento']; 
	$telefono		=	$_POST['telefono'];
	$saldo			=	$_POST['saldo'];
	$saldoviejo		=	$_POST['saldoviejo'];
	$usuacrea		=	$_POST['usuacrea'];

	$res 			= $serviciosClientes->modificarCliente($id,$nombre,'',$email,$nrodocumento,$telefono,$saldo);
	
	if ($res == '') {
		if ($saldo != $saldoviejo) {
			$tipoventa = mysql_result($serviciosConfiguraciones->traerTipoVentaValor('Clientes'), 0,0);
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,0,'',1,$usuacrea,'','','Idcliente:'.$id,'Carga de saldo del cliente');
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,($saldo - $saldoviejo),$fechacreacion,$usuacrea,$id,'Carga de saldo del cliente');
		}
		$res = '';			
	}

	echo $res;
}

/* fin de la la logica */

function eliminarCliente($serviciosClientes) {
	
	$id 			=	$_POST['id'];

	$res 			= $serviciosClientes->eliminarCliente($id);
	echo $res;
}




function traerClientePorId($serviciosClientes) {
	$id 	=	$_POST['id'];
	
	$res 	= $serviciosClientes->traerClientePorId($id);
	echo $res;
}



function traerClientePorNroCliente($serviciosClientes) {
	$nrodocumento	=	$_POST['nrodocumento'];
	
	$res 			= $serviciosClientes->traerClientePorNroCliente($nrodocumento);
	echo $res;
}

function traerClientePorNroDocumento($serviciosClientes) {
	$codigobarra 	=	$_POST['$codigobarra'];
	
	$res			= $serviciosClientes->traerClientePorNroDocumento($codigobarra);
	echo $res;
}

?>

