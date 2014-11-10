<?php

session_start();

if (!isset($_SESSION['usua_se'])) 
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {


date_default_timezone_set('America/Buenos_Aires');
require '../../includes/funcionesProductos.php';
require '../../includes/funcionesTurnos.php';

$serviciosProductos = new ServiciosProductos();
$serviciosTurnos    = new ServiciosTurnos();

$id = $_GET['id'];

$resCanchas = $serviciosTurnos->traerCanchas();
$resClientes= $serviciosTurnos->traerClientes();
$resTurnos = $serviciosTurnos->traerTurnos();

$fecha = date('Y-m-d');

$resTurno = $serviciosTurnos->traerTurnosPorId($id);

?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gesti贸n de Cancha: La Caldera del Diablo</title>
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
    
    <script type="text/javascript">
		$( document ).ready(function() {
			$('.icodashboard2, .icoventas2, .icousuarios2, .icoturnos2, .icoproductos2, .icoreportes2, .icocontratos2, .icosalir2').click(function() {
				$('.menuHober').hide();
				$('.todoMenu').show(100, function() {
					$('#navigation').animate({'margin-left':'0px'}, {
													duration: 800,
													specialEasing: {
													width: "linear",
													height: "easeOutBounce"
													}});
				});
			});
			
			$('.ocultar').click(function(){
				$('.menuHober').show(100, function() {
					$('#navigation').animate({'margin-left':'-185px'}, {
													duration: 800,
													specialEasing: {
													width: "linear",
													height: "easeOutBounce"
													}});
				});
				$('.todoMenu').hide();
			});
			
			
						$("#tooltip2").mouseover(function(){
							$("#tooltip2").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip3").mouseover(function(){
							$("#tooltip3").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip4").mouseover(function(){
							$("#tooltip4").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip5").mouseover(function(){
							$("#tooltip5").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip6").mouseover(function(){
							$("#tooltip6").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip7").mouseover(function(){
							$("#tooltip7").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip8").mouseover(function(){
							$("#tooltip8").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});
						
						$("#tooltip9").mouseover(function(){
							$("#tooltip9").mousemove(function(e){
								 $(this).next().css({left : e.pageX , top: e.pageY});
							  });
							eleOffset = $(this).offset();
							$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().fadeOut("fast");
						});

		});
	</script>
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
		      }
		 });
      });
	  
	
    </script>
    <style>
			
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



 
<div id="navigation" >
	<div class="todoMenu">
        <div id="mobile-header">
            Menu
            <p>Usuario: <span style="color: #333; font-weight:900;"><?php echo $_SESSION['nombre_se']; ?></span></p>
            <p class="ocultar" style="color: #900; font-weight:bold; cursor:pointer; font-family:'Courier New', Courier, monospace; height:20px;">(Ocultar)</p>
        </div>
    
        <nav class="nav">
            <ul>
                <li class="arriba"><div class="icodashboard"></div><a href="../index.php">Dashboard</a></li>
                <li><div class="icoturnos"></div><a href="index.php">Turnos</a></li>
                <li><div class="icoventas"></div><a href="../ventas/">Ventas</a></li>
                <li><div class="icousuarios"></div><a href="../clientes/">Clientes</a></li>
                <li><div class="icoproductos"></div><a href="../productos/">Productos</a></li>
                <li><div class="icocontratos"></div><a href="../proveedores/">Proveedores</a></li>
                <li><div class="icoreportes"></div><a href="../reportes/">Reportes</a></li>
                <li><div class="icosalir"></div><a href="../salir/">Salir</a></li>
            </ul>
        </nav>
        
        <div id="infoMenu">
            <p>Informaci贸n del Menu</p>
        </div>
        <div id="infoDescrMenu">
            <p>La descripci贸n breve de cada item sera detallada aqui, deslizando el mouse por encima de cada menu.</p>
        </div>
     </div>
     <div class="menuHober">
     	<ul class="ulHober">
                <li class="arriba">
                	<div class="icodashboard2" id="tooltip2"></div>
                    <div class="tooltip-dash">Dashboard</div>
                </li>
                <li>
                	<div class="icoturnos2" id="tooltip3"></div>
                    <div class="tooltip-inmu">Turnos</div>
                </li>
                <li>
                	<div class="icoventas2" id="tooltip4"></div>
                    <div class="tooltip-alqui">Ventas</div>
                </li>
                <li>
                	<div class="icousuarios2" id="tooltip5"></div>
                    <div class="tooltip-usua">Clientes</div>
                </li>
                <li>
                	<div class="icoproductos2" id="tooltip9"></div>
                    <div class="tooltip-con">Productos</div>
                </li>
                <li>
                	<div class="icocontratos2" id="tooltip6"></div>
                    <div class="tooltip-con">Proveedores</div>
                </li>
                <li>
                	<div class="icoreportes2" id="tooltip7"></div>
                    <div class="tooltip-rep">Reportes</div>
                </li>
                <li>
                	<div class="icosalir2" id="tooltip8"></div>
                    <div class="tooltip-sal">Salir</div>
                </li>
            </ul>
     </div>
</div>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">



    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar Turno</p>
        </div>
    	<div class="cuerpoBox">
        <form class="form-horizontal formulario" role="form">
                	
                <!--refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea -->
                
                	<div class="form-group">
                    	<label for="fechautilizacion" class="control-label col-lg-3" style="text-align:left">Fecha Utilizaci贸n</label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" id="fechautilizacion" name="fechautilizacion" value="<?php echo mysql_result($resTurno,0,2); ?>" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="refcancha" class="control-label col-lg-3" style="text-align:left">Cancha</label>
                        <div class="col-lg-5">
                        	<select class="form-control" id="refcancha" name="refcancha">
                            	<?php while ($rowTP = mysql_fetch_array($resCanchas)) { ?>
                                    <?php if (mysql_result($resTurno,0,1)== $rowTP[0]) { ?>
                                    <option value="<?php echo $rowTP[0]; ?>" selected="selected"><?php echo $rowTP[1]; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $rowTP[0]; ?>"><?php echo $rowTP[1]; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                    	<label for="horautilizacion" class="control-label col-lg-3" style="text-align:left">Hora Utilizaci贸n</label>
                        <div class="col-lg-2">
                        	<select class="form-control" id="horautilizacion" name="horautilizacion">
                            	<?php for($i=0;$i<24;$i++) { ?>
                                    <?php if (mysql_result($resTurno,0,3)== $i.":00:00") { ?>
                                    <option value="<?php echo $i; ?>" selected="selected"><?php echo $i.':00'; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i.':00'; ?></option>
                                    <?php } ?>
                                	
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="refcliente" class="control-label col-lg-3" style="text-align:left">Cliente</label>
                        <div class="col-lg-6">
                            <select data-placeholder="selecione el cliente..." id="refcliente" name="refcliente" class="chosen-select" style="width:450px;" tabindex="2">
            			<option value=""></option>
                                <?php while ($rowC = mysql_fetch_array($resClientes)) { ?>

                                    <option value="<?php echo $rowC[0]; ?>"><?php echo $rowC[1]; ?></option>
	
                                <?php } ?>
                                
                            </select>
                            <span class="block-help">Cliente Actual: <?php echo mysql_result($resTurno,0,7); ?></span>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-success" id="crearcliente" style="margin-left:0px;">Nuevo Cliente</button>
                        </div>
                    </div>
                
                    
                    
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="modificar" style="margin-left:0px;">Modificar</button>
                            
                        </li>
                        
   
                    </ul>
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> El campo fecha de utilizaci贸n y cliente son obligatorios</p>
                	</div>
                    
                </form>
                <br>
                <div id="error">
                
                </div>
        </div>
    </div>

    
    

</div>

<div id="dialog2" title="Eliminar Turno">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            驴Esta seguro que desea eliminar el Turno?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>El turno se perdera.</p>
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
	});//fin del boton crea cliente
        
	$('.varborrar').click(function(event){
			  usersid =  $(this).attr("id");
			  if (!isNaN(usersid)) {
				$("#idEliminar").val(usersid);
				$("#dialog2").dialog("open");
				
			  } else {
				alert("Error, vuelva a realizar la acci贸n.");	
			  }
	});//fin del boton eliminar
	
	$('.volver').click(function(event){
				url = "index.php";
				$(location).attr('href',url);
	});//fin del boton eliminar


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
											url = "modificar.php?id=<?php echo $id; ?>";
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
									data:  {id: <?php echo $id; ?>, accion: 'eliminarTurno'},
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
		$("#fechautilizacion").attr('placeholder','Ingrese el Fecha Utilizaci髇...');
    });

	$("#fechautilizacion").change(function(event) {
		$("#fechautilizacion").removeClass("alert-danger");
		$("#fechautilizacion").attr('placeholder','Ingrese el Fecha Utilizaci髇');
	});
	
	function validador(){

			$error = "";
                        
                        if ($("#refcliente").chosen().val() == "") {
				$error = "Es obligatorio el campo cliente.";

				alert($error);
			}
			
			if ($("#fechautilizacion").val() == "") {
				$error = "Es obligatorio el campo Fecha Utilizaci髇.";
				$("#fechautilizacion").addClass("alert-danger");
				$("#fechautilizacion").attr('placeholder',$error);
			}


			return $error;
    }
	
	//al enviar el formulario
    $('#modificar').click(function(){
		
		
	if (validador() == "") 
        {

				$.ajax({
					data:  {id: <?php echo $id; ?>,
                                                nombre: $('#nombre').val(),
						refcliente: $("#refcliente").chosen().val(),
						refcancha: $('#refcancha').val(),
						horautilizacion: $('#horautilizacion').val(),
						fechautilizacion: $('#fechautilizacion').val(),
						usuacrea:	<?php echo "'".$_SESSION['nombre_se']."'"; ?>,
						accion: 'modificarTurno'},
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
							$(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong>Turno</strong>. ');
							$(".alert").delay(3000).queue(function(){
								/*aca lo que quiero hacer 
								  despu茅s de los 2 segundos de retraso*/
								$(this).dequeue(); //contin煤o con el siguiente 铆tem en la cola
								
							});
							$("#load").html('');
							
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
