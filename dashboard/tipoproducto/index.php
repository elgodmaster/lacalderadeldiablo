<?php
session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Productos',$_SESSION['rol_se']);

require '../../includes/funcionesProductos.php';


$serviciosProductos = new ServiciosProductos();

$resTipoProducto = $serviciosProductos->traerTipoProducto();


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
    
<script src="../../js/dashboard.js"></script>
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


 <?php echo $resMenu; ?>



<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">

	<div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Nuevo Tipo Producto</p>
        </div>
    	<div class="cuerpoBox">
        
 <!--idtipoproducto ,tipoproducto, activo -->       
        	<div class="row"> 
        		<div class="col-sm-12 col-md-12">
            		<form class="form-inline formulario" role="form">
                    	
                        
                        <div class="form-group col-md-6">
                            <label for="tipoproducto" class="control-label" style="text-align:left">Tipo de Producto</label>
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="tipoproducto" name="tipoproducto" placeholder="Ingrese el Tipo Producto..." required>
                            </div>
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                            <label for="tipoproducto" class="control-label" style="text-align:left">Estado</label>
                            <div class="input-group col-md-12">
                                <select class="form-control" id="activo" name="activo">
									<option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                           		</select>
                            </div>
                        </div>
                        
                        <ul class="list-inline" style="padding-top:15px;">
                            <li>
                                <button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Crear</button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-success" id="productos" style="margin-left:0px;">Volver a Productos</button>
                            </li>
       
                        </ul>
                        <div id="load">
                        
                        </div>
                        <div id="error" class="alert alert-info">
                            <p><strong>Importante!:</strong> El campo Tipo Producto es obligatorios</p>
                        </div>
                        <input type="hidden" id="accion" name="accion" value="insertarTipoProducto"/>
                        
                    </form>
            	</div>
            </div>
            
            
            
            
        </div>
        
    </div>

	
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimos 10 Tipos de Productos cargados</p>
        </div>
    	<div class="cuerpoBox">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Tipo Producto</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            	<tbody>
<!--idtipoproducto ,tipoproducto, activo -->
                    <?php
						if (mysql_num_rows($resTipoProducto)>0) {
							while ($row = mysql_fetch_array($resTipoProducto)) {
					?>
                    		<tr>
                            	<td>
                                	<?php echo $row['tipoproducto']; ?>
                                </td>
                                <td>
                                	<?php 
										if ($row['activo'] == 1) {
											echo "Activo";
										}else{
											echo "Inactivo";
										}
									?>
                                </td>
                                <td>
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idtipoproducto']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idtipoproducto']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                            </tr>
                    
                    <?php
							}
						} else {
					?>
                    	<tr>
                        	<td colspan="2">No hay Tipos de Productos Cargados.</td>
                        </tr>
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

</div><!-- fin del div infoGral -->

<div id="dialog2" title="Eliminar Producto">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el Tipo de Producto?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>También se borrara la relación con los productos asociados</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.ver').click(function(event){
			url = "ver.php";
			$(location).attr('href',url);
	});//fin del boton ver
	
	
	$('#productos').click(function(event){
			url = "../productos/";
			$(location).attr('href',url);
	});//fin del boton para volver a productos
	
	
	$('.varborrar').click(function(event){
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
	
	$('.varmodificar').click(function(event){
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
									data:  {id: $('#idEliminar').val(), accion: 'eliminarTipoProducto'},
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

	// idtipoproducto ,tipoproducto, activo 

	$("#tipoproducto").click(function(event) {
		if ($("#tipoproducto").val() == "") {
			$("#tipoproducto").removeClass("alert-danger");
			$("#tipoproducto").attr('value','');
			$("#tipoproducto").attr('placeholder','Ingrese el Tipo de Productotipoproducto...');
		}
    });

	$("#tipoproducto").change(function(event) {
		if ($("#tipoproducto").val() == "") {
			$("#tipoproducto").removeClass("alert-danger");
			$("#tipoproducto").attr('placeholder','Ingrese el Tipo de Producto');
		}
	});
	
	$("#activoactivo").click(function(event) {
		if ($("#activo").val() == "") {
			$("#activo").removeClass("alert-danger");
			$("#activo").attr('value','');
			$("#activo").attr('placeholder','Ingrese el Estado...');
		}
    });

	
	function validador(){

			$error = "";
// idtipoproducto ,tipoproducto, activo 
			
			if ($("#tipoproducto").val() == "") {
				$error = "Es obligatorio el campo Tipo de Producto.";
				$("#tipoproducto").addClass("alert-danger");
				$("#tipoproducto").attr('placeholder',$error);
			}
			
			if ($("#activo").val() == "") {
				$error = "Es obligatorio el campo Estado.";
				$("#activo").addClass("alert-danger");
				$("#activo").attr('placeholder',$error);
			}
			
			
			return $error;
    }
	
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

					if (data != '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Producto</strong>. ');
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
	
	function existeCodigo(codigo) {
		$.ajax({
			data:  {codigo:	$("#codigo").val(),
					accion:	'existeCodigo'},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
			},
			success:  function (response) {
					
					if (response == '') {
						
						$("#load").html('');
						$("#codigo").val('');
						$error = "Ya existe ese codigo.";
						$("#codigo").addClass("alert-danger");
						$("#codigo").attr('placeholder',$error);
						$("#errorCodigo").html('');
						$("#errorCodigo").html('<strong>Error!</strong> El codigo ya existe');

					} else {
						$("#load").html('');
						$("#errorCodigo").html('');
						$("#errorCodigo").html('<strong>Ok!</strong> El codigo se puede utilizar');
						
					}
					
			}
		});
	}
	
	$('#codigo').focusout(function(e) {
        existeCodigo($( this ).val());
    });

});//fin del document ready
</script>

<?php } ?>

</body>
</html>