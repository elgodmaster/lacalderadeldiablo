<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /sistemadeentradas/vistas/');
} else {
	
require '../../includes/funcionesProductos.php';

$serviciosProductos = new ServiciosProductos();


?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Ver' />

<meta name='description' content='Sistema Administrador de Entradas' />

<meta name='keywords' content='Sistema Administrador de Entradas' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.Entradas.com.ar' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />



<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Administrador de Entradas</title>



		<link rel="stylesheet" type="text/css" href="../../css/estilo.css"/>

<script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">

        

        <!-- Latest compiled and minified JavaScript -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        
        
        
        <style>
			
			.tablaPer tr {
				background-color: #d99795;
				color:#000;
				font-size:18px;
				font-family:Verdana, Geneva, sans-serif;
			}
			.tablaPer tr td {
				padding:10px;
				text-align:center;
				border-color: #000;
			}
			
			.colorTd {
				color:#000;
				font-weight:bold;
				background-color:#f5e0df;
			}
			

		</style>
        <script>
			$(document).ready(function(){
				$("#fechafactura").datepicker({
		      showOn: 'both',
			  dateFormat: 'yy-mm-dd',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
		         $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
		      }
		   });
			});
		
		</script>
        <style>
			
			$("#fechafactura").datepicker({
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
</head>



<body>

<div align="center">

<?

if (!isset($_GET['id'])) {
	

?>
	<h3>Debe seleccionar una categoria!!.</h3>
    <button type="button" class="btn btn-primary" style="margin-left:0px;" onClick="location.href = '../principal/'">Volver</button>
	</div>
</body>

</html>

<?
} else {
	
	
	if (!isset($_GET['prod'])) {
		
		
		
	?>
        <h3>Debe seleccionar un Articulo!!.</h3>
        <button type="button" class="btn btn-primary" style="margin-left:0px;" onClick="location.href = '../productos/index.php?id=<? echo $idCategoria; ?>'">Volver</button>
        </div>
    </body>
    
    </html>
    
    <?
    } else {
	
	$idCategoria = $_GET['id'];
	
	$idProducto = $_GET['prod'];	
	
	$serviciosProductos = new ServiciosProductos();

	$resCat = $serviciosProductos->TraerCategorias();
	
	$res = $serviciosProductos->TraerProductosPorId($idProducto);

?>	
        <script>
			$(document).ready(function(){
						$("#fechafactura").datepicker({
							  showOn: 'both',
							  buttonImage: 'calendar.png',
							  buttonImageOnly: true,
							  changeYear: true,
							  numberOfMonths: 2,
							  onSelect: function(textoFecha, objDatepicker){
								 $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
							  }
						});
						
						
					
					
					$("#email").click(function(event) {
        			$("#email").removeClass("alert-danger");
					$("#email").attr('placeholder','Ingrese el email...');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert-danger");
        			$("#email").attr('placeholder','Ingrese el email...');
        			});
					
					
					
					$("#password").click(function(event) {
        			$("#password").removeClass("alert-danger");
					$("#password").attr('placeholder','Ingrese el password...');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#password").change(function(event) {
        			$("#password").removeClass("alert-danger");
        			$("#password").attr('placeholder','Ingrese el password...');
        			});
					
					
					
					function validador(){
						
        				$error = "";

						
						if ($("#email").val() == "") {
        					$error = $error+"Es obligatorio el campo email. -";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
        				}
						
						if ($("#password").val() == "") {
        					$error = $error+"Es obligatorio el campo password. -";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
        				}
						
						if ($("#pedido1").val() != '') {
							if (isNaN($("#pedido1").val())) {
								$error = $error+"El campo Nro de Pedido 1 debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if ($("#pedido1").val().length > 6) {
								$error = $error+"El campo Nro de Pedido 1 no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
						
						if ($("#pedido2").val() != '') {
							if (isNaN($("#pedido2").val())) {
								$error = $error+"El campo Nro de Pedido 2 debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if ($("#pedido2").val().length > 6) {
								$error = $error+"El campo Nro de Pedido 2 no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
						
						if ($("#pedido3").val() != '') {
							if (isNaN($("#pedido3").val())) {
								$error = $error+"El campo Nro de Pedido 3 debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if ($("#pedido3").val().length > 6) {
								$error = $error+"El campo Nro de Pedido 3 no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
						
						
						if ($("#pedido4").val() != '') {
							if (isNaN($("#pedido4").val())) {
								$error = $error+"El campo Nro de Pedido 4 debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if ($("#pedido4").val().length > 6) {
								$error = $error+"El campo Nro de Pedido 4 no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
						
						if ($("#pedido5").val() != '') {
							if (isNaN($("#pedido5").val())) {
								$error = $error+"El campo Nro de Pedido 5 debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if ($("#pedido5").val().length > 6) {
								$error = $error+"El campo Nro de Pedido 5 no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
						
						if ($("#pedido6").val() != '') {
							if (isNaN($("#pedido6").val())) {
								$error = $error+"El campo Nro de Pedido 6 debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if ($("#pedido6").val().length > 6) {
								$error = $error+"El campo Nro de Pedido 6 no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
						
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email").val() ) ) {
							$error = $error+"El E-Mail ingresado es inválido.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
						}
						  

        				return $error;
        			}
				
				$("#modificar").click(function(event) {
        				
						if (validador() == "")
        				{
								
        						$.ajax({
                                data:  {email:			$("#email").val(),
										password:		$("#password").val(),
										refcategoria:	$("#categoria").val(),
										fecha:			$("#fechafactura").val(),
										pedido1:		$("#pedido1").val(),
										pedido2:		$("#pedido2").val(),
										pedido3:		$("#pedido3").val(),
										pedido4:		$("#pedido4").val(),
										pedido5:		$("#pedido5").val(),
										pedido6:		$("#pedido6").val(),
										idproducto:		<? echo $idProducto; ?>,
										accion:		'modificarProducto'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            
                                            $("#error").removeClass("alert alert-danger");

                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el articulo');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el articulo correctamente');
											//url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											//$(location).attr('href',url).slideUp( 400 );
										}
                                        
                                }
                        });
        				}
        		});
				
				
				function validaPedido(pedido) {
					
					$error = '';
					
					if (pedido != '') {
							if (isNaN(pedido)) {
								$error = $error+"El campo Nro de Pedido debe ser numerico. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
							
							if (pedido.length > 6) {
								$error = $error+"El campo Nro de Pedido no debe ser mayor a 6 caracteres. -";

        						$("#error").addClass("alert alert-danger");
        						$("#error").text($error);
							}
						}
					
					return $error;
				}
				
				$("#btnpedido1").click(function() {
						if (validaPedido($("#pedido1").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido1").val(),
										numeracion:	1,
										idproducto:	<? echo $idProducto; ?>,
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error").removeClass("alert alert-danger");
                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el Pedido 1');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el Pedido 1 correctamente');

										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido1 */
				
				
				$("#btnpedido2").click(function() {
						if (validaPedido($("#pedido2").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido2").val(),
										numeracion:	2,
										idproducto:	<? echo $idProducto; ?>,
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error").removeClass("alert alert-danger");
                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el Pedido 2');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el Pedido 2 correctamente');

										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido2 */
				
				
				$("#btnpedido3").click(function() {
						if (validaPedido($("#pedido3").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido3").val(),
										numeracion:	3,
										idproducto:	<? echo $idProducto; ?>,
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error").removeClass("alert alert-danger");
                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el Pedido 3');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el Pedido 3 correctamente');

										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido3 */
				
				
				
				$("#btnpedido4").click(function() {
						if (validaPedido($("#pedido4").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido4").val(),
										numeracion:	4,
										idproducto:	<? echo $idProducto; ?>,
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error").removeClass("alert alert-danger");
                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el Pedido 4');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el Pedido 4 correctamente');

										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido4 */
				
				
				$("#btnpedido5").click(function() {
						if (validaPedido($("#pedido5").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido5").val(),
										numeracion:	5,
										idproducto:	<? echo $idProducto; ?>,
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error").removeClass("alert alert-danger");
                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el Pedido 5');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el Pedido 5 correctamente');

										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido5 */
				
				
				
				$("#btnpedido6").click(function() {
						if (validaPedido($("#pedido6").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido6").val(),
										numeracion:	6,
										idproducto:	<? echo $idProducto; ?>,
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error").removeClass("alert alert-danger");
                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo modificar el Pedido 6');
                                            $("#load").html('');

                                        } else {
											$("#load").html('');
											$("#error").removeClass("alert alert-danger");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico el Pedido 6 correctamente');

										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido6 */
				
			});
		
		</script>
		
        <div class="table-responsive">
        
        <div class="panel panel-primary" style="width:70%; margin-top:20px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Cargar de Articulo</h3>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form">
                	
                
                	<div class="form-group">
                    	<label for="eamil" class="col-lg-3 control-label" style="text-align:left">E-Mail</label>
                        <div class="col-lg-5">
                        	<input value="<? echo mysql_result($res,0,2); ?>" type="email" class="form-control" id="email" name="email" placeholder="Ingrese el E-Mail..." required>
                        </div>
                    </div>
                
                	<div class="form-group">
                    	<label for="password" class="col-lg-3 control-label" style="text-align:left">Password</label>
                        <div class="col-lg-5">
                        	<input value="<? echo mysql_result($res,0,4); ?>" type="text" class="form-control" id="password" name="password" placeholder="Ingrese el Password..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="fecha" class="col-lg-3 control-label" style="text-align:left">Ultima Fecha</label>
                        <div class="col-lg-5">
                        	<input value="<? echo mysql_result($res,0,1); ?>" type="text" name="fechafactura" id="fechafactura" style="padding:6px;"> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="categoria" class="col-lg-3 control-label" style="text-align:left">Nueva Categoria</label>
                        <div class="col-lg-5">
                        	<h5>Categoria Actual: <strong><? echo $serviciosProductos->TraerCategoriasPorId($idCategoria); ?></strong></h5>
                        	<select class="form-control" id="categoria">
                            	<? while ($row = mysql_fetch_array($resCat)) { ?>
                                	<? if ($idCategoria == $row[0]) { ?>
                                    	<option value="<? echo $row[0]; ?>" selected><? echo $row[1]; ?></option>
                                    <? } else { ?>
                                		<option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
                                    <? } ?>
                                <? } ?>
                            </select>
                            
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                    	<label for="pedido1" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 1</label>
                        <div class="col-lg-4">
                        	<input value="<? echo mysql_result($res,0,5); ?>" type="text" class="form-control" id="pedido1" name="pedido1" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido1" style="margin-left:0px;">Modificar Solo Nº Pedido 1</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido2" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 2</label>
                        <div class="col-lg-4">
                        	<input value="<? echo mysql_result($res,0,6); ?>" type="text" class="form-control" id="pedido2" name="pedido2" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido2" style="margin-left:0px;">Modificar Solo Nº Pedido 2</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido3" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 3</label>
                        <div class="col-lg-4">
                        	<input value="<? echo mysql_result($res,0,7); ?>" type="text" class="form-control" id="pedido3" name="pedido3" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido3" style="margin-left:0px;">Modificar Solo Nº Pedido 3</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido4" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 4</label>
                        <div class="col-lg-4">
                        	<input value="<? echo mysql_result($res,0,8); ?>" type="text" class="form-control" id="pedido4" name="pedido4" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido4" style="margin-left:0px;">Modificar Solo Nº Pedido 4</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido5" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 5</label>
                        <div class="col-lg-4">
                        	<input value="<? echo mysql_result($res,0,9); ?>" type="text" class="form-control" id="pedido5" name="pedido5" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido5" style="margin-left:0px;">Modificar Solo Nº Pedido 5</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido6" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 6</label>
                        <div class="col-lg-4">
                        	<input value="<? echo mysql_result($res,0,10); ?>" type="text" class="form-control" id="pedido6" name="pedido6" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido6" style="margin-left:0px;">Modificar Solo Nº Pedido 6</button>
                        </div>
                    </div>
                    
                    
                    <ul class="list-inline">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="modificar" style="margin-left:0px;">Modificar</button>
                        </li>
                        <li>
                        	<button type="button" class="btn btn-info" style="margin-left:0px;" onClick="location.href = '../productos/index.php?id=<? echo $idCategoria; ?>'">Volver</button>
                        </li>

   
                    </ul>
                    <div id="load">
                    
                    </div>
                </form>
                
                <br>
                <div id="error">
                
                </div>
               </div>
           </div>
           </div>
    	</div>





</body>

</html>

<? }}} ?>