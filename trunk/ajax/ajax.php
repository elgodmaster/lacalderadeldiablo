<?php

include ('../includes/funcionesHTML.php');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesProductos.php');
include ('../includes/funcionesTurnos.php');
include ('../includes/funcionesConfiguraciones.php');
include ('../includes/funcionesVentas.php');

$ServiciosFunciones = new ServiciosHTML();
$serviciosTurnos	= new ServiciosTurnos();
$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosProductos  = new ServiciosProductos();
$serviciosConfiguraciones = new ServiciosConfiguraciones();
$serviciosVentas = new ServiciosVentas();

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
	case 'insertarTurno':
		insertarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones);
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
	case 'modificarTurno':
		modificarTurno($serviciosTurnos);
		break;
	case 'eliminarTurno':
		eliminarTurno($serviciosTurnos);
		break;
	case 'insertarTipoVenta':
		insertarTipoVenta($serviciosConfiguraciones);
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
	case 'insertarDetalle':
		insertarDetalle($serviciosVentas);
		break;
}

function insertarDetalle($serviciosVentas) {
	$id  		= $_POST['id'];
	$producto 	= $_POST['producto'];
	$cantidad 	= $_POST['cantidad'];
	$monto 		= $_POST['monto'];
	$tipoventa  = $_POST['tipoventa'];
	$usuacrea	= $_POST['usuacrea'];
	echo $serviciosVentas->insertarVenta($id,1,$monto,'',0,$usuacrea,'','',$producto,'Venta de Productos');
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
		$cad = $cad.$row[1].'##'.$row[3].'##'.$row[4].'##'.$row[8].'##'.$row[9].'##'.$row[10];
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

	echo $serviciosConfiguraciones->insertarTipoVenta($tipoventa,$precio,$detalle);
}



function eliminarTurno($serviciosTurnos) {
	$id 	=	$_POST['id'];
	echo $serviciosTurnos->eliminarTurno($id);
}


function modificarTurno($serviciosTurnos) {
	$id 				=	$_POST['id'];
	$refcancha			=	$_POST['refcancha'];
	$fechautilizacion	=	$_POST['fechautilizacion'];
	$horautilizacion	=	$_POST['horautilizacion'];
	$refcliente			=	$_POST['refcliente'];
	$fechacreacion		=	'';
	$usuacrea			=	$_POST['usuacrea'];
	echo $serviciosTurnos->modificarTurno($id,$refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea);	
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
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>';	
				
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


function insertarTurno($serviciosTurnos,$serviciosVentas,$serviciosConfiguraciones) {
	$refcancha			=	$_POST['refcancha'];
	$fechautilizacion	=	$_POST['fechautilizacion'];
	$horautilizacion	=	$_POST['horautilizacion'];
	$refcliente			=	$_POST['refcliente'];
	$fechacreacion		=	'';
	$usuacrea			=	$_POST['usuacrea'];


	$res = $serviciosTurnos->insertarTurno($refcancha,$fechautilizacion,$horautilizacion,$refcliente,$fechacreacion,$usuacrea);

	if ($res == '') {
		$cancha = mysql_result($serviciosTurnos->traerCanchasId($refcancha),0,0);
		$monto = mysql_result($serviciosConfiguraciones->traerTipoVentaId(2), 0,2);
		$producto = mysql_result($serviciosConfiguraciones->traerTipoVentaId(2), 0,3);

		$serviciosVentas->insertarVenta('',2,$monto,'',0,$usuacrea,'','',$producto,'Alquiler de '.$cancha);
	}

	echo $res;
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