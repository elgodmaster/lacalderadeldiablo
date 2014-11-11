<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {


$id = $_GET['id'];

require '../../includes/funcionesClientes.php';


$serviciosClientes = new ServiciosClientes();

$resCliente = $serviciosClientes->traerClientePorId($id);

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
      });
    </script>
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
                <li><div class="icoturnos"></div><a href="../turnos/">Turnos</a></li>
                <li><div class="icoventas"></div><a href="../ventas/">Ventas</a></li>
                <li><div class="icousuarios"></div><a href="index.php">Clientes</a></li>
                <li><div class="icoproductos"></div><a href="../productos/">Productos</a></li>
                <li><div class="icocontratos"></div><a href="../proveedores/">Proveedores</a></li>
                <li><div class="icoreportes"></div><a href="../reportes/">Reportes</a></li>
                <li><div class="icosalir"></div><a href="../salir/">Salir</a></li>
            </ul>
        </nav>
        
        <div id="infoMenu">
            <p>Información del Menu</p>
        </div>
        <div id="infoDescrMenu">
            <p>La descripción breve de cada item sera detallada aqui, deslizando el mouse por encima de cada menu.</p>
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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar Cliente</p>
        </div>
    	<div class="cuerpoBox">
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">
                	
<!--idcliente,nombre,nrocliente,email,telefono,nrodocumento-->
                	
				              	
                    <div class="form-group col-md-6">
                    	<label for="nombre" class="control-label" style="text-align:left">Nombre</label>
                        <div class="input-group col-md-12">
                            <input type="text" value="<?php echo mysql_result($resCliente,0,'nombre'); ?>" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre..." required>
                        </div>
                    </div>
                    

                    
                    <div class="form-group col-md-6">
                    	<label for="nrocliente" class="control-label" style="text-align:left">NroCliente</label>
                        <div class="input-group col-md-12">
                            <p class="form-control"><?php echo mysql_result($resCliente,0,'nrocliente'); ?></p>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="email" class="control-label" style="text-align:left">E-Mail</label>
                        <div class="input-group col-md-12">
                        	<input type="text" value="<?php echo mysql_result($resCliente,0,'email'); ?>" class="form-control" id="email" name="email" placeholder="Ingrese el E-Mail..." required>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="telefono" class="control-label" style="text-align:left">Telefono</label>
                        <div class="input-group col-md-12">
                        	<input type="text" value="<?php echo mysql_result($resCliente,0,'telefono'); ?>" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el Precio Telefono..." required>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="nrodocumento" class="control-label" style="text-align:left">NroDocumento</label>
                        <div class="input-group col-md-12">
                            <input type="text" value="<?php echo mysql_result($resCliente,0,'nrodocumento'); ?>" class="form-control" id="nrodocumento" name="nrodocumento" placeholder="Ingrese el NroDocumento..." required>
                        </div>
                    </div>


                    </div>
                    </div>
                    
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-warning" id="modificar" style="margin-left:0px;">Modificar</button>
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
                    <div class="alert">
                    
                    </div>
                    <input type="hidden" id="accion" name="accion" value="modificarCliente"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                </form>
                
                <div id="error">
                
                </div>
                <hr>
                <div class="row"> 
		        <div class="col-sm-12 col-md-12">
                <div class="form-group col-md-12">
                    	<label for="saldo" class="control-label" style="text-align:left">Saldo</label>
                        <div class="input-group col-md-4">
                        	<span class="input-group-addon">$</span>
                        	<input type="text" value="<?php echo mysql_result($resCliente,0,'saldo'); ?>" class="form-control" id="saldo" name="saldo" readonly>
                        </div>
                </div>
                
                <div class="form-group col-md-12">
                    	<label for="movimientos" class="control-label" style="text-align:left">Movimientos</label>
                        <div class="input-group col-md-8">
                        	
                        </div>
                </div>
                
                
                </div>
                </div>
                
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
    $('#modificar').click(function(){
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
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong>Cliente</strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "modificar.php?id="+$('#id').val();
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
