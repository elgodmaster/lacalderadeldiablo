<?php

session_start();

if ((!isset($_SESSION['usua_se'])) || ($_SESSION['rol_se']!= 'SuperAdministrador'))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
$serviciosHTML = new ServiciosHTML();
$resMenu = $serviciosHTML->menu($_SESSION['usua_se'],'Administrativo',$_SESSION['rol_se']);


require '../../includes/funcionesProductos.php';
require '../../includes/funcionesAdministrativo.php';

$serviciosProductos = new ServiciosProductos();
$serviciosAdministrativo = new ServiciosAdministrativo();

$id = $_GET['id'];

$resProductos = $serviciosProductos->traerProductos();

$resProveedores = $serviciosProductos->traerProveedores();

$resTipoProducto = $serviciosProductos->traerTipoProducto();

$resAdministrativos = $serviciosAdministrativo->traerAdministratoId($id);

$importes = $serviciosAdministrativo->traerMontosAdministrativos(date('Y'),date('m'));
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
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar Administracion</p>
        </div>
    	<div class="cuerpoBox">
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">
                	
<!--cancha, bar, sueldo, gastos varios, mercaderia, gas, luz, T.E , agua, inmobiliario, imp. varios, autonomos, ingresos brutos, aportes, municipal -->
                	
				    <div class="form-group col-md-6" align="right">
                    	<label for="cancha" class="control-label" style=" padding-right:60px;">Año</label>
                        <div class="input-group col-md-4">
                        	<select class="form-control" id="anio" name="anio">
                            	<?php for ($i=2010;$i<2018;$i++) { ?>
                                	<?php if ($i == mysql_result($resAdministrativos,0,'anio')) { ?>
                                	<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                    <?php }  ?>
  
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    
                    <div class="form-group col-md-6" align="left">
                    <label for="cancha" class="control-label" style="padding-left:60px;">Mes</label>
                        <div class="input-group col-md-4">
                            <select class="form-control" id="mes" name="mes">
                            	<?php for ($i=1;$i<=12;$i++) { ?>
                                	<?php if ($i == mysql_result($resAdministrativos,0,'mes')) { ?>
                                	<option value="<?php echo $i; ?>" selected><?php
											switch ($i) {
												case 1:
													echo 'Enero';
													break;
												case 2:
													echo 'Febrero';
													break;
												case 3:
													echo 'Marzo';
													break;
												case 4:
													echo 'Abril';
													break;
												case 5:
													echo 'Mayo';
													break;
												case 6:
													echo 'Junio';
													break;
												case 7:
													echo 'Julio';
													break;
												case 8:
													echo 'Agosto';
													break;
												case 9:
													echo 'Septiembre';
													break;
												case 10:
													echo 'Octubre';
													break;
												case 11:
													echo 'Noviembre';
													break;
												case 12:
													echo 'Diciembre';
													break;	
											}
										?></option>
                                    <?php }  ?>
                               
										
                                    
                                <?php } ?>
                            </select>
                        </div>
				    </div>
                    
                    
                    
                     	
                	<div class="form-group col-md-6">
                    	<label for="cancha" class="control-label" style="text-align:left">Cancha</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importecanchas" name="importecanchas" value="<?php echo $importes[0]; ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                    	<label for="cancha" class="control-label" style="text-align:left">Fiestas</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importefiestas" name="importefiestas" value="<?php echo $importes[2]; ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="bar" class="control-label" style="text-align:left">Bar</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importebar" name="importebar" value="<?php echo $importes[1]; ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="sueldo" class="control-label" style="text-align:left">Sueldo</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importesueldos" value="<?php echo mysql_result($resAdministrativos,0,'importesueldos'); ?>" name="importesueldos" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="gastosVarios" class="control-label" style="text-align:left">Gastos Varios</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importegastosvarios"  value="<?php echo $importes[3]; ?>" name="importegastosvarios" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="mercaderia" class="control-label" style="text-align:left">Mercaderia</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                        	<input type="text" class="form-control" id="importemercaderia" name="importemercaderia" value="<?php echo mysql_result($resAdministrativos,0,'importemercaderia'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="gas" class="control-label" style="text-align:left">Gas</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importegas" name="importegas" value="<?php echo mysql_result($resAdministrativos,0,'importegas'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="luz" class="control-label" style="text-align:left">Luz</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeluz" name="importeluz" value="<?php echo mysql_result($resAdministrativos,0,'importeluz'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="T.E" class="control-label" style="text-align:left">T.E</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importetelefono" name="importetelefono" value="<?php echo mysql_result($resAdministrativos,0,'importetelefono'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="agua" class="control-label" style="text-align:left">Agua</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeagua" name="importeagua" value="<?php echo mysql_result($resAdministrativos,0,'importeagua'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="inmobiliario" class="control-label" style="text-align:left">Inmobiliario</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeinmobiliario" name="importeinmobiliario" value="<?php echo mysql_result($resAdministrativos,0,'importeinmobiliario'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="impVarios" class="control-label" style="text-align:left">Impuestos Varios</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeimpuestos" name="importeimpuestos" value="<?php echo mysql_result($resAdministrativos,0,'importeimpuestos'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="autonomos" class="control-label" style="text-align:left">Autonomos</label>
                        <div class="input-group col-md-12">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeautonomos" name="importeautonomos" value="<?php echo mysql_result($resAdministrativos,0,'importeautonomos'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="ingresosBrutos" class="control-label" style="text-align:left">Ingresos Brutos</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeingresosbrutos" name="importeingresosbrutos" value="<?php echo mysql_result($resAdministrativos,0,'importeingresosbrutos'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="aportes" class="control-label" style="text-align:left">Aportes</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeaportes" name="importeaportes" value="<?php echo mysql_result($resAdministrativos,0,'importeaportes'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="municipal" class="control-label" style="text-align:left">Municipal</label>
                        <div class="input-group col-md-12">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importesmunicipal" name="importesmunicipal" value="<?php echo mysql_result($resAdministrativos,0,'importesmunicipal'); ?>" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
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
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante:</strong> Recuerde que los montos de Canchas, Fiestas, Bar y Gastos Varios se calculan solos.</p>
                	</div>
                    <input type="hidden" id="accion" name="accion" value="modificarAdministrativo"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                </form>
                
                <br>
                <div id="error">
                
                </div>
        </div>
    </div>

    
    

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
									data:  {id: $('#idEliminar').val(), accion: 'eliminarAdministrativo'},
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
			
			
	//al enviar el formulario
    $('#modificar').click(function(){

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
											url = "modificar.php?id=<?php echo $id; ?>";
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
    });//fin del cargar
	
	
	
});
</script>
<?php } ?>
</body>
</html>
