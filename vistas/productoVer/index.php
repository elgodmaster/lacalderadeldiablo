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
		         $("#mensaje").html("<h5>Has seleccionado: " + textoFecha + "</h5>");
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
		      $("#mensaje").html("<h5>Has seleccionado: " + textoFecha + "</h5>");
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
				
				
					$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: <? echo $idProducto; ?>, accion: 'eliminarProducto'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "../productos/index.php?id=<? echo $idCategoria; ?>";
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
				
			});/* fin del document ready */
		
		</script>
		
        <div class="table-responsive">
        
        <div class="panel panel-primary" style="width:60%; margin-top:20px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Cargar de Articulo</h3>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form">
                	
                
                	<div class="form-group">
                    	<label for="eamil" class="col-lg-3 control-label" style="text-align:left">E-Mail</label>
                        <div class="col-lg-5" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,2); ?></h5>
                        </div>
                    </div>
                
                	<div class="form-group">
                    	<label for="password" class="col-lg-3 control-label" style="text-align:left">Password</label>
                        <div class="col-lg-5" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,3); ?></h5>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="fecha" class="col-lg-3 control-label" style="text-align:left">Ultima Fecha</label>
                        <div class="col-lg-5" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,1); ?></h5>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="categoria" class="col-lg-3 control-label" style="text-align:left">Categoria</label>
                        <div class="col-lg-5" style="background-color:#CCC;">
                        	<h5><? echo $serviciosProductos->TraerCategoriasPorId($idCategoria); ?></h5>
                        	
                            
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                    	<label for="pedido1" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 1</label>
                        <div class="col-lg-4" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,4); ?></h5>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido2" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 2</label>
                        <div class="col-lg-4" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,5); ?></h5>
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido3" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 3</label>
                        <div class="col-lg-4" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,6); ?></h5>
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido4" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 4</label>
                        <div class="col-lg-4" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,7); ?></h5>
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido5" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 5</label>
                        <div class="col-lg-4" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,8); ?></h5>
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido6" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 6</label>
                        <div class="col-lg-4" style="background-color:#CCC;">
                        	<h5><? echo mysql_result($res,0,9); ?></h5>
                        </div>
                        
                    </div>
                    
                    
                    <ul class="list-inline">
                    	<li>
                    		<button type="button" class="btn btn-warning" id="modificar" style="margin-left:0px;" onClick="location.href = '../productoModificar/index.php?id=<? echo $idCategoria; ?>&prod=<? echo $idProducto; ?>'">Modificar</button>
                        </li>
                    	<li>
                    		<button type="button" class="btn btn-danger varborrar" id="<? echo $idProducto; ?>" style="margin-left:0px;">Eliminar</button>
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

<div id="dialog2" title="Eliminar Articulo">
    	<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>¿Esta seguro que desea eliminar el articulo?.</p>
        <p><strong>Importante: </strong>Se perderan los datos del Articulo.</p>
        <input type="hidden" value="" id="idCliente" name="idCliente">
  </div>



</body>

</html>

<? }}} ?>