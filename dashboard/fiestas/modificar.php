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
require '../../includes/funcionesVentas.php';
require '../../includes/funcionesConfiguraciones.php';

$serviciosFiestas = new ServiciosFiestas();
$serviciosVentas = new ServiciosVentas();
$serviciosConfiguraciones = new ServiciosConfiguraciones();

$id = $_GET['id'];

$fecha = date('Y-m-d');

$resFiestas = $serviciosFiestas->traerFiestasId($id);

$resTipoVenta = $serviciosConfiguraciones->traerTipoVentaValor("Fiestas");

$mov		= $serviciosVentas->traerIdVenta($id,'Fiestas');
$idtipoventa	= mysql_result($mov,0,1);
//echo $idtipoventa;
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
      	
		$("#fechautilizacion").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
				 $('#fechaCambio').html(textoFecha);
				 
		         $.ajax({
					data:  {fecha: textoFecha,
							accion: 'crearTablaTurnos'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />'); 
					},
					success:  function (response) {
						
						$('#datos').html(response);
						$("#load").html('');
					}
				});
				
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
			$("#fechautilizacion").datepicker({
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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar Fiesta</p>
        </div>
    	<div class="cuerpoBox">
        <form class="form-inline formulario" role="form">
                	
                <!--refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea -->
                <div class="row">
                    <div class="form-group col-md-12">
                    	<label for="nombre" class="control-label" style="text-align:left">Nombre del que Alquila</label>
                        <div class="input-group col-md-6">
                        	<input type="text" class="form-control" value="<?php echo mysql_result($resFiestas,0,'nombre'); ?>" id="nombre" name="nombre" >
                        </div>
                    </div>
                </div>  
                <div class="row">   
                	<div class="form-group col-md-3">
                    	<label for="fechautilizacion" class="control-label" style="text-align:left">Fecha</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="dia" name="dia" value="<?php echo mysql_result($resFiestas,0,'dia'); ?>">
                        </div>
                    </div>
                
                 
                    <div class="form-group col-md-3">
                    	<label for="horadesde" class="control-label" style="text-align:left">Hora Desde</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="horadesde" name="horadesde">
                            	<?php for($i=0;$i<24;$i++) { ?>
                            		<?php if (mysql_result($resFiestas,0,'horadesde')== substr('0'.$i,-2).':00:00') { ?>
                                		<option value="<?php echo $i.':00:00'; ?>"  selected><?php echo $i.':00'; ?></option>
                                	<?php } else { ?>
                                		<option value="<?php echo $i.':00:00'; ?>"><?php echo $i.':00'; ?></option>
                                	<?php } ?>
                                	<?php if (mysql_result($resFiestas,0,'horadesde')== substr('0'.$i,-2).':30:00') { ?>
                                		<option value="<?php echo $i.':30:00'; ?>"  selected><?php echo $i.':30'; ?></option>
                                	<?php } else { ?>
                                		<option value="<?php echo $i.':30:00'; ?>"><?php echo $i.':30'; ?></option>
                                	<?php } ?>
                                	
                                <?php } ?>
                                
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-md-3">
                    	<label for="horahasta" class="control-label" style="text-align:left">Hora Hasta</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="horahasta" name="horahasta">
                            	<?php for($i=0;$i<24;$i++) { ?>
                                	<?php for($i=0;$i<24;$i++) { ?>
                            		<?php if (mysql_result($resFiestas,0,'horahasta')== substr('0'.$i,-2).':00:00') { ?>
                                		<option value="<?php echo $i.':00:00'; ?>"  selected><?php echo $i.':00'; ?></option>
                                	<?php } else { ?>
                                		<option value="<?php echo $i.':00:00'; ?>"><?php echo $i.':00'; ?></option>
                                	<?php } ?>
                                	<?php if (mysql_result($resFiestas,0,'horahasta')== substr('0'.$i,-2).':30:00') { ?>
                                		<option value="<?php echo $i.':30:00'; ?>"  selected><?php echo $i.':30'; ?></option>
                                	<?php } else { ?>
                                		<option value="<?php echo $i.':30:00'; ?>"><?php echo $i.':30'; ?></option>
                                	<?php } ?>
                                	
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                    	<label for="concatering" class="control-label" style="text-align:left">Con Catering</label>
                        <div class="input-group col-md-12">
                        	<select class="form-control" id="concatering" name="concatering">
                        		<?php if (mysql_result($resFiestas,0,'concatering')== 1) { ?>
                            		<option value="1" selected>Con Catering</option>
                            	<?php } else { ?>
                            		<option value="0" selected>Sin catering</option>
                            	<?php } ?>

                            </select>
                        </div>
                    </div>
                 </div>
				
                <div class="row">
                <div class="form-group col-md-6">
                    <label for="tipoventa" class="control-label" style="text-align:left">Tipo Venta</label>
                    <div class=" col-md-12">
                        <select class="form-control" id="tipoventa" name="tipoventa" tabindex="5">
                            <?php while ($rowTV = mysql_fetch_array($resTipoVenta)) { 
                                    if ($rowTV[0] == $idtipoventa) { ?>
                                        <option value="<?php echo $rowTV[0]; ?>" selected><?php echo utf8_encode($rowTV[1]); ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $rowTV[0]; ?>"><?php echo utf8_encode($rowTV[1]); ?></option>
                                    <?php } ?>            
                            <?php } ?>
                            
                        </select>
                        
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="Pago" class="control-label" style="text-align:left">Pago</label>
                    <div class="input-group col-md-12">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="form-control" id="saldo" value="<?php echo mysql_result($resFiestas,0,'saldo'); ?>" name="saldo" placeholder="Ingrese el Pago..." required>
                        <span class="input-group-addon">.00</span>
                    </div>
                </div>
                </div>
                
                
                	<input type="hidden" id="usuacrea" name="usuacrea" value="<?php echo $_SESSION['nombre_se']; ?>"/>
                	<input type="hidden" id="accion" name="accion" value="modificarFiesta"/>
                    <input type="hidden" id="id" name="id" value="<?php echo mysql_result($resFiestas,0,0); ?>"/>
                    
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="modificar" style="margin-left:0px;">Modificar</button>
                            
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
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> Todos los campos son obligatorios</p>
                	</div>
                    
                </form>
                
                <br>
                
        </div>
    </div>

    
    

</div>

<div id="dialog2" title="Eliminar Fiesta">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar la Fiesta?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>La fiesta se perdera.</p>
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
				url = "index.php";
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
									data:  {id: <?php echo $id; ?>, 
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
		$("#fechautilizacion").attr('placeholder','Ingrese el Fecha Utilizaci�n...');
    });

	$("#fechautilizacion").change(function(event) {
		$("#fechautilizacion").removeClass("alert-danger");
		$("#fechautilizacion").attr('placeholder','Ingrese el Fecha Utilizaci�n');
	});
	
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
	
	//al enviar el formulario
    $('#modificar').click(function(){
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
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente la <strong>Fiesta</strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											//url = "index.php";
											//$(location).attr('href',url);
                                            
											
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
