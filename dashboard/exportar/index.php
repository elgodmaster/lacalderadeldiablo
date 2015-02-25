<?php

session_start();

if ((!isset($_SESSION['usua_se'])) || ($_SESSION['rol_se']!= 'SuperAdmin'))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {
	
require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['nombre_se'],"Configuraciones",$_SESSION['rol_se']);

require '../../includes/funcionesConfiguraciones.php';
require '../../includes/funcionesExportar.php';

$serviciosConfiguraciones = new ServiciosConfiguraciones();
$serviciosExportar = new ServiciosExportar();



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
    
    <script src="../../js/dashboard.js">
		
	</script>
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
    <style type="text/css">
		.form-group {
			padding:10px;
		}
		h4 {
			padding:12px;
			text-align:justify;
			line-height:30px;
		}
	</style>
</head>

<body>


<?php echo $resMenu; ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">



    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Exportar</p>
        </div>
    	<div class="cuerpoBox">
        
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        	<h4 class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> El proceso de exportar es sencillo, al hacer click sobre el boton <strong>"Exportar"</strong> se creara un archivo en el directorio c:/ de su PC con el nombre "Exportar año-mes-dia hora minutos segundos"</h4>
            <h4 class="alert alert-success"><span class="glyphicon glyphicon-certificate"></span> Ejemplo: <strong>Exportar2015-02-25040320</strong> donde el archivo fue exportado el año: 2015, mes:2, dia:25 hora:04,minutos:03,segundos:20 .</h4>
            
               <?php //echo $serviciosExportar->ExportarWeb(); ?>
        	<button type="button" class="btn btn-primary btn-lg" id="exportar" style="margin-left:0px;">Exportar</button>
            <div class="load"></div>
            <h4>Resultado: <span id="resultado"></span></h4>
        </div>
    </div>
 

</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#exportar').click(function(event) {
		$.ajax({
			data:  {donde:	'<?php echo $_SERVER['SERVER_NAME']; ?>',
					accion:	'exportarweb'},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					$("#load").html('<img src="../imagenes/load13.gif" width="50" height="50" />');
			},
			success:  function (response) {
				$('#resultado').html(response);
				$("#load").html('');
			}
		});
	
	});

});
</script>

<?php } ?>

</body>
</html>
