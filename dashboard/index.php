<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Dashboard',$_SESSION['rol_se']);

require '../includes/funcionesProductos.php';
require '../includes/funcionesClientes.php';
require '../includes/funcionesTurnos.php';
require '../includes/funcionesFiestas.php';
require '../includes/funcionesVentas.php';

$serviciosProductos = new ServiciosProductos();
$serviciosClientes = new ServiciosClientes();
$serviciosTurnos = new ServiciosTurnos();
$serviciosVentas = new ServiciosVentas();
$serviciosFiestas = new ServiciosFiestas();

$resProductos = $serviciosProductos->traerProductosLimite(5);

$resProveedores = $serviciosProductos->traerProveedores();

$resTipoProducto = $serviciosProductos->traerTipoProducto();

$resClientes = $serviciosClientes->traerClientes();

$cantClientes = mysql_num_rows($resClientes);

$fecha = date('Y-m-d');

$resTurnos = $serviciosTurnos->traerTurnosPorDia($fecha);

$cantTurnos = mysql_num_rows($resTurnos);

$resPrimerUltimoTurno = $serviciosTurnos->traerPrimerUltimoTurno(date('Y-m-d'));

$resTurnosAgrup = $serviciosTurnos->traerTurnosPorDiaAgrupado($fecha);

$cantFiestas = mysql_num_rows($serviciosFiestas->traerFiestasPost($fecha));

$resFiestas = $serviciosFiestas->traerFiestasPost($fecha);

$resVentas = $serviciosVentas->traerVenta();

$cantVentas = mysql_num_rows($serviciosVentas->traerVenta());

$stockminimo = $serviciosProductos->traerProductosStockMin();

?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestión de Cancha: La Caldera del Diablo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
        
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		
  
		
	</style>
    
<script src="../js/dashboard.js"></script>
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>


 <?php echo str_replace('..','/lacalderadeldiablo/dashboard',$resMenu); ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">

<?php if (mysql_num_rows($stockminimo)>0) { ?>
<div id="alertasstock">
	<?php while ($rowStock = mysql_fetch_array($stockminimo)) { ?>
    	<p>El producto <a href="productos/modificar.php?id=<? echo $rowStock['idproducto']; ?>"><? echo $rowStock['nombre']; ?></a> esta por debajo del stock minimo <? echo $rowStock['stock_min']; ?></p>
	<?php } ?>
</div>
<?php } ?>

<div align="center" style="margin-left:-240px;">
	<table border="0" cellpadding="0" cellspacing="0" width="600">
    	<tr>
        	<td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/clock4.png" width="50" height="50" style="float:left;">
                <p style="color:#F00; font-size:18px; height:16px;"><?php echo $cantTurnos; ?></p>
                <p style="height:16px;">Turnos</p>
            </td>
            <td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/shopping145.png" width="50" height="50" style="float:left;">
                <p style="color:#0CF; font-size:18px; height:16px;"><?php echo $cantVentas; ?></p>
                <p style="height:16px;">Ventas</p>
            </td>
            <td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/icon_19476.png" width="50" height="50" style="float:left;">
                <p style="color: #30F; font-size:18px; height:16px;"><?php echo $cantClientes; ?></p>
                <p style="height:16px;">Clientes</p>
            </td>
        	<td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/five.png" width="50" height="50" style="float:left;">
                <p style="color: #090; font-size:18px; height:16px;"><?php echo $cantFiestas; ?></p>
                <p style="height:16px;">Fiestas</p>
            </td>
        </tr>
    
    </table>
</div>

    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Proximos 5 Turnos 
        		<button type="button" class="btn btn-default btn-xs nuevoTurno">
  <span class="glyphicon glyphicon-plus-sign"><span style="padding-left:3px;">Nuevo</span></button></p>
        	
        </div>
    	<div class="cuerpoBox">
    		<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Horario</th>
                        <th>Cancha 1</th>
                        <th>Cancha 2</th>
                        <th>Cancha 3</th>
                    </tr>
                </thead>
                <tbody>
						<?php
						if (mysql_num_rows($resTurnosAgrup)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resTurnosAgrup)) {
								$cant+=1;
								if ($cant == 6) {
									break;	
								}
					?>
                    	<tr>
                        	<td><?php echo $row['horautilizacion']; ?></td>
                            <td><a href="turnos/modificar.php?id=<?php echo $row['turno1']; ?>"><?php echo $row['Cancha1']; ?></a></td>
                            <td><a href="turnos/modificar.php?id=<?php echo $row['turno2']; ?>"><?php echo $row['Cancha2']; ?></a></td>
                            <td><a href="turnos/modificar.php?id=<?php echo $row['turno3']; ?>"><?php echo $row['Cancha3']; ?></a></td>


                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay turnos cargados.</h3>
                    <?php } ?>

                </tbody>
            </table>
    	</div>
    </div>
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimas 10 Ventas  <button type="button" class="btn btn-default btn-xs nuevoVentas">
  <span class="glyphicon glyphicon-plus-sign"><span style="padding-left:3px;">Nuevo</span></button></p>
        </div>
    	<div class="cuerpoBox">
			<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Detalle</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
<!--idproducto,nombre,precio_unit,precio_venta,stock,stock_min,reftipoproducto,refproveedor,codigo,codigobarra,caracteristicas -->
                	<?php
						if (mysql_num_rows($resVentas)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resVentas)) {
								$cant+=1;
								if ($cant == 11) {
									break;	
								}
					?>
                    	<tr>
                        	<td><?php echo utf8_encode($row['detalle']); ?></td>
							<td><?php echo utf8_encode($row['nombre']); ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td><?php echo $row['importe']; ?></td>

                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay ventas cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
    	</div>
    </div>
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimos 5 Productos Cargados  <button type="button" class="btn btn-default btn-xs nuevoProducto">
  <span class="glyphicon glyphicon-plus-sign"><span style="padding-left:3px;">Nuevo</span></button></p>
        </div>
    	<div class="cuerpoBox">
    		<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Nombre</th>
                        <th>Precio Unit</th>
                        <th>Precio Vent</th>
                        <th>Stock</th>
                        <th>Stock min</th>
                        <th>Tipo Prod.</th>
                        <th>Proveedor</th>
                        <th>Codigo</th>
                        <th>CodigoBarra</th>
                        <th>Caract.</th>
                    </tr>
                </thead>
                <tbody>
<!--idproducto,nombre,precio_unit,precio_venta,stock,stock_min,reftipoproducto,refproveedor,codigo,codigobarra,caracteristicas -->
                	<?php
						if (mysql_num_rows($resProductos)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resProductos)) {
								$cant+=1;
								if ($cant == 6) {
									break;	
								}
					?>
                    	<tr>
                        	<td><?php echo utf8_encode($row['nombre']); ?></td>
                            <td><?php echo $row['precio_unit']; ?></td>
                            <td><?php echo $row['precio_venta']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td><?php echo $row['stock_min']; ?></td>
                            <td><?php echo utf8_encode($row['tipoproducto']); ?></td>
                            <td><?php echo utf8_encode($row['proveedor']); ?></td>
							<td><?php echo utf8_encode($row['codigo']); ?></td>
                            <td><?php echo $row['codigobarra']; ?></td>
                            <td><?php echo utf8_encode($row['caracteristicas']); ?></td>

                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay productos cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
    	</div>
    </div>
    
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Fiestas Proximas <button type="button" class="btn btn-default btn-xs nuevoFiesta">
  <span class="glyphicon glyphicon-plus-sign"><span style="padding-left:3px;">Nuevo</span></button></p>
        </div>
    	<div class="cuerpoBox">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Día</th>
                        <th>Hora Desde</th>
                        <th>Hora Hasta</th>
                        <th>Con Catering</th>
                        <th style="padding-left:9%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     <?php if (mysql_num_rows($resFiestas)>0) {

                        while ($row = mysql_fetch_array($resFiestas)) {
                     ?>
                     <tr>
                        <td><?php echo utf8_encode($row['nombre']); ?></td>
                        <td><?php echo $row['dia']; ?></td>
                        <td><?php echo $row['horadesde']; ?></td>
                        <td><?php echo $row['horahasta']; ?></td>
                        <td><?php if ($row['concatering'] == 1)
                                    echo 'Con catering';
                                    else
                                    echo 'Sin Catering'; ?></td>
                        <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success" type="button">Acciones</button>
                                        
                                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                            <a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idfiesta']; ?>">Modificar</a>
                                            </li>

                                            <li>
                                            <a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idfiesta']; ?>">Borrar</a>
                                            </li>

                                        </ul>
                                    </div>
                             </td>
                        </tr>
                     <?php  } ?>
                        
                     <?php
                     } else {
                     ?>
                        <td colspan="6">
                            <h3>No hay fiestas cargadas.</h3>
                        </td>
                     <?php  
                     }
                     ?>
                </tbody>
            </table>
    	</div>
    </div>

</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.nuevoTurno').click(function(event){
			url = "turnos/";
			$(location).attr('href',url);
	});//fin del boton nuevo
  
  $('.nuevoVentas').click(function(event){
			url = "ventas/";
			$(location).attr('href',url);
	});//fin del boton nuevo
	
	$('.nuevoProducto').click(function(event){
			url = "productos/";
			$(location).attr('href',url);
	});//fin del boton nuevo
	
	$('.nuevoFiesta').click(function(event){
			url = "fiestas/";
			$(location).attr('href',url);
	});//fin del boton nuevo
});
</script>
<?php } ?>
</body>
</html>
