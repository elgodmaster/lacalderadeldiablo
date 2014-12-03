<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

date_default_timezone_set('America/Buenos_Aires');

require '../../includes/funcionesHTML.php';
require '../../includes/funcionesFiestas.php';

$serviciosFiestas = new ServiciosFiestas();
$serviciosHTML = new ServiciosHTML();

$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Fiestas');

$fecha = date('Y-m-d');

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

    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		td {
			border-left:1px solid #333;
			border-right:1px solid #333;
		}
		#refcliente {
			z-index:999;
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
		
		$("#dia").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
				 $('#fechaCambio').html(textoFecha);
		       
		      }
		 });
      });
	  
	
    </script>
    <style>
			.form-group {
				padding:10px;
			}
			$("#dia").datepicker({
		   showOn: 'both',
		   buttonImage: 'calendar.png',
		   buttonImageOnly: true,
		   changeYear: true,
		   numberOfMonths: 2,
		   onSelect: function(textoFecha, objDatepicker){
		      $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
		   }
		}); 
		</style>
        
        <link rel="stylesheet" href="../../css/chosen.css">
</head>

<body>



 
<?php echo $resMenu; ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">



    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Cargar Fiesta</p>
        </div>
    	<div class="cuerpoBox">
        
        <form class="form-inline formulario" role="form">
                	
                <!--refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea -->
                <div class="row">
                    <div class="form-group col-md-12">
                    	<label for="nombre" class="control-label" style="text-align:left">Nombre del que Alquila</label>
                        <div class="input-group col-md-6">
                        	<input type="text" class="form-control" id="nombre" name="nombre" >
                        </div>
                    </div>
                </div>  
                <div class="row">   
                	<div class="form-group col-md-3">
                    	<label for="fechautilizacion" class="control-label" style="text-align:left">Fecha</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="dia" name="dia" >
                        </div>
                    </div>
                
                 
                    <div class="form-group col-md-3">
                    	<label for="horadesde" class="control-label" style="text-align:left">Hora Desde</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="horadesde" name="horadesde">
                            	<?php for($i=0;$i<24;$i++) { ?>
                                	<option value="<?php echo $i; ?>"><?php echo $i.':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-md-3">
                    	<label for="horahasta" class="control-label" style="text-align:left">Hora Hasta</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="horahasta" name="horahasta">
                            	<?php for($i=0;$i<24;$i++) { ?>
                                	<option value="<?php echo $i; ?>"><?php echo $i.':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                    	<label for="concatering" class="control-label" style="text-align:left">Con Catering</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="concatering" name="concatering">
                                <option value="1">Con Catering</option>
                                <option value="0">Sin catering</option>
                            </select>
                        </div>
                    </div>
                 </div>

                	<input type="hidden" id="accion" name="accion" value="insertarFiesta"/>
                    
                    
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Cargar</button>
                            
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
        	<p style="color: #fff; font-size:18px; height:16px;">Turnos del día de la fecha: <span id="fechaCambio"><?php echo date('Y-m-d'); ?></span></p>
        </div>
    	<div class="cuerpoBox" id="datos">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Horario</th>
                        <th>Cancha 1</th>
                        <th>Cancha 2</th>
                        <th>Cancha 3</th>
                        <th style="padding-left:9%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
					
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>
        </div>
    </div>

</div>

<div id="dialog2" title="Eliminar Turno">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar al Turno?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>El turno se eliminara definitivamente.</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<div id="dialogCliente" title="Crear Cliente">
    	<div class="row"> 
        <div class="col-sm-12 col-md-12">
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


                    </div>
                    </div>
               
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> El campo nombre es obligatorios</p>
                    </div>
                    
</div>
    
    
    
    
    
<script type="text/javascript">
$(document).ready(function(){
	
	
	
	$('#crearcliente').click(function(event){
            $("#dialogCliente").dialog("open");
	});//fin del boton eliminar
        
        
	$('.ver').live("click",function(event){
			url = "ver.php";
			$(location).attr('href',url);
	});//fin del boton eliminar
	
	$('.varborrar').live("click",function(event){
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
	
	$('.varmodificar').live("click",function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	$( "#dialogCliente" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:800,
				height:540,
				modal: true,
				buttons: {
				    "Cargar": function() {
                                            if ($('#nombre').val() != '') {
						$.ajax({
									data:  {nombre: $('#nombre').val(),
											email: $('#email').val(),
											nrodocumento: $('#nrodocumento').val(),
											telefono: $('#telefono').val(),
											accion: 'insertarCliente'},
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
                                                    } else {
                                                        alert("El campo Nombre es obligatorio.");
                                                        
                                                    }
						
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para crear cliente
	
	
	$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarTurno'},
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

	$("#fechautilizacion").click(function(event) {
		$("#fechautilizacion").removeClass("alert-danger");
		$("#fechautilizacion").attr('value','');
		$("#fechautilizacion").attr('placeholder','Ingrese el Fecha Utilizacin...');
    });

	$("#fechautilizacion").change(function(event) {
		$("#fechautilizacion").removeClass("alert-danger");
		$("#fechautilizacion").attr('placeholder','Ingrese el Fecha Utilizacin');
	});
	
	function validaDisponibilidadCancha(cancha,fecha,hora,e) {

		$.ajax({
			data:  {fecha: fecha , 
					horario: hora ,
					refcancha: cancha ,
					accion: 'hayTurnos'},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
				

                if (response!='') {
					$('#fechautilizacion').val('');
					e.stopPropagation();
				}
					
			}
		});

	}
	function validador(){

			$error = "";
			
			
			if ($("#refcliente").chosen().val() == "") {
				$error = "Es obligatorio el campo cliente.";

				alert($error);
			}
			
			if ($("#fechautilizacion").val() == "") {
				$error = "Es obligatorio el campo fecha utilización.";

				alert($error);
			}


			return $error;
    }
	
	$('#fechautilizacion').change(function() {
		$.ajax({
					data:  {fecha: $('#fechautilizacion').val(),
							accion: 'crearTablaTurnos'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />'); 
					},
					success:  function (response) {
						
						$('.cuerpoBox').html(response);
					}
				});
	});
	
	//al enviar el formulario
    $('#cargar').click(function(e){
		e.preventDefault();
		
		
		if (validador() == "") 
        {

				$.ajax({
					data:  {nombre: $('#nombre').val(),
							refcliente: $("#refcliente").chosen().val(),
							refcancha: $('#refcancha').val(),
							horautilizacion: $('#horautilizacion').val(),
							fechautilizacion: $('#fechautilizacion').val(),
							usuacrea:	<?php echo "'".$_SESSION['nombre_se']."'"; ?>,
							accion: 'insertarTurno'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />'); 
					},
					success:  function (response) {
						
						if (response == '') {
							$(".alert").removeClass("alert-danger");
							$(".alert").removeClass("alert-info");
							$(".alert").addClass("alert-success");
							$(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Turno</strong>. ');
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
							$(".alert").removeClass("alert-info");
							$(".alert").removeClass("alert-success");
							$(".alert").addClass("alert-danger");
							$(".alert").html('<strong>Error!</strong>'+response);
							$("#load").html('');
						}
					}
				});
		}
    });

	$('#prueba').click(function(event) {
			alert($("#refcliente").chosen().val());
	});

});//fin del document ready
</script>
<script src="../../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  
<?php } ?>

</body>
</html>
