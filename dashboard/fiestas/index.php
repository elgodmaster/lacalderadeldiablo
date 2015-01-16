<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

date_default_timezone_set('America/Buenos_Aires');

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Fiestas',$_SESSION['rol_se']);


require '../../includes/funcionesFiestas.php';
require '../../includes/funcionesConfiguraciones.php';

$serviciosFiestas = new ServiciosFiestas();
$serviciosConfiguraciones = new ServiciosConfiguraciones();

$resFiestas = $serviciosFiestas->traerFiestas();

$fecha = date('Y-m-d');

$resTipoVenta = $serviciosConfiguraciones->traerTipoVentaValor("Fiestas");
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
		       	

				//alert(new Date($("#dia").val()).getTime());
				
				if (new Date($("#dia").val()).getTime() < new Date('<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>').getTime())
				{
					alert('La fecha no puede ser menor al dia actual.');
					$("#dia").val('');
				}
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
                                	<option value="<?php echo $i.':00:00'; ?>"><?php echo $i.':00'; ?></option>
                                	<option value="<?php echo $i.':30:00'; ?>"><?php echo $i.':30'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-md-3">
                    	<label for="horahasta" class="control-label" style="text-align:left">Hora Hasta</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="horahasta" name="horahasta">
                            	<?php for($i=0;$i<24;$i++) { ?>
                                	<option value="<?php echo $i.':00:00'; ?>"><?php echo $i.':00'; ?></option>
                                	<option value="<?php echo $i.':30:00'; ?>"><?php echo $i.':30'; ?></option>
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
				 
                 <div class="row">
                 	<div class="form-group col-md-6">
                    	<label for="tipoventa" class="control-label" style="text-align:left">Tipo Venta</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="tipoventa" name="tipoventa" tabindex="5">
                                <?php while ($rowTV = mysql_fetch_array($resTipoVenta)) { ?>
                                	<option value="<?php echo $rowTV[0]; ?>"><?php echo utf8_encode($rowTV[1]); ?></option>
                                <?php } ?>
                                
                            </select>
							
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                    	<label for="Pago" class="control-label" style="text-align:left">Pago</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                        	<input type="text" class="form-control" id="saldo" name="saldo" placeholder="Ingrese el Pago..." required>
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                  </div>
                	<input type="hidden" id="accion" name="accion" value="insertarFiesta"/>
                    <input type="hidden" id="usuacrea" name="usuacrea" value="<?php echo $_SESSION['nombre_se']; ?>"/>
                    
                    
                    
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

    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Turnos del día de la fecha: <span id="fechaCambio"><?php echo date('Y-m-d'); ?></span></p>
        </div>
    	<div class="cuerpoBox" id="datos">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Nombre</th>
                        <th>Día</th>
                        <th>Hora Desde</th>
                        <th>Hora Hasta</th>
                        <th>Con Catering</th>
                        <th>Pago</th>
                        <th>Acciones</th>
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
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idfiesta']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idfiesta']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
					 <?php	} ?>
					 	
					 <?php
					 } else {
					 ?>
					 	<td colspan="7">
					 		<h3>No hay fiestas cargadas.</h3>
					 	</td>
					 <?php	
					 }
					 ?>
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>
        </div>
    </div>

</div>

<div id="dialog2" title="Eliminar Fiesta">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar la Fiesta?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>La Fiesta se eliminara definitivamente.</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>


    
    
    
    
    
<script type="text/javascript">
$(document).ready(function(){
        
        
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
	
	
	
	
	$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), 
											usuacrea: '<?php echo $_SESSION['nombre_se']; ?>',
											accion: 'eliminarFiesta'},
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
			
			
			if ($("#nombre").val() == "") {
				$error = "Es obligatorio el campo Nombre.";

				alert($error);
			}
			
			if ($("#dia").val() == "") {
				$error = "Es obligatorio el campo día.";

				alert($error);
			}
			
			if ($("#saldo").val() == "") {
				$error = "Es obligatorio el campo Pago.";

				alert($error);
			}

			if ($("#horadesde").val() == $("#horahasta").val()) {
				$error = "Es las fechas no pueden ser iguales.";

				alert($error);
			}

			if (parseInt($("#horadesde").val().replace(":", "")) > parseInt($("#horahasta").val().replace(":", ""))) {
				$error = "La hora desde no puede ser mayor que la hasta.";

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
