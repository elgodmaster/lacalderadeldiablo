<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Turnos',$_SESSION['rol_se']);


date_default_timezone_set('America/Buenos_Aires');
require '../../includes/funcionesProductos.php';
require '../../includes/funcionesTurnos.php';
require '../../includes/funcionesConfiguraciones.php';

$serviciosProductos = new ServiciosProductos();
$serviciosTurnos	= new ServiciosTurnos();
$serviciosConfiguraciones = new ServiciosConfiguraciones();

$resCanchas = $serviciosTurnos->traerCanchas();
$resClientes= $serviciosTurnos->traerClientes();
$resTurnos = $serviciosTurnos->traerTurnos();

$fecha = date('Y-m-d');

$resPrimerUltimoTurno = $serviciosTurnos->traerPrimerUltimoTurno(date('Y-m-d'));

$resTipoVenta = $serviciosConfiguraciones->traerTipoVentaValor("Canchas");

$diasMes = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')) - (integer)date('d');

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
    
<script src="../../js/date.js"></script>
<script src="../../js/dashboard.js"></script>
   	  <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>

      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
		
		$('#refcancha').change(function() {
			$("#fechautilizacion").val('');
			$("#fechautilizacion2").val('');
			$("#fechautilizacion3").val('');
			$("#fechautilizacion4").val('');			
		});
		
		$('#horautilizacion').change(function() {

			if($('#mesentero').is(":checked")) {
				
			} else {
				if (parseInt($('#horautilizacion').val())>=18) {
					$("#tipoventa option[value=5]").attr("selected",true);
				} else {
					$("#tipoventa option[value=2]").attr("selected",true);
				}
			}

			$("#fechautilizacion").val('');
			$("#fechautilizacion2").val('');
			$("#fechautilizacion3").val('');
			$("#fechautilizacion4").val('');			
		});
		
		$('#mesentero').change(function() {
			if($(this).is(":checked")) {

				$("#tipoventa option[value=8]").attr("selected",true);

				var diasquequedan = Date.parse('t + <?php echo $diasMes; ?> d');

				if (diasquequedan >= Date.parse('t + 7 d')) {
					$('#fec2').show();	
				}
				
				if (diasquequedan >= Date.parse('t + 14 d')) {
					$('#fec3').show();	
				}

				if (diasquequedan >= Date.parse('t + 21 d')) {
					$('#fec4').show();	
				}

				if (diasquequedan >= Date.parse('t + 28 d')) {
					$('#fec5').show();	
				}

			} else {
				$('#fec2').hide();
				$('#fec3').hide();
				$('#fec4').hide();
				$('#fec5').hide();
			}
       
		});
		
		function validaDisponibilidadCancha(cancha,fecha,hora,dtp,lblerror) {

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
				

       			if (response != '') {
					dtp.val('');
					dtp.addClass("alert alert-danger");
					lblerror.html(response);
				} else {
					dtp.removeClass("alert alert-danger");
					lblerror.html('');
				}
			}
		});

	}
	
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
		 
		 $("#fechautilizacion2").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
				 $('#fechaCambio').html(textoFecha);
		         validaDisponibilidadCancha($('#refcancha').val(),textoFecha,$('#horautilizacion').val(),$("#fechautilizacion2"),$('.fech2'));
		      }
		 });
		 
		 $("#fechautilizacion3").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
				 $('#fechaCambio').html(textoFecha);
		         validaDisponibilidadCancha($('#refcancha').val(),textoFecha,$('#horautilizacion').val(),$("#fechautilizacion3"),$('.fech3'));
		      }
		 });
		 
		$("#fechautilizacion4").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
				 $('#fechaCambio').html(textoFecha);
		         validaDisponibilidadCancha($('#refcancha').val(),textoFecha,$('#horautilizacion').val(),$("#fechautilizacion4"),$('.fech4'));
				 
		      }
		 });

		$("#fechautilizacion5").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
				 $('#fechaCambio').html(textoFecha);
		         validaDisponibilidadCancha($('#refcancha').val(),textoFecha,$('#horautilizacion').val(),$("#fechautilizacion5"),$('.fech5'));
				 
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


 <?php echo $resMenu; ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">



    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Nuevo Turno</p>
        </div>
    	<div class="cuerpoBox">
        
        <form class="form-horizontal formulario" role="form">
                	
                <!--refcancha,fechautilizacion,horautilizacion,refcliente,fechacreacion,usuacrea -->
                	
                    <div class="form-group">
                    	<label for="refcancha" class="control-label col-lg-3" style="text-align:left">Cancha</label>
                        <div class="col-lg-5">
                        	<select class="form-control" id="refcancha" name="refcancha">
                            	<?php while ($rowTP = mysql_fetch_array($resCanchas)) { ?>
                                	<option value="<?php echo $rowTP[0]; ?>"><?php echo $rowTP[1]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                    	<label for="horautilizacion" class="control-label col-lg-3" style="text-align:left">Hora Utilización</label>
                        <div class="col-lg-2">
                        	<select class="form-control" id="horautilizacion" name="horautilizacion">
                            	<?php for($i=0;$i<24;$i++) { ?>
                                	<option value="<?php echo $i; ?>"><?php echo $i.':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                	<div class="form-group">
                    	<label for="fechautilizacion" class="control-label col-lg-3" style="text-align:left">Fecha Utilización</label>
                        <div class="col-lg-2">
                        	<input type="text" class="form-control" id="fechautilizacion" name="fechautilizacion" >
                        </div>
                        <div class="col-lg-5">
                        	<label>
                        	<input type="checkbox" style="width:20px;" class="form-control" id="mesentero" name="mesentero" value="Mes entero">
                            Esta es una opción para cargar el mes entero.
  							</label>
                        </div>
                    </div>
                    
                    <div class="form-group" style="display:none;" id="fec2">
                    	<label for="fechautilizacion" class="control-label col-lg-3" style="text-align:left">Fecha Utilización</label>
                        <div class="col-lg-2">
                        	<input type="text" class="form-control" id="fechautilizacion2" name="fechautilizacion2" >
                        </div>
                        <div class="col-lg-3 fech2">
                        	
                        </div>
                    </div>
                    
                    <div class="form-group" style="display:none;" id="fec3">
                    	<label for="fechautilizacion" class="control-label col-lg-3" style="text-align:left">Fecha Utilización</label>
                        <div class="col-lg-2">
                        	<input type="text" class="form-control" id="fechautilizacion3" name="fechautilizacion3" >
                        </div>
                        <div class="col-lg-3 fech3">
                        	
                        </div>
                    </div>
                    
                    <div class="form-group" style="display:none;" id="fec4">
                    	<label for="fechautilizacion" class="control-label col-lg-3" style="text-align:left">Fecha Utilización</label>
                        <div class="col-lg-2">
                        	<input type="text" class="form-control" id="fechautilizacion4" name="fechautilizacion4" >
                        </div>
                        <div class="col-lg-3 fech4">
                        	
                        </div>
                    </div>

                    <div class="form-group" style="display:none;" id="fec5">
                    	<label for="fechautilizacion" class="control-label col-lg-3" style="text-align:left">Fecha Utilización</label>
                        <div class="col-lg-2">
                        	<input type="text" class="form-control" id="fechautilizacion5" name="fechautilizacion5" >
                        </div>
                        <div class="col-lg-3 fech4">
                        	
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
							
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-success" id="crearcliente" style="margin-left:0px;">Nuevo Cliente</button>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                    	<label for="nocliente" class="control-label col-lg-3" style="text-align:left">No es Cliente</label>
                        <div class="col-lg-6">
                        	<input type="text" class="form-control" id="nocliente" name="nocliente" placeholder="Ingrese el cliente...">
							
                        </div>
                    </div>
                    
                    
                	
                    <div class="form-group">
                    	<label for="tipoventa" class="control-label col-lg-3" style="text-align:left">Tipo Venta</label>
                        <div class="col-lg-6">
                        	<select class="form-control" id="tipoventa" name="tipoventa" tabindex="5">
                                <?php while ($rowTV = mysql_fetch_array($resTipoVenta)) { ?>
                                	<option value="<?php echo $rowTV[0]; ?>"><?php echo utf8_encode($rowTV[1]); ?></option>
                                <?php } ?>
                                
                            </select>
							
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
                		<p><strong>Importante!:</strong> El campo fecha de utilización y cliente son obligatorios</p>
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
						<?php 
							for($i=mysql_result($resPrimerUltimoTurno,0,0);$i<=mysql_result($resPrimerUltimoTurno,0,1);$i++) { 
								$idTurno1 = "#";
								$idTurno2 = "#";
								$idTurno3 = "#";
						?>
                    	<tr>
                        	<td><?php echo $i; ?>:00</td>
                            <td>
								<?php 
									$cancha1 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,1);
									if (mysql_num_rows($cancha1)>0) {
										echo '<a href="../clientes/modificar.php?id='.mysql_result($cancha1,0,2).'">'.mysql_result($cancha1,0,0).'</a>';
										$idTurno1 =	mysql_result($cancha1,0,1);
									}
								?>
                            </td>
                            <td>
								<?php 
									$cancha2 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,2);
									if (mysql_num_rows($cancha2)>0) {
										echo '<a href="../clientes/modificar.php?id='.mysql_result($cancha2,0,2).'">'.mysql_result($cancha2,0,0).'</a>';
										$idTurno2 =	mysql_result($cancha2,0,1);	
									}
								?>
                            </td>
							<td>
								<?php 
									$cancha3 = $serviciosTurnos->traerTurnosPorDiaCanchaFecha($fecha,$i,3);
									if (mysql_num_rows($cancha3)>0) {
										echo '<a href="../clientes/modificar.php?id='.mysql_result($cancha3,0,2).'">'.mysql_result($cancha3,0,0).'</a>';
										$idTurno3 =	mysql_result($cancha3,0,1);	
									}
								?>
                            </td>
                            <td align="center">
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $idTurno1; ?>">Modificar Cancha 1</a>
											</li>
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $idTurno2; ?>">Modificar Cancha 2</a>
											</li>
                                            <li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $idTurno3; ?>">Modificar Cancha 3</a>
											</li>
											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $idTurno1; ?>">Borrar Turno 1</a>
											</li>
                                            <li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $idTurno2; ?>">Borrar Turno 2</a>
											</li>
                                            <li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $idTurno3; ?>">Borrar Turno 3</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
            <button type="button" class="btn btn-default ver" style="margin-left:0px;">Ver Todos</button>
            <button type="button" class="btn btn-success imprimir" style="margin-left:0px;">Imprimir</button>
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
    
	$('.imprimir').live("click",function(event){
			url = "../../reportes/rptturnos.php?fecha="+$('#fechautilizacion').val();
			$(location).attr('href',url).attr('target','_blank');
	});
        
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
											usuacrea:	<?php echo "'".$_SESSION['nombre_se']."'"; ?>,
											saldo: $('#saldo').val(),
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
		$("#fechautilizacion").attr('placeholder','');
    });

	$("#fechautilizacion").change(function(event) {
		$("#fechautilizacion").removeClass("alert-danger");
		$("#fechautilizacion").attr('placeholder','');
	});
	
	
	function validador(){

			$error = "";
			

			
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
							fechautilizacion2: $('#fechautilizacion2').val(),
							fechautilizacion3: $('#fechautilizacion3').val(),
							fechautilizacion4: $('#fechautilizacion4').val(),
							fechautilizacion5: $('#fechautilizacion5').val(),
							mesentero: $("#mesentero").is(':checked') ? 1 : 0,
							nocliente: $('#nocliente').val(),
							usuacrea:	<?php echo "'".$_SESSION['nombre_se']."'"; ?>,
							tipoventa: $('#tipoventa').val(),
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
