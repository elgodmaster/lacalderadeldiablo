<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Productos',$_SESSION['rol_se']);

$id = $_GET['id'];
require '../../includes/funcionesProductos.php';


$serviciosProductos = new ServiciosProductos();


$resTipoProducto = $serviciosProductos->traerTipoProductoPorId($id);

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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar Tipo Producto</p>
        </div>
    	<div class="cuerpoBox">
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">


        <!--idtipoproducto ,tipoproducto, activo -->    

				<div class="row">
      				<div class="form-group col-md-3">
                    	<label for="tipoproducto" class="control-label" style="text-align:left">Tipo De Producto</label>
                        <div class="input-group col-md-12">
                        	<input type="text" value="<?php echo mysql_result($resTipoProducto,0,'tipoproducto'); ?>" class="form-control" id="tipoproducto" name="tipoproducto" placeholder="Ingrese el Tipo de Producto..." required>
                           
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                            <label for="tipoproducto" class="control-label" style="text-align:left">Estado</label>
                            <div class="input-group col-md-12">
                                <select class="form-control" id="reftipoproducto" name="reftipoproducto">
									<?php if (mysql_result($resTipoProducto,0,'activo') == 1) { ?>
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Inactivo</option>
                                    <?php } else { ?>
                                    <option value="1" >Activo</option>
                                    <option value="0" selected>Inactivo</option>
                                    <?php } ?>
                           		</select>
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
                    <div id="error" class="alert alert-info">
                        <p><strong>Importante!:</strong> El campo Tipo Producto es obligatorios</p>
                    </div>
                    <input type="hidden" id="accion" name="accion" value="modificarTipoProducto"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>

                        
        </form>
        </div>
        </div>
        </div>
        
    </div>

<div id="dialog2" title="Eliminar tipoProducto">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el Tipo de Producto?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>También se borrara la relación con los productos asociados</p>
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
// idtipoproducto ,tipoproducto, activo 
			
			if ($("#tipoproducto").val() == "") {
				$error = "Es obligatorio el campo tipoproducto.";
				$("#tipoproducto").addClass("alert-danger");
				$("#tipoproducto").attr('placeholder',$error);
			}
			
			if ($("#activo").val() == "") {
				$error = "Es obligatorio el campo activo.";
				$("#activo").addClass("alert-danger");
				$("#activo").attr('placeholder',$error);
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

					if (data != '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong>Producto</strong>. ');
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
	
	function existeCodigo(codigo) {
		$.ajax({
			data:  {codigo:	$("#codigo").val(),
					id:	<?php echo $id; ?>,
					accion:	'existeCodigoMod'},
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
