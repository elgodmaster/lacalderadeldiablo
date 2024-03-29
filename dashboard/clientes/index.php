<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {
	
require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['nombre_se'],"Clientes",$_SESSION['rol_se']);

require '../../includes/funcionesClientes.php';
require '../../includes/funcionesMovimientos.php';
require '../../includes/funcionesVentas.php';

$serviciosClientes = new ServiciosClientes();

$resClientes = $serviciosClientes->traerClientes();



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
        	<p style="color: #fff; font-size:18px; height:16px;">Nuevo Cliente</p>
        </div>
    	<div class="cuerpoBox">
        
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">
                	
<!--idcliente,nombre,nrocliente,email,telefono,nrodocumento-->
                	
				              	
                    <div class="form-group col-md-6">
                    	<label for="nombre" class="control-label" style="text-align:left">Nombre</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre..." required>
                        </div>
                    </div>
                    

                    
                    <div class="form-group col-md-6">
                    	<label for="nrocliente" class="control-label" style="text-align:left">NroCliente</label>
                        <div class="input-group col-md-12">
                            <p class="form-control">El Nro de Cliente se generara automaticamente</p>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="email" class="control-label" style="text-align:left">E-Mail</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="email" name="email" placeholder="Ingrese el E-Mail..." required>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="telefono" class="control-label" style="text-align:left">Telefono</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el Precio Telefono..." required>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="nrodocumento" class="control-label" style="text-align:left">NroDocumento</label>
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control" id="nrodocumento" name="nrodocumento" placeholder="Ingrese el NroDocumento..." required>
                        </div>
                    </div>
					
                    <div class="form-group col-md-6">
                    	<label for="saldo" class="control-label" style="text-align:left">Saldo</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" value="0" id="saldo" name="saldo" placeholder="Ingrese el Saldo..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>

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
                		<p><strong>Importante!:</strong> El campo nombre es obligatorios</p>
                	</div>
                    <input type="hidden" id="accion" name="accion" value="insertarCliente"/>
                    <input id="usuacrea" type="hidden" value="<?php echo $_SESSION['nombre_se']; ?>" name="usuacrea">
                </form>
                
                <br>
                
                
        </div>
    </div>

    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimos 10 Clientes Cargados</p>
        </div>
    	<div class="cuerpoBox">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Nombre</th>
                        <th>NroCliente</th>
                        <th>E-Mail</th>
                        <th>NroDocumento</th>
                        <th>Teléfono</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
<!--idcliente,nombre,nrocliente,email,telefono,nrodocumento-->
                	<?php
						if (mysql_num_rows($resClientes)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resClientes)) {
								$cant+=1;
								if ($cant == 11) {
									break;	
								}
					?>
                    	<tr>
                        	<td><?php echo utf8_encode($row['nombre']); ?></td>
                            <td><?php echo $row['nrocliente']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['nrodocumento']; ?></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['saldo']; ?></td>
                            <td>
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idcliente']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idcliente']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay clientes cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>
        </div>
    </div>

</div>

<div id="dialog2" title="Eliminar Cliente">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar al Cliente?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>También se borrara la relación con las canchas y cuentas asociadas</p>
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
									data:  {id: $('#idEliminar').val(), accion: 'eliminarCliente'},
									url:   '../../ajax/ajax_clientes.php',
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

	$("#nombre").click(function(event) {
		if ($("#nombre").val() == "") {
			$("#nombre").removeClass("alert-danger");
			$("#nombre").attr('value','');
			$("#nombre").attr('placeholder','Ingrese el Nombre...');
		}
    });

	$("#nombre").change(function(event) {
		if ($("#nombre").val() == "") {
			$("#nombre").removeClass("alert-danger");
			$("#nombre").attr('placeholder','Ingrese el Nombre');
		}
	});
	
	$("#codigo").click(function(event) {
		if ($("#codigo").val() == "") {
			$("#codigo").removeClass("alert-danger");
			$("#codigo").attr('value','');
			$("#codigo").attr('placeholder','Ingrese el Codigo...');
		}
    });

	$("#codigo").change(function(event) {
		if ($("#codigo").val() == "") {
			$("#codigo").removeClass("alert-danger");
			$("#codigo").attr('placeholder','Ingrese el Codigo');
		}
	});
	
	$("#precio_unit").click(function(event) {
		if ($("#precio_unit").val() == "") {
			$("#precio_unit").removeClass("alert-danger");
			$("#precio_unit").attr('value','');
			$("#precio_unit").attr('placeholder','Ingrese el Precio Unit...');
		}
    });

	$("#precio_unit").change(function(event) {
		if ($("#precio_unit").val() == "") {
			$("#precio_unit").removeClass("alert-danger");
			$("#precio_unit").attr('placeholder','Ingrese el Precio Unit');
		}
	});
	
	$("#stock").click(function(event) {
		if ($("#stock").val() == "") {
			$("#stock").removeClass("alert-danger");
			$("#stock").attr('value','');
			$("#stock").attr('placeholder','Ingrese el Stock...');
		}
    });

	$("#stock").change(function(event) {
		if ($("#stock").val() == "") {
			$("#stock").removeClass("alert-danger");
			$("#stock").attr('placeholder','Ingrese el Stock');
		}
	});
	
	$("#stock_min").click(function(event) {
		if ($("#stock_min").val() == "") {
			$("#stock_min").removeClass("alert-danger");
			$("#stock_min").attr('value','');
			$("#stock_min").attr('placeholder','Ingrese el Stock Minimo...');
		}
    });

	$("#stock_min").change(function(event) {
		if ($("#stock_min").val() == "") {
			$("#stock_min").removeClass("alert-danger");
			$("#stock_min").attr('placeholder','Ingrese el Stock Minimo');
		}
	});
	
	function validador(){

			$error = "";
//idproducto,nombre,precio_unit,precio_venta,stock,stock_min,reftipoproducto,refproveedor,codigo,codigobarra,caracteristicas
			
			if ($("#nombre").val() == "") {
				$error = "Es obligatorio el campo nombre.";
				$("#nombre").addClass("alert-danger");
				$("#nombre").attr('placeholder',$error);
			}
			
			if ($("#codigo").val() == "") {
				$error = "Es obligatorio el campo codigo.";
				$("#codigo").addClass("alert-danger");
				$("#codigo").attr('placeholder',$error);
			}
			
			if ($("#precio_unit").val() == "") {
				$error = "Es obligatorio el campo Precio Unit.";
				$("#precio_unit").addClass("alert-danger");
				$("#precio_unit").attr('placeholder',$error);
			}
			
			if ($("#stock").val() == "") {
				$error = "Es obligatorio el campo stock.";
				$("#stock").addClass("alert-danger");
				$("#stock").attr('placeholder',$error);
			}
			
			if ($("#stock_min").val() == "") {
				$error = "Es obligatorio el campo stock min.";
				$("#stock_min").addClass("alert-danger");
				$("#stock_min").attr('placeholder',$error);
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
				url: '../../ajax/ajax_clientes.php',  
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
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Cliente</strong>. ');
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
