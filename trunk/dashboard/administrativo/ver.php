<?php

session_start();

if ((!isset($_SESSION['usua_se'])) || ($_SESSION['rol_se']!= 'SuperAdministrador'))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Productos',$_SESSION['rol_se']);

require '../../includes/funcionesProductos.php';


$serviciosProductos = new ServiciosProductos();

$resProductos = $serviciosProductos->traerProductos();

?>


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestión de Cancha: La Caldera del Diablo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    
    <script src="../../js/jquery-ui.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		
		
	</style>
    
<script src="../../js/dashboard.js"></script>
   	  <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>



 
 <?php echo $resMenu; ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">

	
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ingresos Cargados</p>
        </div>
    	<div class="cuerpoBox">
        <button type="button" class="btn btn-primary nuevo" style="margin-left:0px;">Nuevo Ingreso</button>
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Cancha</th>
                        <th>Bar</th>
                        <th>Sueldo</th>
                        <th>Gastos Varios</th>
                        <th>Mercaderia</th>
                        <th>Gas</th>
                        <th>Luz</th>
                        <th>T.E</th>
                        <th>Agua</th>
                        <th>Inmobiliario</th>
                        <th>Impuestos Varios</th>
                        <th>Autonomos</th>
                        <th>Ingresos Brutos</th>
                        <th>Aportes</th>
                        <th>Municipal</th>

                    </tr>
                </thead>
                <tbody>


<!--cancha, bar, sueldo, gastosVarios, mercaderia, gas, luz, T.E , agua, inmobiliario, impVarios, autonomos, ingresosBrutos, aportes, municipal -->


                	<?php
						if (mysql_num_rows($resProductos)>0) {
							while ($row = mysql_fetch_array($resProductos)) {
					?>
                    	<tr>
                        	<td><?php echo $row['cancha']; ?></td>
                            <td><?php echo $row['bar']; ?></td>
                            <td><?php echo $row['sueldo']; ?></td>
                            <td><?php echo $row['gastosVarios']; ?></td>
                            <td><?php echo $row['mercaderia']; ?></td>
                            <td><?php echo $row['gas']; ?></td>
                            <td><?php echo $row['luz']; ?></td>
							<td><?php echo $row['T.E']; ?></td>
                            <td><?php echo $row['agua']; ?></td>
                            <td><?php echo $row['inmobiliario']; ?></td>
                            <td><?php echo $row['impVarios']; ?></td>
                            <td><?php echo $row['autonomos']; ?></td>
                            <td><?php echo $row['ingresosBrutos']; ?></td>
                            <td><?php echo $row['aportes']; ?></td>
                            <td><?php echo $row['municipal']; ?></td>
                            <td>
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idproducto']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idproducto']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay ingresos cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
            
        </div>
    </div>

</div>




<?php } ?>

	
	
</body>
</html>
