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
require '../../includes/funcionesImportar.php';

$serviciosConfiguraciones = new ServiciosConfiguraciones();
$serviciosImportar = new ServiciosImportar();



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
</head>

<body>


<?php echo $resMenu; ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">



    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Importar</p>
        </div>
    	<div class="cuerpoBox">
        
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        	<h4 class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> El proceso de importar es sencillo, debera seleccionar al archivo a importar y presionar <strong>Importar</strong></h4>
            <h4 class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Recuerde que primero le deberan enviar el archivo para importar ya que si importa un archivo viejo se perderan datos.</h4>
			<form role="form" class="formulario">
        		<div class="row">
                    <div class="col-md-6">
                        <label class="control-label" for="archivos">Ingrese un nombre a la subida</label>
                        <div class="form-group col-md-12">
                            <input type="file" id="archivo" name="archivo"/>
                        </div>
                    </div>
                </div>
            <ul class="list-inline">
            <input type="hidden" id="accion" name="accion" value="importar">
            	<li><button type="button" class="btn btn-primary btn-lg" id="importar" style="margin-left:0px;">Importar</button></li>
            </ul>
            
            <div class="load"></div>
            <h4>Resultado: <span id="resultado"></span></h4>
            </form>    
                
        </div>
    </div>
 

</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#importar').click(function(event) {
		var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../imagenes/load13.gif" width="50" height="50" />');
       
				},
				//una vez finalizado correctamente
				success: function(data){
					
					$('#resultado').html(data);
					$("#load").html('');
				},
				//si ha ocurrido un error
				error: function(){
					$('.cuerpoBox2').prepend('Error');
				}
			});//fin del ajax
		
		
	
	});

});
</script>


<?php } ?>

</body>
</html>
