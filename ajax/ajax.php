<?php

include ('../includes/funcionesHTML.php');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesProductos.php');
include ('../includes/funcionesTurnos.php');
include ('../includes/funcionesConfiguraciones.php');
include ('../includes/funcionesVentas.php');
include ('../includes/funcionesFiestas.php');
include ('../includes/funcionesMovimientos.php');
include ('../includes/funcionesClientes.php');
require ('../includes/funcionesAdministrativo.php');
require ('../includes/funcionesExportar.php');
require ('../includes/funcionesImportar.php');

$serviciosClientes  = new ServiciosClientes();

$ServiciosFunciones = new ServiciosHTML();
$serviciosTurnos	= new ServiciosTurnos();
$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosProductos  = new ServiciosProductos();
$serviciosConfiguraciones = new ServiciosConfiguraciones();
$serviciosVentas = new ServiciosVentas();
$serviciosFiestas = new ServiciosFiestas();
$serviciosAdministrativo = new ServiciosAdministrativo();

$serviciosMovimientos = new ServiciosMovimientos();

$serviciosExportar = new ServiciosExportar();
$serviciosImportar = new ServiciosImportar();

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
	case 'hayTurnos':
		hayTurnos($serviciosTurnos);
		break;
	case 'traerPrimerUltimoTurno':
		traerPrimerUltimoTurno($serviciosTurnos);
		break;
	case 'crearTablaTurnos':
		crearTablaTurnos($serviciosTurnos);
		break;
	case 'insertarTipoVenta':
		insertarTipoVenta($serviciosConfiguraciones);
		break;
	case 'modificarTipoVenta':
		modificarTipoVenta($serviciosConfiguraciones);
		break;
	case 'eliminarTipoVenta':
		eliminarTipoVenta($serviciosConfiguraciones);
		break;
	case 'traerProductoVenta':
		traerProductoVenta($serviciosProductos);
		break;
	case 'traerProductoVentaBarra':
		traerProductoVentaBarra($serviciosProductos);
		break;
	case 'insertarTipoProducto':
		insertarTipoProducto($serviciosProductos,$serviciosMovimientos);
		break;
	case 'modificarTipoProducto':
		modificarTipoProducto($serviciosProductos,$serviciosMovimientos);
		break;
	case 'eliminarTipoProducto':
		eliminarTipoProducto($serviciosProductos,$serviciosMovimientos);
		break;
	case 'traerMovimienosClientesMovimientos':
		traerMovimienosClientesMovimientos($serviciosMovimientos);
		break;
	case 'insertarAdministrativo':
		insertarAdministrativo($serviciosAdministrativo);
		break;
	case 'modificarAdministrativo':
		modificarAdministrativo($serviciosAdministrativo);
		break;
	case 'insertarUsuario':
		insertarUsuario($serviciosUsuarios);
		break;
	case 'modificarUsuario':
		modificarUsuario($serviciosUsuarios);
		break;
	case 'eliminarUsuario':
		eliminarUsuario($serviciosUsuarios);
		break;	
	case 'exportarweb':
		exportarweb($serviciosExportar);
		break;
	case 'exportarlocal':
		exportarlocal($serviciosExportar);
		break;
	case 'importar':
		importar($serviciosImportar);
		break;		
		
		
		
	case 'insertarTurnoVerificado':
		insertarTurnoVerificado($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes);
		break;
	case 'insertarTurno':
		insertarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes);
		break;
	case 'modificarTurno':
		modificarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes);
		break;
	case 'eliminarTurno':
		eliminarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes);
		break;
	case 'insertarDetalle':
		insertarDetalle($serviciosVentas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosProductos);
		break;
	case 'insertarFiesta':
		insertarFiesta($serviciosFiestas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos);
		break;
	case 'eliminarFiesta':
		eliminarFiesta($serviciosFiestas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos);
		break;
	case 'modificarFiesta':
		modificarFiesta($serviciosFiestas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos);
		break;
}



/* functiones que trabajan con ventas y movimientos */

	
	function insertarTurnoVerificado($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes) {
		$id			=	$_POST['idturno'];
		$usuacrea	=	$_POST['usuacrea'];
		
		$resTraerTurrno = $serviciosTurnos->traerTurnosPorId($id);
		
		$refcancha			=	mysql_result($resTraerTurrno,0,'refcancha');
		$fechautilizacion	=	date('Y-m-d');
	
		
		
		$horautilizacion	=	mysql_result($resTraerTurrno,0,'horautilizacion');
		$refcliente			=	mysql_result($resTraerTurrno,0,'refcliente');
		$fechacreacion		=	date('Y-m-d');
		$usuacrea			=	$_POST['usuacrea'];
		//5 alquiler de canchas de noche - 2 alquiler de canchas de dia
		if (mysql_result($resTraerTurrno,0,'horautilizacion') >= 18) {
			$tipoventa			=	5;
		} else {
			$tipoventa			=	2;
		}
		$indefinido			=	1;
		
		$nocliente			=	mysql_result($resTraerTurrno,0,'cliente');
	
		$res = $serviciosTurnos->insertarTurnoVerificado($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$nocliente,$indefinido);
	
		
		if ((integer)$res > 0) {
			$cancha = mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
			$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion,1);
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,$fechacreacion,$usuacrea,$res,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion);
			//descuento el saldo del cliente
			$serviciosClientes->descontarSaldo($refcliente,$monto);
			$res = '';
		}
	
		echo $res;
	}
	
	
	
	
	
	
	function insertarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes) {
		$refcancha			=	$_POST['refcancha'];
		$fechautilizacion	=	$_POST['fechautilizacion'];
	
		
		
		$horautilizacion	=	$_POST['horautilizacion'];
		$refcliente			=	$_POST['refcliente'];
		$fechacreacion		=	'';
		$usuacrea			=	$_POST['usuacrea'];
		$tipoventa			=	$_POST['tipoventa'];
		$indefinido			=	$_POST['indefinido'];
		
		$nocliente			=	$_POST['nocliente'];
		$mesentero 			=	$_POST['mesentero'];
	
		if ($refcliente == '') {
			$refcliente = 0;
		} else {
			$nocliente = mysql_result($serviciosClientes->traerClientePorId($refcliente), 0,1);
		}
	
		//entra aca para cargar varios turnos a la vez
		if ($mesentero == 1) {
			$fechautilizacion2	=	$_POST['fechautilizacion2'];
			$fechautilizacion3	=	$_POST['fechautilizacion3'];
			$fechautilizacion4	=	$_POST['fechautilizacion4'];
	
			if ($fechautilizacion2 != '0000-00-00') {
				$res = $serviciosTurnos->insertarTurno($refcancha,$fechautilizacion2,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$nocliente,$indefinido);
				if ((integer)$res > 0) {
					$cancha = mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
					$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
					$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
					$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion2,1);
					$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,$fechacreacion,$usuacrea,$res,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion2);
					//descuento el saldo del cliente
					$serviciosClientes->descontarSaldo($refcliente,$monto);
					$res = '';
				}
	
			}
			
			if ($fechautilizacion3 != '0000-00-00') {
				$res = $serviciosTurnos->insertarTurno($refcancha,$fechautilizacion3,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$nocliente,$indefinido);
				if ((integer)$res > 0) {
					$cancha = mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
					$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
					$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
					$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion3,1);
					$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,$fechacreacion,$usuacrea,$res,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion3);
					//descuento el saldo del cliente
					$serviciosClientes->descontarSaldo($refcliente,$monto);
					$res = '';
				}
			}
	
			if ($fechautilizacion4 != '0000-00-00') {
				$res = $serviciosTurnos->insertarTurno($refcancha,$fechautilizacion4,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$nocliente,$indefinido);
				if ((integer)$res > 0) {
					$cancha = mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
					$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
					$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
					$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion4,1);
					$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,$fechacreacion,$usuacrea,$res,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion4);
					//descuento el saldo del cliente
					$serviciosClientes->descontarSaldo($refcliente,$monto);
					$res = '';
				}
			}
			
			
		}
		//fin del ems entero
		
		//gravo el turno
		$res = $serviciosTurnos->insertarTurno($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$nocliente,$indefinido);
	
		if ((integer)$res > 0) {
			$cancha = mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
			$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion,1);
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,$fechacreacion,$usuacrea,$res,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion);
			//descuento el saldo del cliente
			$serviciosClientes->descontarSaldo($refcliente,$monto);
			$res = '';
		}
	
		echo $res;
	}
	
	function eliminarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes) {
		$id 		=	$_POST['id'];
		$usuacrea	=	$_POST['usuacrea'];
		
		$turno = $serviciosTurnos->traerTurnosPorId($id);
		
		$refcliente		= mysql_result($turno,0,4);
		$refcancha		= mysql_result($turno,0,1);
		$res = $serviciosTurnos->eliminarTurno($id);
		$res = '';
		if ($res == '') {
			$cancha 	= mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
			
			$mov		= $serviciosVentas->traerIdVenta($id,'Canchas');
			
			$idventa 	= mysql_result($mov,0,0);
			$tipoventa	= mysql_result($mov,0,1);
			
			$monto 		= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto 	= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
			
			$serviciosVentas->modificarVenta($idventa,1,'Se cancelo el turno de la cancha: '.$cancha);
			$$serviciosMovimientos->insertarMovimiento($tipoventa,$idventa,-1*$monto,'',$usuacrea,$id,'Alquiler de '.$cancha." Cancelado");
			//descuento el saldo del cliente
			$serviciosClientes->cargarSaldo($refcliente,$monto);
		}
		//echo $c."-".$d;
		echo $res;
	}
	
	
	function modificarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosClientes) {
		$id 				=	$_POST['id'];
		$refcancha			=	$_POST['refcancha'];
		$fechautilizacion	=	$_POST['fechautilizacion'];
		$horautilizacion	=	$_POST['horautilizacion'];
		$refcliente			=	$_POST['refcliente'];
		$fechacreacion		=	'';
		$indefinido			=	$_POST['indefinido'];
		$usuacrea			=	$_POST['usuacrea'];
		$tipoventa			=	$_POST['tipoventa'];
		
		$res = $serviciosTurnos->modificarTurno($id,$refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea,$indefinido);	
		
		if ($res == '') {
			$cancha 	= mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
			$monto 		= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto 	= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
			
			$mov		= $serviciosVentas->traerIdVenta($id,'Canchas');
			
			$idmov		= mysql_result($mov,0,2);
			$idventa 	= mysql_result($mov,0,0);
			$montoSaldo = mysql_result($mov,0,3);
			
			$serviciosVentas->eliminarVenta($idventa);
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion,1);
			
			$serviciosMovimientos->eliminarMovimiento($idmov);
			
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,'',$usuacrea,$id,'Alquiler de '.$cancha.' Fecha:'.$fechautilizacion);
			
			//devuelvo el saldo y descuento el saldo del cliente
			$serviciosClientes->cargarSaldo($refcliente,$montoSaldo);
			
			$serviciosClientes->descontarSaldo($refcliente,$monto);
		}
		
		echo $res;
	}
	
	
	
	function insertarDetalle($serviciosVentas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos,$serviciosProductos) {
		$id  		= $_POST['id'];
		$producto 	= $_POST['producto'];
		$cantidad 	= $_POST['cantidad'];
		$monto 		= $_POST['monto'];
		$tipoventa  = $_POST['tipoventa'];
		$usuacrea	= $_POST['usuacrea'];
		$tipoventa	=	$_POST['tipoventa'];
		
		$res = $serviciosVentas->insertarVenta($id,$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Venta de Productos',$cantidad);
		
		if ((integer)$res > 0) {
			$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
			$serviciosMovimientos->insertarMovimiento($tipoventa,$res,$monto,'',$usuacrea,$id,'Venta de las heladeras');
			
			$serviciosProductos->descontarStock($id,$cantidad);
			$res = '';
		}
		
		
		echo $res;
	}
	
	
	function insertarFiesta($serviciosFiestas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos) {
		$nombre		=	$_POST['nombre'];
		$dia 		=	$_POST['dia'];
		$horadesde  =	$_POST['horadesde'];
		$horahasta  =	$_POST['horahasta'];
		$concatering=	$_POST['concatering'];
		$tipoventa	=	$_POST['tipoventa'];
		$usuacrea 	=	$_POST['usuacrea'];
		$saldo		=	$_POST['saldo'];
		
		$res = $serviciosFiestas->insertarFiesta($nombre,$horadesde,$horahasta,$dia,$concatering,$saldo);
		
		if ((integer)$res > 0) {
			$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
	
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de Fiesta',1);
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,'',$usuacrea,$res,'Alquiler de Fiesta');
			
			$res = '';
		}
		
		echo $res;
	}
	
	
	function modificarFiesta($serviciosFiestas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos) {
		$id 		=	$_POST['id'];
		$nombre		=	$_POST['nombre'];
		$horadesde	=	$_POST['horadesde'];
		$horahasta  =	$_POST['horahasta'];
		$dia 		=	$_POST['dia'];
		$concatering=	$_POST['concatering'];
		$tipoventa	=	$_POST['tipoventa'];
		$usuacrea 	=	$_POST['usuacrea'];
		$saldo		=	$_POST['saldo'];
		
		$res = $serviciosFiestas->modificarFiesta($id,$nombre,$horadesde,$horahasta,$dia,$concatering,$saldo);
		
		if ($res == '') {
			$monto 		= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto 	= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
			
			$mov		= $serviciosVentas->traerIdVenta($id,'Fiestas');
			
			$idmov		= mysql_result($mov,0,2);
			$idventa 	= mysql_result($mov,0,0);
			
			$serviciosVentas->eliminarVenta($idventa);
			$resVenta = $serviciosVentas->insertarVenta('',$tipoventa,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de Fiesta',1);
			
			$serviciosMovimientos->eliminarMovimiento($idmov);
			
			$serviciosMovimientos->insertarMovimiento($tipoventa,$resVenta,$monto,'',$usuacrea,$id,'Alquiler de Fiesta');
			
		}
		//echo $c;
		echo $res;
	}
	
	function eliminarFiesta($serviciosFiestas,$serviciosVentas,$serviciosConfiguraciones,$serviciosMovimientos) {
		$id 	=	$_POST['id'];
		$usuacrea			=	$_POST['usuacrea'];
		
		$res = $serviciosFiestas->eliminarFiesta($id);
		
		if ($res == '') {
			
			$mov		= $serviciosVentas->traerIdVenta($id,'Fiestas');
			
			$idventa 		= mysql_result($mov,0,0);
			$tipoventa	= mysql_result($mov,0,1);
			
			$monto 		= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,'precio');
			$producto 	= mysql_result($serviciosConfiguraciones->traerTipoVentaId($tipoventa), 0,3);
			
			$serviciosVentas->modificarVenta($idventa,1,'Se cancelo la fiesta ');
			$serviciosMovimientos->insertarMovimiento($tipoventa,$idventa,0,'',$usuacrea,$id,'Alquiler de Fiesta cancelado');
		}
		
		echo $res;
	}
/*************************** fin de las funciones que trabajan con los movimientos *************************/

/* para las importaciones y exportaciones */

function exportarweb($serviciosExportar) {
	$donde = $_POST['donde'];
	if ($donde == 'localhost') {
		$res = $serviciosExportar->ExportarLocal();
	} else {
		$res = $serviciosExportar->ExportarWeb();	
	}
	
	echo $res;	
}

function importar($serviciosImportar) {
	
	$donde = $_POST['donde'];
	if ($donde == 'localhost') {
		$archivo = $_FILES['archivo']['name'];
		$res = $serviciosImportar->ImportarLocal($archivo);
	} else {
		$archivo = 'archivo';
		$resArchivo = $serviciosImportar->subirArchivo($archivo);
		$res = $serviciosImportar->ImportarWeb($resArchivo);	
	}
	
	echo $res;	
}


/*************************** fin del importar exportar *******************/


function insertarUsuario($serviciosUsuarios) {
	
	$usuario		= $_POST['usuario'];
	$password		= $_POST['password'];
	$refroll		= $_POST['refroll'];
	$email			= $_POST['email'];
	$nombrecompleto = $_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombrecompleto);
	
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	
	$usuario		= $_POST['usuario'];
	$password		= $_POST['password'];
	$refroll		= $_POST['refroll'];
	$email			= $_POST['email'];
	$nombrecompleto = $_POST['nombrecompleto'];
	$id				= $_POST['id'];
	
	$res = $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombrecompleto);
	
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function eliminarUsuario($serviciosUsuarios) {
	
	$id				= $_POST['id'];
	
	$res = $serviciosUsuarios->eliminarUsuario($id);
	
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarAdministrativo($serviciosAdministrativo) {
	
	$importecanchas			=	$_POST['importecanchas'];
	$importebar				=	$_POST['importebar'];
	$importesueldos			=	$_POST['importesueldos'];
	$importegastosvarios	=	$_POST['importegastosvarios'];
	$importemercaderia		=	$_POST['importemercaderia'];
	$importegas				=	$_POST['importegas'];
	$importeluz				=	$_POST['importeluz'];
	$importetelefono		=	$_POST['importetelefono'];
	$importeagua			=	$_POST['importeagua'];
	$importeinmobiliario	=	$_POST['importeinmobiliario'];
	$importeimpuestos		=	$_POST['importeimpuestos'];
	$importeautonomos		=	$_POST['importeautonomos'];
	$importeingresosbrutos	=	$_POST['importeingresosbrutos'];
	$importeaportes			=	$_POST['importeaportes'];
	$importesmunicipal		=	$_POST['importesmunicipal'];
	$importefiestas			=	$_POST['importefiestas'];
	$anio					=	$_POST['anio'];
	$mes					=	$_POST['mes'];
	
	echo $serviciosAdministrativo->insertarAdministrativo($importecanchas,$importebar,$importesueldos,$importegastosvarios,$importemercaderia,$importegas,$importeluz,$importetelefono,$importeagua,$importeinmobiliario,$importeimpuestos,$importeautonomos,$importeingresosbrutos,$importeaportes,$importesmunicipal,$importefiestas,$anio,$mes);
}

function modificarAdministrativo($serviciosAdministrativo) {
	$id						=	$_POST['id'];
	$importecanchas			=	$_POST['importecanchas'];
	$importebar				=	$_POST['importebar'];
	$importesueldos			=	$_POST['importesueldos'];
	$importegastosvarios	=	$_POST['importegastosvarios'];
	$importemercaderia		=	$_POST['importemercaderia'];
	$importegas				=	$_POST['importegas'];
	$importeluz				=	$_POST['importeluz'];
	$importetelefono		=	$_POST['importetelefono'];
	$importeagua			=	$_POST['importeagua'];
	$importeinmobiliario	=	$_POST['importeinmobiliario'];
	$importeimpuestos		=	$_POST['importeimpuestos'];
	$importeautonomos		=	$_POST['importeautonomos'];
	$importeingresosbrutos	=	$_POST['importeingresosbrutos'];
	$importeaportes			=	$_POST['importeaportes'];
	$importesmunicipal		=	$_POST['importesmunicipal'];
	$importefiestas			=	$_POST['importefiestas'];
	$anio					=	$_POST['anio'];
	$mes					=	$_POST['mes'];
	
	echo $serviciosAdministrativo->modificarAdministrativo($id,$importecanchas,$importebar,$importesueldos,$importegastosvarios,$importemercaderia,$importegas,$importeluz,$importetelefono,$importeagua,$importeinmobiliario,$importeimpuestos,$importeautonomos,$importeingresosbrutos,$importeaportes,$importesmunicipal,$importefiestas,$anio,$mes);
}


function traerMovimienosClientesMovimientos($serviciosMovimientos) {
	$idcliente		= $_POST['idcliente'];
	$idmovimiento	= $_POST['idmovimiento'];
	
	$res = $serviciosMovimientos->traerMovimienosClientesMovimientos($idcliente,$idmovimiento);
	
	$cad = "";
	while ($row = mysql_fetch_array($res)) {
		$cad = "<tr>";
		$cad = $cad."<td>".utf8_encode($row[4])."</td>"."<td>".$row[7]."</td>"."<td>".$row[8]."</td>"."<td>".$row[9]."</td>";
	}
	
	echo $cad;
	//echo $res;
}



function insertarTipoProducto($serviciosProductos,$serviciosMovimientos) {
	$tipoproducto	=	$_POST['tipoproducto'];
	$activo			=	$_POST['activo'];
	
	echo $serviciosProductos->insertarTipoProducto($tipoproducto,$activo);
	
	
}


function modificarTipoProducto($serviciosProductos,$serviciosMovimientos) {
	$tipoproducto	=	$_POST['tipoproducto'];
	$activo			=	$_POST['activo'];
	$id 			=	$_POST['id'];
	
	echo $serviciosProductos->modificarTipoProducto($id,$tipoproducto,$activo);
}

function eliminarTipoProducto($serviciosProductos,$serviciosMovimientos) {
	$id 	=	$_POST['id'];
	
	echo $serviciosProductos->eliminarTipoProducto($id);
}



function traerProductoVentaBarra($serviciosProductos) {
	$id 	=	$_POST['idproducto'];
	$res 	=	$serviciosProductos->traerProductoPorCodigoBarra($id);

	$cad	= "";

	while ($row = mysql_fetch_array($res)) {
		$cad = $cad.$row[1].'##'.$row[3].'##'.$row[4].'##'.$row[8].'##'.$row[9].'##'.$row[10].'##'.$row[0];
	}

	echo $cad;
}


function traerProductoVenta($serviciosProductos) {
	$id 	=	$_POST['idproducto'];
	$res 	=	$serviciosProductos->traerProductoPorId($id);

	$cad	= "";

	while ($row = mysql_fetch_array($res)) {
		$cad = $cad.$row[1].'##'.$row[3].'##'.$row[4].'##'.$row[8].'##'.$row[9].'##'.$row[10].'##'.$row[0];
	}

	echo $cad;
}

function eliminarTipoVenta($serviciosConfiguraciones) {
	$id		=	$_POST['id'];
	echo $serviciosConfiguraciones->eliminarTipoVenta($id);	
}

function insertarTipoVenta($serviciosConfiguraciones) {
	$tipoventa 		=	$_POST['tipoventa'];
	$precio 		=	$_POST['precio'];
	$detalle 		=	$_POST['detalle'];
	$refvalores		=	$_POST['refvalores'];
	
	echo $serviciosConfiguraciones->insertarTipoVenta($tipoventa,$precio,$detalle,$refvalores);
}

function modificarTipoVenta($serviciosConfiguraciones) {
	$tipoventa 		=	$_POST['tipoventa'];
	$precio 		=	$_POST['precio'];
	$detalle 		=	$_POST['detalle'];
	$refvalores		=	$_POST['refvalores'];
	$id				=	$_POST['id'];
	
	echo $serviciosConfiguraciones->modificarTipoVenta($id,$tipoventa,$precio,$detalle,$refvalores);
}



function crearTablaTurnos($serviciosTurnos) {
	$fecha					=	$_POST['fecha'];
	$resPrimerUltimoTurno	=	$serviciosTurnos->traerPrimerUltimoTurno($fecha);
	
	$sql		=	'<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Horario</th>
                        <th>Cancha 1</th>
                        <th>Cancha 2</th>
                        <th>Cancha 3</th>
                        <th style="padding-left:9%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>';
	for($i=mysql_result($resPrimerUltimoTurno,0,0);$i<=mysql_result($resPrimerUltimoTurno,0,1);$i++) { 
								$idTurno1 = "#";
								$idTurno2 = "#";
								$idTurno3 = "#";

        $sql=$sql.'<tr>
                    <td>'.$i.':00</td>
                    <td>';
  
                            $cancha1 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,1);
                            if (mysql_num_rows($cancha1)>0) {
								
                                $sql=$sql.'<a href="../clientes/modificar.php?id='.mysql_result($cancha1,0,2).'">'.mysql_result($cancha1,0,0).'</a>';
                                
								$idTurno1 =	mysql_result($cancha1,0,1);
                            }

                    $sql=$sql.'</td><td>';
					
                    
                            $cancha2 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,2);
                            if (mysql_num_rows($cancha2)>0) {
                                
								$sql=$sql.'<a href="../clientes/modificar.php?id='.mysql_result($cancha2,0,2).'">'.mysql_result($cancha2,0,0).'</a>';
                                
								$idTurno2 =	mysql_result($cancha2,0,1);	
                            }

                    $sql=$sql.'</td><td>';
      
                            $cancha3 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,3);
                            if (mysql_num_rows($cancha3)>0) {
                                
								$sql=$sql.'<a href="../clientes/modificar.php?id='.mysql_result($cancha3,0,2).'">'.mysql_result($cancha3,0,0).'</a>';
                                
								$idTurno3 =	mysql_result($cancha3,0,1);	
                            }
  
                    $sql=$sql.'</td>
                    <td align="center">
                            <div class="btn-group">
                                <button class="btn btn-success" type="button">Acciones</button>
                                
                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                    <a href="javascript:void(0)" class="varmodificar" id="'.$idTurno1.'">Modificar Cancha 1</a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0)" class="varmodificar" id="'.$idTurno2.'">Modificar Cancha 2</a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0)" class="varmodificar" id="'.$idTurno3.'">Modificar Cancha 3</a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0)" class="varborrar" id="'.$idTurno1.'">Borrar Turno 1</a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0)" class="varborrar" id="'.$idTurno2.'">Borrar Turno 2</a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0)" class="varborrar" id="'.$idTurno3.'">Borrar Turno 3</a>
                                    </li>

                                </ul>
                            </div>
                     </td>
                </tr>';
		}

                $sql=$sql.'</tbody></table><div style="height:50px;">
            
            </div>
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>
			<button type="button" class="btn btn-success imprimir" style="margin-left:0px;">Imprimir</button>';	
				
		echo $sql;
}

function traerPrimerUltimoTurno($serviciosTurnos) {
	$fecha		=	$_POST['fecha'];
	echo $serviciosTurnos->traerPrimerUltimoTurno($fecha);
}


function hayTurnos($serviciosTurnos) {
	$fecha		=	$_POST['fecha'];
	$horario	=	$_POST['horario'];
	$refcancha	=	$_POST['refcancha'];
	
	echo $serviciosTurnos->hayTurnos($fecha,$horario,$refcancha);
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
	$egreso			=	$_POST['egreso'];
	
	//cargo un movimiento en la tabla de movimientos de los productos, para llevar un historial.
	
	
	$res 			= $serviciosProductos->modificarProducto($id,$nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas, $egreso);
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
	$egreso			=	$_POST['egreso'];
	
	$res 			= $serviciosProductos->insertarProducto($nombre, $precio_unit, $precio_venta, $stock, $stock_min, $reftipoproducto, $refproveedor, $codigo, $codigobarra, $caracteristicas, $egreso);
	echo $res;
}

function eliminarProducto($serviciosProductos) {
	$id 			=	$_POST['id'];

	$res 			= $serviciosProductos->eliminarProducto($id);
	echo $res;
}

?>