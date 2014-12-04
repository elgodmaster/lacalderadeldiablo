<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Proveedores',$_SESSION['rol_se']);

require '../../includes/funcionesProductos.php';


$serviciosProductos = new ServiciosProductos();

$id = $_GET['id'];

$resProveedores = $serviciosProductos->traerProveedoresPorId($id);;

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
        	<p style="color: #fff; font-size:18px; height:16px;">Nuevo Proveedor</p>
        </div>
    	<div class="cuerpoBox">
        <form class="form-horizontal" role="form">
                	
                <!--proveedor,direccion, telefono, cuit, nombre -->
                
                	<div class="form-group">
                    	<label for="proveedor" class="col-lg-3 control-label" style="text-align:left">Proveedor</label>
                        <div class="col-lg-5">
                        	<input type="text" value="<?php echo mysql_result($resProveedores,0,'proveedor'); ?>" class="form-control" id="proveedor" name="proveedor" placeholder="Ingrese el Proveedor..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="direccion" class="col-lg-3 control-label" style="text-align:left">Dirección</label>
                        <div class="col-lg-5">
                        	<input type="text" value="<?php echo mysql_result($resProveedores,0,'direccion'); ?>" class="form-control" id="direccion" name="direccion" placeholder="Ingrese el Dirección..." required>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                    	<label for="nombre" class="col-lg-3 control-label" style="text-align:left">Nombre</label>
                        <div class="col-lg-5">
                        	<input type="text" value="<?php echo mysql_result($resProveedores,0,'nombre'); ?>" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="telefono" class="col-lg-3 control-label" style="text-align:left">Teléfono</label>
                        <div class="col-lg-5">
                        	<input type="text" value="<?php echo mysql_result($resProveedores,0,'telefono'); ?>" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el Teléfono..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="cuit" class="col-lg-3 control-label" style="text-align:left">Cuit</label>
                        <div class="col-lg-5">
                        	<input type="text" value="<?php echo mysql_result($resProveedores,0,'cuit'); ?>" class="form-control" id="cuit" name="cuit" placeholder="Ingrese el Cuit..." required>
                        </div>
                    </div>
                    
                    
                	<div class="form-group">
                    	<label for="eamil" class="col-lg-3 control-label" style="text-align:left">E-Mail</label>
                        <div class="col-lg-5">
                        	<input type="email" value="<?php echo mysql_result($resProveedores,0,'email'); ?>" class="form-control" id="email" name="email" placeholder="Ingrese el E-Mail..." required>
                        </div>
                    </div>
                
                    
                    
                    <ul class="list-inline">
                    	<li>
                    		<button type="button" class="btn btn-warning" id="modificar" style="margin-left:0px;">Modificar</button>
                        </li>
                        <li>
                        	<button type="button" class="btn btn-danger varborrar" id="<?php echo $id; ?>" style="margin-left:0px;">Eliminar</button>
                        </li>
                        <li>
 							<button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>                       
                        </li>
   
                    </ul>
                    <div id="load">
                    
                    </div>
                    <div class="alert">
                    
                    </div>
                    <input type="hidden" id="accion" name="accion" value="modificarProveedores"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                </form>
                
                <br>
                <div id="error">
                
                </div>
        </div>
    </div>

    
    

</div>

<div id="dialog2" title="Eliminar Proveedor">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar al Proveedor?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>También se borrara la relación con los productos asociados</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.varborrar').click(function(event){
			  usersid =  $(this).attr("id");
			  if (!isNaN(usersid)) {
				$("#idEliminar").val(usersid);
				$("#dialog2").dialog("open");
				
			  } else {
				alert("Error, vuelva a realizar la acción.");	
			  }
	});//fin del boton eliminar
	
	$('.volver').click(function(event){
				url = "../proveedores/index.php";
				$(location).attr('href',url);
	});//fin del boton eliminar

	$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarProveedores'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar

	$("#proveedor").click(function(event) {
		$("#proveedor").removeClass("alert-danger");
		$("#proveedor").attr('value','');
		$("#proveedor").attr('placeholder','Ingrese el Proveedor...');
    });

	$("#proveedor").change(function(event) {
		$("#proveedor").removeClass("alert-danger");
		$("#proveedor").attr('placeholder','Ingrese el Proveedor');
	});
	
	function validador(){

			$error = "";

			
			if ($("#proveedor").val() == "") {
				$error = "Es obligatorio el campo proveedor.";
				$("#proveedor").addClass("alert-danger");
				$("#proveedor").attr('placeholder',$error);
			}


			return $error;
    }
	
	//al enviar el formulario
    $('#cargar').click(function(){
		if (validador() == "")
        {
			//información del formulario
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
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){

					if (data != '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Proveedor</strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "index.php";
											$(location).attr('href',url);
                                            
											
                                        } else {
                                        	$(".alert").removeClass("alert-danger");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+data);
                                            $("#load").html('');
                                        }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
				}
			});
		}
    });

});//fin del document ready
</script>
<?php } ?>
</body>
</html>
