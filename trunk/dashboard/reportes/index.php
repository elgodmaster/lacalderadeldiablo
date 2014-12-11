<?php
session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Reportes',$_SESSION['rol_se']);

require '../../includes/funcionesProductos.php';


$serviciosProductos = new ServiciosProductos();

$resTipoProducto = $serviciosProductos->traerTipoProducto();


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
		.form-group {
			padding:10px;
		}
		
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
        	<p style="color: #fff; font-size:18px; height:16px;">Listados de Reportes</p>
        </div>
    	<div class="cuerpoBox">
     		
            <ul style="margin-left:50px; font-size:22px; font-weight:bold;padding:10px;">
            	<li style="padding-bottom:8px;"><span class="glyphicon glyphicon-floppy-save"> </span> <a href="../../reportes/rptcajadiaria.php">Caja Diaria</a></li>
                <li style="padding-bottom:8px;"><span class="glyphicon glyphicon-floppy-save"> </span> <a href="../../reportes/rptmensual.php">Reporte Mensual</a></li>
                <li style="padding-bottom:8px;"><span class="glyphicon glyphicon-floppy-save"> </span> <a href="../../reportes/rptanual.php">Reporte Anual</a></li>
            </ul>
            
            
        </div>
        
    </div>


</div><!-- fin del div infoGral -->


<?php } ?>

</body>
</html>