<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /sistemadeentradas/vistas/');
} else {
	
require '../../includes/funcionesProductos.php';

$serviciosProductos = new ServiciosProductos();


$res = $serviciosProductos->TraerCategorias();




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

    <script src="../../js/jquery-1.10.2.js"></script>
        <script src="../../js/ui/jquery.ui.core.js"></script>
        <script src="../../js/ui/jquery.ui.widget.js"></script>
        <script src="../../js/ui/jquery.ui.mouse.js"></script>
        <script src="../../js/ui/jquery.ui.button.js"></script>
        <script src="../../js/ui/jquery.ui.draggable.js"></script>
        <script src="../../js/ui/jquery.ui.position.js"></script>
        <script src="../../js/ui/jquery.ui.dialog.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">

        

        <!-- Latest compiled and minified JavaScript -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        
        
        
        <style>
			.buscador {
				width:620px; 
				margin-top: 30px; 
				margin-bottom:5px; 
				padding:15px;
				padding-top:2px;
				background-color:#C00; 
				border:1px solid #840000;	
				-webkit-border-radius: 12px;  /* Safari  */
  				-moz-border-radius: 12px;     /* Firefox */
				border-radius: 12px;
			}
		
			#buscar {
				background:url(../../imagenes/buscarIco.png) no-repeat;
				width: 35px;
				height:35px;
				border:none;
				text-decoration:none;
			}
			
			.cf:before, .cf:after{
				content:"";
				display:table;
			}
			 
			.cf:after{
				clear:both;
			}
			 
			.cf{
				zoom:1;
			}    
			
			.form-wrapper2 {
				width: 550px;
				/*350px*/
				padding: 15px;
				margin: 20px auto 10px auto;

				background: #444;
				background: rgba(0,0,0,.2);
				border-radius: 10px;
				box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
			}
			 
			/* Form text input */
			 
			 
			.form-wrapper2 #texto {
				width: 210px;
				/*230px*/
				height: 40px;
				padding: 10px 5px;
				float: left;   
				font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
				border: 0;
				background: #eee;
				border-radius: 3px 0 0 3px;     
			}
			 
			.form-wrapper2 #texto:focus {
				outline: 0;
				background: #fff;
				box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
			}
			 
			.form-wrapper2 #texto::-webkit-input-placeholder {
			   color: #999;
			   font-weight: normal;
			   font-style: italic;
			}
			 
			.form-wrapper2 #texto:-moz-placeholder {
				color: #999;
				font-weight: normal;
				font-style: italic;
			}
			 
			.form-wrapper2 #texto:-ms-input-placeholder {
				color: #999;
				font-weight: normal;
				font-style: italic;
			}  
			 
			 
			  
			 
			/* Form submit button */
			.form-wrapper2 button {
				overflow: visible;
				position: relative;
				float: right;
				border: 0;
				padding: 0;
				cursor: pointer;
				height: 40px;
				width: 110px;
				/*110px*/
				font: bold 15px/40px 'lucida sans', 'trebuchet MS', 'Tahoma';
				color: #fff;
				text-transform: uppercase;
				background: #d83c3c;
				border-radius: 0 3px 3px 0;     
				text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);
			}  
			   
			.form-wrapper2 button:hover{    
				background: #e54040;
			}  
			   
			.form-wrapper2 button:active,
			.form-wrapper2 button:focus{  
				background: #c42f2f;
				outline: 0;  
			}
			 
			.form-wrapper2 button:before { /* left arrow */
				content: '';
				position: absolute;
				border-width: 8px 8px 8px 0;
				border-style: solid solid solid none;
				border-color: transparent #d83c3c transparent;
				top: 12px;
				left: -6px;
			}
			 
			.form-wrapper2 button:hover:before{
				border-right-color: #e54040;
			}
			 
			.form-wrapper2 button:focus:before,
			.form-wrapper2 button:active:before{
					border-right-color: #c42f2f;
			}     
			 
			.form-wrapper2 button::-moz-focus-inner { /* remove extra button spacing for Mozilla Firefox */
				border: 0;
				padding: 0;
			}    
			
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
        
        <script type="text/javascript">
		
			$(document).ready(function(){
				
				$('.varborrar').click(function(event){
				  usersid =  $(this).attr("id");
				  if (!isNaN(usersid)) {
					$("#idCliente").val(usersid);
					$("#dialog2").dialog("open");
					//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
					//$(location).attr('href',url);
				  } else {
					alert("Error, vuelva a realizar la acción.");	
				  }
				  
				  //post code
				});
				
				$('.varModificar').click(function(event){
				  usersid =  $(this).attr("id");
				  if (!isNaN(usersid)) {
					$("#idModificar").val(usersid);
					$("#dialogModificar").dialog("open");
					//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
					//$(location).attr('href',url);
							$.ajax({
									data:  {id: usersid, accion: 'TraerCategoriasPorId'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											$('#nombre2').val(response);
											
									}
							});
					
					
				  } else {
					alert("Error, vuelva a realizar la acción.");	
				  }
				  
				  //post code
				});
				
				$('.varCrear').click(function(event){
				  
				  
					
					$("#dialogCrear").dialog("open");
					//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
					//$(location).attr('href',url);
				  
				  
				  //post code
				});
				
				$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idCliente').val(), accion: 'eliminarCategoria'},
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
		 
		 
	 		});
				
				
				/* para el crear */
				$("#nombre").click(function(event) {
        			$("#nombre").removeClass("alert-danger");
					$("#nombre").attr('placeholder','Ingrese el Nombre...');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#nombre").change(function(event) {
        			$("#nombre").removeClass("alert-danger");
        			$("#nombre").attr('placeholder','Ingrese el Nombre...');
        			});
					
					
					function validador(){
						
        				$error = "";
		
        				if ($("#nombre").val() == "") {
        					$error = "Es obligatorio el campo Nombre.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
        				}
						

        				return $error;
        			}
				
				
				
				$( "#dialogCrear" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Crear": function() {
	
						
						if (validador() == "")
        				{
								
        						$.ajax({
                                data:  {nombre:		$("#nombre").val(),
										accion:		'insertarCategoria'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            
                                            $("#error").removeClass("alert alert-danger");

                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> No se pudo crear la categoria');
                                            $("#load").html('');

                                        } else {
											
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se creo la categoria correctamente');
											url = "../../vistas/principal/";
											$(location).attr('href',url).slideUp( 900 );
											
										}
                                        
                                }
                        });
        				}
						
						
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		});
				
				
				/* fin del crear */
				
				
				/* para modificar */
				
				$("#nombre2").click(function(event) {
        			$("#nombre2").removeClass("alert-danger");
					$("#nombre2").attr('placeholder','Ingrese el Nombre...');
					$("#error2").removeClass("alert alert-danger");
					$("#error2").text('');
        			});

        			$("#nombre2").change(function(event) {
        			$("#nombre2").removeClass("alert-danger");
        			$("#nombre2").attr('placeholder','Ingrese el Nombre...');
        			});
					
					
					function validador2(){
						
        				$error = "";
		
        				if ($("#nombre2").val() == "") {
        					$error = "Es obligatorio el campo Nombre.";

        					$("#error2").addClass("alert alert-danger");
        					$("#error2").text($error);
        				}
						

        				return $error;
        			}
					
				$( "#dialogModificar" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Modificar": function() {
	
						if (validador2() == "")
        				{
								
        						$.ajax({
                                data:  {nombre:		$("#nombre2").val(),
										id:			$("#idModificar").val(),
										accion:		'modificarCategoria'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      										
											$("#error2").removeClass("alert alert-success");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico la categoria correctamente');
											url = "../../vistas/principal/";
											$(location).attr('href',url).slideUp( 900 );
                                        
                                }
                        });
        				}
						
						
						
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		});
			
			
			
			
			});/* fin del document ready */
		
		</script>
        
</head>



<body>

<div align="center">

    	
        
		
        <div class="table-responsive">
        <br>
        <div align="left" style="margin-left:20%;">
        	<button type="button" class="btn btn-primary varCrear" style="margin-left:0px;">Crear Categoria</button>
        </div>
        <div class="panel panel-primary" style="width:60%; margin-top:20px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Listados de Categorias</h3>
		</div>
			<div class="panel-body">
				<table class="table table-striped">
						<thead>
							<th>Categoria</th>
							<th style="text-align:center;">Modificar</th>
							<th style="text-align:center;">Eliminar</th>
						</thead>
					
						<tbody>
        					<?
								if (mysql_num_rows($res)>0) {
								while ($row = mysql_fetch_array($res)) {
							?>
                            	<tr height="35">
                                	<td><a href="../productos/index.php?id=<? echo $row[0]; ?>"><? echo $row[1]; ?></a> <span class="badge" style="margin-left:25px;"><? echo mysql_result($serviciosProductos->TraerCantidadCategoriasProductos($row[0]),0,0); ?></span></td>
                                	<td width="100" align="center"><img src="../../imagenes/editarIco.png" style="cursor:pointer;" id="<? echo $row[0]; ?>" class="varModificar"></td>
                                    <td width="100" align="center"><img src="../../imagenes/eliminarIco.png" style="cursor:pointer;" id="<? echo $row[0]; ?>" class="varborrar"></td>
                                    
                                </tr>
                            	
                            <?
									}
								} else {
							?>
                            <h3>No hay categorias cargadas</h3>
                            <? } ?>
        				</tbody>
                </table>
               </div>
           </div>
           </div>
    	</div>


<div id="dialog2" title="Eliminar Categoria">
    	<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>¿Esta seguro que desea eliminar la categoria?.</p>
        <p><strong>Importante: </strong>La categoria que borrará también borrar los articulos que son de su tipo.</p>
        <input type="hidden" value="" id="idCliente" name="idCliente">
 </div>
 
 
<div id="dialogCrear" title="Crear Articulo">
    	<form class="form-horizontal" role="form">
                	
                    <div class="form-group">
                    	<label for="nombre" class="col-lg-3 control-label" style="text-align:left;">Nombre</label>
                        <div class="col-lg-6">
                        	<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre..." required>
                        </div>
                    </div>
                
                    
                </form>
                
                <br>
                <div id="error">
                
                </div>
</div>


<div id="dialogModificar" title="Modificar Articulo">
    	<form class="form-horizontal" role="form">
                	
                    <div class="form-group">
                    	<label for="nombre" class="col-lg-3 control-label" style="text-align:left;">Nombre</label>
                        <div class="col-lg-6">
                        	<input type="text" class="form-control" id="nombre2" name="nombre2" placeholder="Ingrese el Nombre..." required>
                        </div>
                    </div>
                
                </form>
                <div id="error2">
                
                </div>
        <input type="hidden" value="" id="idModificar" name="idModificar">
</div>


</body>

</html>

<? } ?>