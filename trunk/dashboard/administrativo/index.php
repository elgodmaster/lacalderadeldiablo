<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Productos',$_SESSION['rol_se']);


require '../../includes/funcionesProductos.php';


$serviciosProductos = new ServiciosProductos();

$resProductos = $serviciosProductos->traerProductos();

$resProveedores = $serviciosProductos->traerProveedores();

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
        	<p style="color: #fff; font-size:18px; height:16px;">Administrativo</p>
        </div>
    	<div class="cuerpoBox">
        
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">
                	
<!--cancha, bar, sueldo, gastos varios, mercaderia, gas, luz, T.E , agua, inmobiliario, imp. varios, autonomos, ingresos brutos, aportes, municipal -->
                	
				              	
                	<div class="form-group col-md-6">
                    	<label for="cancha" class="control-label" style="text-align:left">Cancha</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="cancha" name="cancha" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div id="errorCodigo" class="col-md-3" style="margin-top:40px;">
                            
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="bar" class="control-label" style="text-align:left">Bar</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="bar" name="bar" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="sueldo" class="control-label" style="text-align:left">Sueldo</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="sueldo" name="sueldo" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="gastosVarios" class="control-label" style="text-align:left">Gastos Varios</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="gastosVarios" name="gastosVarios" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="mercaderia" class="control-label" style="text-align:left">Mercaderia</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                        	<input type="text" class="form-control" id="mercaderia" name="mercaderia" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="gas" class="control-label" style="text-align:left">Gas</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="gas" name="gas" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="luz" class="control-label" style="text-align:left">Luz</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="luz" name="luz" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="T.E" class="control-label" style="text-align:left">T.E</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="T.E" name="T.E" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="agua" class="control-label" style="text-align:left">Agua</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="agua" name="agua" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="inmobiliario" class="control-label" style="text-align:left">Inmobiliario</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="inmobiliario" name="inmobiliario" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="impVarios" class="control-label" style="text-align:left">Impuestos Varios</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="impVarios" name="impVarios" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="autonomos" class="control-label" style="text-align:left">Autonomos</label>
                        <div class="input-group col-md-12">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="autonomos" name="autonomos" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="ingresos brutos" class="control-label" style="text-align:left">Ingresos Brutos</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="ingresos brutos" name="ingresos brutos" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="aportes" class="control-label" style="text-align:left">Aportes</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="aportes" name="aportes" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="municipal" class="control-label" style="text-align:left">Municipal</label>
                        <div class="input-group col-md-12">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="municipal" name="municipal" placeholder="Ingrese un monto..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                
                
                    </div>
                    </div>
                    
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Cargar</button>
                        </li>

   
                    </ul>
                    <div id="load">
                    
                    </div>
                    
                   
                </form>
                
                <br>
                
                
        </div>
    </div>






</script>

<?php } ?>

</body>
</html>
