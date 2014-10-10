<?php
session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /sistemadeentradas/vistas/');
} else {


require '../../includes/funcionesProductos.php';

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
        
        <script src="../../js/ZeroClipboard.js"></script>
        
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
        
</head>



<body>

<div align="center">

    	
        <!--<form name="form" class="form-horizontal">
    		
            <div class="row">
            	
                <div class="col-lg-2 form-group">
                    <label for="buscar" class="control-label">Buscar: </label>
                </div>
                
                <div class="form-group col-lg-7">
                    <input type="text" class="form-control" name="buscar">
                </div>
                
                <div class="form-group col-lg-2">
                    <input type="button" class="form-control" value="Buscar" id="buscar">
                </div>
            </div>
        </form>-->
        
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
	
	if (!isset($_GET['email']))  {
	

		?>
			<h3>Debe ingresar un email para buscar!!.</h3>
			<button type="button" class="btn btn-primary" style="margin-left:0px;" onClick="location.href = '../productos/index.php?id=<? echo $_GET['id']; ?>'">Volver</button>
			</div>
		</body>
		
		</html>
		
		<?
		} else {
	
	
			if ($_GET['email'] == '')  {
	

		?>
			<h3>Debe ingresar un email para buscar!!.</h3>
			<button type="button" class="btn btn-primary" style="margin-left:0px;" onClick="location.href = '../productos/index.php?id=<? echo $_GET['id']; ?>'">Volver</button>
			</div>
		</body>
		
		</html>
		
		<?
		} else {
			
			$idCategoria = $_GET['id'];	
			
			$email = $_GET['email'];
			
			$serviciosProductos = new ServiciosProductos();
			
			
			$res = $serviciosProductos->BuscarProductosPorEmail($idCategoria,$email);

			$resCat = $serviciosProductos->TraerCategorias();
?>
        <div class="buscador">
        <form class="form-wrapper2 cf">
        	<select id="filtro" style="float:left; padding:11px; width:180px; margin-right:20px;">
            	<option value="0">N° de Pedido</option>
                <option value="1">E-Mail</option>
            </select>
        	<input id="texto" class="filtroBuscar" type="text" placeholder="Busque aqui..." />
        	<button type="button" class="buscarPE">Buscar</button>
            
    	</form>
        	<div id="error">
            
            </div>   
        </div>
		
        <div class="table-responsive">
        <br>
        <div align="left" style="margin-left:50px;">
        	<ul class="list-inline">
            	<li>
        			<button type="button" class="btn btn-primary varCrear" style="margin-left:0px;" >Cargar Articulo</button>
                </li>
                <li>
                	<button type="button" class="btn btn-info" style="margin-left:0px;" onClick="location.href = '../principal/'">Volver</button>
                </li>
            </ul>
        </div>
        <div class="panel panel-primary" style="width:96%; margin-top:20px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Listados de Articulos de la Categoria: <? echo $serviciosProductos->TraerCategoriasPorId($idCategoria); ?></h3>
		</div>
			<div class="panel-body">
            	<?
					if (mysql_num_rows($res)>0) {
				?>
                <button type="button" name="text-to-copy" id="text-to-copy" data-clipboard-text="" class="btn btn-default">Copiar</button>
				<table class="table table-striped">
						<thead>
							<th width="120">Ultima Fecha</th>
							<th>E-Mail</th>
							<th>Password</th>
							<th>Nº Pedido 1</th>
							<th>Nº Pedido 2</th>
							<th>Nº Pedido 3</th>
							<th>Nº Pedido 4</th>
                            <th>Nº Pedido 5</th>
                            <th>Nº Pedido 6</th>
						</thead>
					
						<tbody>
        					<?
								
								while ($row = mysql_fetch_array($res)) {
							?>
                            	<tr height="35" id="filaV<? echo $row[0]; ?>" class="fila">
                                	<td width="120"><? echo $row[1]; ?></td>
                                    <td><? echo $row[2]; ?></td>
                                    <td><? echo $row[3]; ?></td>
                                    <td><? echo $row[4]; ?></td>
                                    <td><? echo $row[5]; ?></td>
                                    <td><? echo $row[6]; ?></td>
                                    <td><? echo $row[7]; ?></td>
                                    <td><? echo $row[8]; ?></td>
                                    <td><? echo $row[9]; ?></td>
                                </tr>
                            	<tr>
                                	<td colspan="10" id="filaE<? echo $row[0]; ?>" class="fila hidden">
                                    	<ul class="list-inline">
                                        	<li>
                                            	<button type="button" class="btn btn-warning varModificar" style="margin-left:0px;" id="<? echo $row[0]; ?>">Modificar</button>
                                            </li>
                                            <li>
                                            	<button type="button" class="btn btn-primary varVer" style="margin-left:0px;" id="<? echo $row[0]; ?>">Ver</button>
                                            </li>
                                            <li>
                                            	<button type="button" class="btn btn-danger varborrar" id="<? echo $row[0]; ?>" style="margin-left:0px;">Eliminar</button>
                                            </li>
                                            <li>
                                            	<button id="<? echo $row[2]; ?> - <? echo $row[3]; ?>" class="copiar btn btn-default">Pasar Para Copiar</button>
                                            </li>
                                            <li>
                                            	<p id="text-to-copy-text" style=""></p>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?
								}
							?>
        				</tbody>
                </table>
                
                <? } else { ?>
                	<h3>No hay Articulos para esta categoria cargados</h3>
                <? } ?>
               </div>
           </div>
           </div>
    	</div>

<script type="text/javascript">
		
			$(document).ready(function(){
				
					$(".fila").click(function() {
						$(".fila2").addClass('hidden');
						var id = '#filaE' + $(this).attr("id").substr(5);
						$( id).removeClass('hidden');
					});
					/*
					$(".fila2").mouseover(function() {
						var id = '#filaE' + $(this).attr("id").substr(5);
						$( id).removeClass('hidden');
					});
					
					$(".fila2").mouseout(function(){
						var id = '#filaE' + $(this).attr("id").substr(5);
						$( id).addClass('hidden');
					}); 
					*/
					
					
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
				
				$('.varCrear').click(function(event){
					  
						$("#dialogCrear").dialog("open");
						
					});
					
					$('.varVer').click(function(event){
					  usersid =  $(this).attr("id");
					  if (!isNaN(usersid)) {
						
						$("#dialogVer").dialog("open");
						$.ajax({
									data:  {id: usersid, accion: 'TraerProductosPorId'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											
												var articulo = response.split("/*/");
												
												$(".email3").html(articulo[2]);
												$(".password3").html(articulo[3]);
												$(".fechafactura3").html(articulo[1]);
												$(".pedido13").html(articulo[4]);
												$(".pedido23").html(articulo[5]);
												$(".pedido33").html(articulo[6]);
												$(".pedido43").html(articulo[7]);
												$(".pedido53").html(articulo[8]);
												$(".pedido63").html(articulo[9]);
											
									}
						});
					  } else {
						alert("Error, vuelva a realizar la acción.");	
					  }
					  
					  //post code
					});
				
				$('.varModificar').click(function(event){
					  usersid =  $(this).attr("id");
					  if (!isNaN(usersid)) {
						
						$("#idMod").val(usersid);
						
						$.ajax({
									data:  {id: usersid, accion: 'TraerProductosPorId'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											
												var articulo = response.split("/*/");
												
												$("#email").val(articulo[2]);
												$("#password").val(articulo[3]);
												$("#fechafactura").val(articulo[1]);
												$("#pedido1").val(articulo[4]);
												$("#pedido2").val(articulo[5]);
												$("#pedido3").val(articulo[6]);
												$("#pedido4").val(articulo[7]);
												$("#pedido5").val(articulo[8]);
												$("#pedido6").val(articulo[9]);
											
									}
						});
							
							
						$("#dialogMod").dialog("open");
						//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
						//$(location).attr('href',url);
					  } else {
						alert("Error, vuelva a realizar la acción.");	
					  }
					  
					  //post code
					});
				
				
				$( "#dialogVer" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:740,
				modal: true,
				buttons: {
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
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
									data:  {id: $("#idCliente").val(), accion: 'eliminarProducto'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php?id=<? echo $idCategoria; ?>";
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
			
			$(".filtroBuscar").click(function(event) {
        		$(".filtroBuscar").removeClass("alert-danger");
				$(".filtroBuscar").attr('placeholder','Busque aqui...');
				$("#error").removeClass("alert alert-danger");
				$("#error").text('');
        	});

        	$(".filtroBuscar").change(function(event) {
        		$(".filtroBuscar").removeClass("alert-danger");
        		$(".filtroBuscar").attr('placeholder','Busque aqui...');
        	});
					
			
			function validarPedido() {
						$error = '';
					
					
					
						return $error;
				}
				
				
				$(".buscarPE").click(function() {
					if ($("#filtro").val() == 0) {
							if (validarPedido() == '') {
								$("#error").removeClass("alert alert-danger");
								url = "../../vistas/productosBuscarPedido/index.php?id=<? echo $idCategoria; ?>&pedido="+$(".filtroBuscar").val();
								$(location).attr('href',url);	
							}
					} else {
								$("#error").removeClass("alert alert-danger");
								url = "../../vistas/productosBuscarEmail/index.php?id=<? echo $idCategoria; ?>&email="+$(".filtroBuscar").val();
								$(location).attr('href',url);
					}
				});
				
				
				
				
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
					
					$("#fechafactura2").datepicker({
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
					$("#error2").removeClass("alert alert-danger");
					$("#error2").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert-danger");
        			$("#email").attr('placeholder','Ingrese el email...');
        			});
					
					
					
					$("#password").click(function(event) {
        			$("#password").removeClass("alert-danger");
					$("#password").attr('placeholder','Ingrese el password...');
					$("#error2").removeClass("alert alert-danger");
					$("#error2").text('');
        			});

        			$("#password").change(function(event) {
        			$("#password").removeClass("alert-danger");
        			$("#password").attr('placeholder','Ingrese el password...');
        			});
					
					
					
					function validador(){
						
        				$error = "";
		
						
						if ($("#email").val() == "") {
        					$error = $error+"Es obligatorio el campo email. -";

        					$("#error2").addClass("alert alert-danger");
        					$("#error2").text($error);
        				}
						
						if ($("#password").val() == "") {
        					$error = $error+"Es obligatorio el campo password. -";

        					$("#error2").addClass("alert alert-danger");
        					$("#error2").text($error);
        				}
						
						
						
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email").val() ) ) {
							$error = $error+"El E-Mail ingresado es inválido.";

        					$("#error2").addClass("alert alert-danger");
        					$("#error2").text($error);
						}
						  

        				return $error;
        			}
				
				
				
				function validaPedido(pedido) {
					
					$error = '';
					
					
					return $error;
				}
				
				$("#btnpedido1").click(function() {
						if (validaPedido($("#pedido1").val()) == "")
        				{	
        						$.ajax({
                                data:  {pedido:		$("#pedido1").val(),
										numeracion:	1,
										idproducto:	$("#idMod").val(),
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error2").removeClass("alert alert-danger");
                                            $("#error2").addClass("alert alert-danger");
                                            $("#error2").html('<strong>Error!</strong> No se pudo modificar el Pedido 1');
                                            $("#load2").html('');

                                        } else {
											$("#load2").html('');
											$("#error2").removeClass("alert alert-danger");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico el Pedido 1 correctamente');
											url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											$(location).attr('href',url).slideUp( 400 );

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
										idproducto:	$("#idMod").val(),
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error2").removeClass("alert alert-danger");
                                            $("#error2").addClass("alert alert-danger");
                                            $("#error2").html('<strong>Error!</strong> No se pudo modificar el Pedido 2');
                                            $("#load2").html('');

                                        } else {
											$("#load2").html('');
											$("#error2").removeClass("alert alert-danger");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico el Pedido 2 correctamente');
											url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											$(location).attr('href',url).slideUp( 400 );

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
										idproducto:	$("#idMod").val(),
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error2").removeClass("alert alert-danger");
                                            $("#error2").addClass("alert alert-danger");
                                            $("#error2").html('<strong>Error!</strong> No se pudo modificar el Pedido 3');
                                            $("#load2").html('');

                                        } else {
											$("#load2").html('');
											$("#error2").removeClass("alert alert-danger");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico el Pedido 3 correctamente');
											url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											$(location).attr('href',url).slideUp( 400 );

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
										idproducto:	$("#idMod").val(),
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error2").removeClass("alert alert-danger");
                                            $("#error2").addClass("alert alert-danger");
                                            $("#error2").html('<strong>Error!</strong> No se pudo modificar el Pedido 4');
                                            $("#load2").html('');

                                        } else {
											$("#load2").html('');
											$("#error2").removeClass("alert alert-danger");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico el Pedido 4 correctamente');
											url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											$(location).attr('href',url).slideUp( 400 );

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
										idproducto:	$("#idMod").val(),
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error2").removeClass("alert alert-danger");
                                            $("#error2").addClass("alert alert-danger");
                                            $("#error2").html('<strong>Error!</strong> No se pudo modificar el Pedido 5');
                                            $("#load2").html('');

                                        } else {
											$("#load2").html('');
											$("#error2").removeClass("alert alert-danger");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico el Pedido 5 correctamente');
											url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											$(location).attr('href',url).slideUp( 400 );

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
										idproducto:	$("#idMod").val(),
										accion:		'modificarDatos'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response == '') {
                                            $("#error2").removeClass("alert alert-danger");
                                            $("#error2").addClass("alert alert-danger");
                                            $("#error2").html('<strong>Error!</strong> No se pudo modificar el Pedido 6');
                                            $("#load2").html('');

                                        } else {
											$("#load2").html('');
											$("#error2").removeClass("alert alert-danger");
											$("#error2").addClass("alert alert-success");
											$("#error2").html('<strong>Ok!</strong> Se modifico el Pedido 6 correctamente');
											url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
											$(location).attr('href',url).slideUp( 400 );
										}
                                        
                                }
                        });
        				}
				});/* fin del click de btnpedido6 */
				
				
				
				$( "#dialogMod" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:860,
				height:740,
				modal: true,
				buttons: {
				    "Guardar": function() {
	
						
									
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
													idproducto:		$("#idMod").val(),
													accion:		'modificarProducto'},
											url:   '../../ajax/ajax.php',
											type:  'post',
											beforeSend: function () {
													$("#load2").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
											},
											success:  function (response) {
													
													if (response == '') {
														
														$("#error").removeClass("alert alert-danger");
			
														$("#error2").addClass("alert alert-danger");
														$("#error2").html('<strong>Error!</strong> No se pudo modificar el articulo');
														$("#load2").html('');
			
													} else {
														$("#load2").html('');
														$("#error2").removeClass("alert alert-danger");
														$("#error2").addClass("alert alert-success");
														$("#error2").html('<strong>Ok!</strong> Se modifico el articulo correctamente');
														url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
														$(location).attr('href',url).slideUp( 400 );
													}
													
											}
									});
									
									$( this ).dialog( "close" );
									$( this ).dialog( "close" );
										$('html, body').animate({
											scrollTop: '1000px'
												},
										1500);
        						}
									
						
						
						
						
						
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
				});
				
				
				
				/* para el dialogo de crear */
				function validador2(){
						
        				$error = "";
		
        				
						
						if ($("#email2").val() == "") {
        					$error = $error+"Es obligatorio el campo email. -";

        					$("#error3").addClass("alert alert-danger");
        					$("#error3").text($error);
        				}
						
						if ($("#password2").val() == "") {
        					$error = $error+"Es obligatorio el campo password. -";

        					$("#error3").addClass("alert alert-danger");
        					$("#error3").text($error);
        				}
						
						
						
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email2").val() ) ) {
							$error = $error+"El E-Mail ingresado es inválido.";

        					$("#error3").addClass("alert alert-danger");
        					$("#error3").text($error);
						}
						  

        				return $error;
        			}
					
					
				$( "#dialogCrear" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:860,
				height:700,
				modal: true,
				buttons: {
				    "Crear": function() {
	
						
									
									if (validador2() == "")
									{
											
											$.ajax({
											data:  {email:			$("#email2").val(),
													password:		$("#password2").val(),
													refcategoria:	<? echo $idCategoria; ?>,
													fecha:			$("#fechafactura2").val(),
													pedido1:		$("#pedido12").val(),
													pedido2:		$("#pedido22").val(),
													pedido3:		$("#pedido32").val(),
													pedido4:		$("#pedido42").val(),
													pedido5:		$("#pedido52").val(),
													pedido6:		$("#pedido62").val(),
													idproducto:		$("#idCrear").val(),
													accion:		'insertarProducto'},
											url:   '../../ajax/ajax.php',
											type:  'post',
											beforeSend: function () {
													$("#load3").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
											},
											success:  function (response) {
													
													if (response == '') {
														
														$("#error3").removeClass("alert alert-danger");
			
														$("#error3").addClass("alert alert-danger");
														$("#error3").html('<strong>Error!</strong> No se pudo crear el articulo');
														$("#load3").html('');
			
													} else {
														$("#load3").html('');
														$("#error3").removeClass("alert alert-danger");
														$("#error3").addClass("alert alert-success");
														$("#error3").html('<strong>Ok!</strong> Se creo el articulo correctamente');
														url = "../../vistas/productos/index.php?id=<? echo $idCategoria; ?>";
														$(location).attr('href',url).slideUp( 400 );
													}
													
											}
									});
							
										$('html, body').animate({
											scrollTop: '1000px'
												},
										1500);
        						}
									
						
						
						
						
						
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
				});
				
				
				/* fin del dialogo de crear */
				
			});/* fin del document ready */
		
		</script>
        
        <script>
			$(document).ready(function()
			{
				
				$('.copiar').click(function(event){
						
					  id =  $(this).attr("id");
					  alert('El email y password: '+id+' fueron pasados para copiar');
					  $('#text-to-copy').attr('data-clipboard-text',id);
					  
					  
				});
				
				var clientText = new ZeroClipboard( $("#text-to-copy"), {
							moviePath: "http://www.paulund.co.uk/playground/demo/zeroclipboard-demo/zeroclipboard/ZeroClipboard.swf",
							debug: false
							} );
							clientText.on( "load", function(clientText)
							{
								$('#flash-loaded').fadeIn();
								clientText.on( "complete", function(clientText, args) {
								clientText.setText( args.text );
							$('#text-to-copy-text').fadeIn();
							} );
						} );
						
				
				});
			//
		</script>

<div id="dialog2" title="Eliminar Articulo">
    	<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>¿Esta seguro que desea eliminar el articulo?.</p>
        <p><strong>Importante: </strong>Se perderan los datos del Articulo.</p>
        <input type="hidden" value="" id="idCliente" name="idCliente">
  </div>


<div id="dialogMod" title="Modificar Articulo">
		<div class="table-responsive">
        
        <div class="panel panel-primary" style="width:100%; margin-top:20px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Articulo</h3>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form">
                	
                
                	<div class="form-group">
                    	<label for="eamil" class="col-lg-3 control-label" style="text-align:left">E-Mail</label>
                        <div class="col-lg-5">
                        	<input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el E-Mail..." required>
                        </div>
                    </div>
                
                	<div class="form-group">
                    	<label for="password" class="col-lg-3 control-label" style="text-align:left">Password</label>
                        <div class="col-lg-5">
                        	<input type="text" class="form-control" id="password" name="password" placeholder="Ingrese el Password..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="fecha" class="col-lg-3 control-label" style="text-align:left">Ultima Fecha</label>
                        <div class="col-lg-5">
                        	<input type="text" name="fechafactura" id="fechafactura" style="padding:6px;"> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="categoria" class="col-lg-3 control-label" style="text-align:left">Nueva Categoria</label>
                        <div class="col-lg-5">
                        	<h5>Categoria Actual: <strong><? echo $serviciosProductos->TraerCategoriasPorId($idCategoria); ?></strong></h5>
                        	<select class="form-control" id="categoria">
                            	<? while ($row2 = mysql_fetch_array($resCat)) { ?>
                                	<? if ($idCategoria == $row2[0]) { ?>
                                    	<option value="<? echo $row2[0]; ?>" selected><? echo $row2[1]; ?></option>
                                    <? } else { ?>
                                		<option value="<? echo $row2[0]; ?>"><? echo $row2[1]; ?></option>
                                    <? } ?>
                                <? } ?>
                            </select>
                            
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                    	<label for="pedido1" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 1</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido1" name="pedido1" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido1" style="margin-left:0px;">Modificar Solo Nº Pedido 1</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido2" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 2</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido2" name="pedido2" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido2" style="margin-left:0px;">Modificar Solo Nº Pedido 2</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido3" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 3</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido3" name="pedido3" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido3" style="margin-left:0px;">Modificar Solo Nº Pedido 3</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido4" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 4</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido4" name="pedido4" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido4" style="margin-left:0px;">Modificar Solo Nº Pedido 4</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido5" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 5</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido5" name="pedido5" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido5" style="margin-left:0px;">Modificar Solo Nº Pedido 5</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido6" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 6</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido6" name="pedido6" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                        <div class="col-lg-3">
                        	<button type="button" class="btn btn-warning" id="btnpedido6" style="margin-left:0px;">Modificar Solo Nº Pedido 6</button>
                        </div>
                    </div>
                    
                    
                    
                    <div id="load2">
                    
                    </div>
                    <input type="hidden" value="" id="idMod" name="idMod">
                </form>
                
                <br>
                <div id="error2">
                
                </div>
               </div>
           </div>
           </div>

  <div id="dialogCrear" title="Crear Articulo">
    	<form class="form-horizontal" role="form">
                	
                
                	<div class="form-group">
                    	<label for="eamil" class="col-lg-3 control-label" style="text-align:left">E-Mail</label>
                        <div class="col-lg-5">
                        	<input type="email" class="form-control" id="email2" name="email2" placeholder="Ingrese el E-Mail..." required>
                        </div>
                    </div>
                
                	<div class="form-group">
                    	<label for="password" class="col-lg-3 control-label" style="text-align:left">Password</label>
                        <div class="col-lg-5">
                        	<input type="text" class="form-control" id="password2" name="password2" placeholder="Ingrese el Password..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="fecha" class="col-lg-3 control-label" style="text-align:left">Ultima Fecha</label>
                        <div class="col-lg-5">
                        	<input type="text" name="fechafactura2" id="fechafactura2" style="padding:6px;"> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="categoria" class="col-lg-3 control-label" style="text-align:left">Categoria</label>
                        <div class="col-lg-5">
                        	<h5><? echo $serviciosProductos->TraerCategoriasPorId($idCategoria); ?></h5>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                    	<label for="pedido1" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 1</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido12" name="pedido12" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido2" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 2</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido22" name="pedido22" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido3" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 3</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido32" name="pedido32" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido4" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 4</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido42" name="pedido42" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido5" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 5</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido52" name="pedido52" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido6" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 6</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" id="pedido62" name="pedido62" placeholder="Ingrese el N° de Pedido..." required>
                        </div>
                    </div>
                    
                    <div id="load3">
                    
                    </div>
                </form>
                <br>
                <div id="error3">
                
                </div>
</div>




<div id="dialogVer" title="Ver Articulo">
    	<form class="form-horizontal" role="form">
                	
                
                	<div class="form-group">
                    	<label for="eamil" class="col-lg-3 control-label" style="text-align:left">E-Mail</label>
                        <div class="col-lg-5 email3" style="background-color:#CCC;">
                        	
                        </div>
                    </div>
                
                	<div class="form-group">
                    	<label for="password" class="col-lg-3 control-label" style="text-align:left">Password</label>
                        <div class="col-lg-5 password3" style="background-color:#CCC;">
                        	
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label for="fecha" class="col-lg-3 control-label" style="text-align:left">Ultima Fecha</label>
                        <div class="col-lg-5 fechafactura3" style="background-color:#CCC;">
                        	
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
                        <div class="col-lg-4 pedido13" style="background-color:#CCC;">
                        	
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido2" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 2</label>
                        <div class="col-lg-4 pedido23" style="background-color:#CCC;">
                        	
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido3" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 3</label>
                        <div class="col-lg-4 pedido33" style="background-color:#CCC;">
                        	
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido4" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 4</label>
                        <div class="col-lg-4 pedido43" style="background-color:#CCC;">
                        	
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido5" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 5</label>
                        <div class="col-lg-4 pedido53" style="background-color:#CCC;">
                        	
                        </div>
                       
                    </div>
                    
                    <div class="form-group">
                    	<label for="pedido6" class="col-lg-3 control-label" style="text-align:left">N° de Pedido 6</label>
                        <div class="col-lg-4 pedido63" style="background-color:#CCC;">
                        	
                        </div>
                        
                    </div>
                    
                  
                </form>
</div>        

           
</body>

</html>

<? 		} //del if del GET de la categoria
		}
		}
	} 

?>