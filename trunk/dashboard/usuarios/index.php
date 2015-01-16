<?php

session_start();

if ((!isset($_SESSION['usua_se'])) || ($_SESSION['rol_se']!= 'SuperAdmin'))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Usuarios',$_SESSION['rol_se']);

require '../../includes/funcionesUsuarios.php';


$serviciosUsuarios = new ServiciosUsuarios();

$resUsuarios = $serviciosUsuarios->traerUsuarios();

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
        	<p style="color: #fff; font-size:18px; height:16px;">Cargar Usuario</p>
        </div>
    	<div class="cuerpoBox">
        
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">
                	
                	
				              	
                    <?php echo $serviciosUsuarios->camposTabla('insertarUsuario'); ?>

                    </div>
                    </div>
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Crear</button>
                        </li>
                        
   
                    </ul>
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> Todos los campos son obligatorios</p>
                	</div>
                </form>
                
                <br>
                
                
        </div>
    </div>

    
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimos 10 Proveedores Cargados</p>
        </div>
    	<div class="cuerpoBox">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Usuarios</th>
                        <th>Password</th>
                        <th>Rol</th>
                        <th>Email</th>
                        <th>NombreCompleto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <!--proveedor,direccion, telefono, cuit, nombre, email -->
                	<?php
						if (mysql_num_rows($resUsuarios)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resUsuarios)) {
								$cant+=1;
								if ($cant == 11) {
									break;	
								}
					?>
                    	<tr>
                        	<td><?php echo utf8_encode($row['usuario']); ?></td>
                            <td><?php echo utf8_encode($row['password']); ?></td>
                            <td><?php echo utf8_encode($row['refroll']); ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo utf8_encode($row['nombrecompleto']); ?></td>
                            <td>
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idusuario']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idusuario']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay usuarios cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>
        </div>
    </div>

</div>

<div id="dialog2" title="Eliminar Proveedor">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar al Usuario?.<span id="proveedorEli"></span>
        </p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.ver').click(function(event){
			url = "ver.php";
			$(location).attr('href',url);
	});//fin del boton eliminar
	
	$('.varborrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$('.varmodificar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar

	$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarUsuario'},
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

	$("#usuario").click(function(event) {
		$("#usuario").removeClass("alert-danger");
		if ($(this).val() != '') {
			$("#usuario").attr('value','');
			$("#usuario").attr('placeholder','Ingrese el Usuario...');
		}
    });

	$("#usuario").change(function(event) {
		$("#usuario").removeClass("alert-danger");
		$("#usuario").attr('placeholder','Ingrese el Usuario');
	});
	
	
	$("#password").click(function(event) {
		$("#password").removeClass("alert-danger");
		if ($(this).val() != '') {
			$("#password").attr('value','');
			$("#password").attr('placeholder','Ingrese el Password...');
		}
    });

	$("#password").change(function(event) {
		$("#password").removeClass("alert-danger");
		$("#password").attr('placeholder','Ingrese el Password');
	});
	
	$("#email").click(function(event) {
		$("#email").removeClass("alert-danger");
		if ($(this).val() != '') {
			$("#email").attr('value','');
			$("#email").attr('placeholder','Ingrese el Email...');
		}
    });

	$("#email").change(function(event) {
		$("#email").removeClass("alert-danger");
		$("#email").attr('placeholder','Ingrese el Email');
	});
	
	$("#nombrecompleto").click(function(event) {
		$("#nombrecompleto").removeClass("alert-danger");
		if ($(this).val() != '') {
			$("#nombrecompleto").attr('value','');
			$("#nombrecompleto").attr('placeholder','Ingrese el Nombre Completo...');
		}
    });

	$("#nombrecompleto").change(function(event) {
		$("#nombrecompleto").removeClass("alert-danger");
		$("#nombrecompleto").attr('placeholder','Ingrese el Nombre Completo');
	});
	
	
	
	function validador(){

			$error = "";

			
			if ($("#usuario").val() == "") {
				$error = "Es obligatorio el campo Usuario.";
				$("#usuario").addClass("alert-danger");
				$("#usuario").attr('placeholder',$error);
			}
			
			if ($("#password").val() == "") {
				$error = "Es obligatorio el campo Password.";
				$("#password").addClass("alert-danger");
				$("#password").attr('placeholder',$error);
			}
			
			if ($("#email").val() == "") {
				$error = "Es obligatorio el campo Email.";
				$("#email").addClass("alert-danger");
				$("#email").attr('placeholder',$error);
			}
			
			if ($("#nombrecompleto").val() == "") {
				$error = "Es obligatorio el campo Nombre Completo.";
				$("#nombrecompleto").addClass("alert-danger");
				$("#nombrecompleto").attr('placeholder',$error);
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

					if (data == '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Usuario</strong>. ');
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
