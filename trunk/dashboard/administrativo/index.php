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

$resProductos = $serviciosProductos->traerProductos();

$resProveedores = $serviciosProductos->traerProveedores();

$resTipoProducto = $serviciosProductos->traerTipoProducto();

$importes = $serviciosAdministrativo->traerMontosAdministrativos(date('Y'),date('m'));

$resAdministrativos = $serviciosAdministrativo->traerAdministrato();

$resAdministrativosAnioMes = $serviciosAdministrativo->traerAdministratoMesDia(date('Y'),date('m'));
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
        	<p style="color: #fff; font-size:18px; height:16px;">Administrativo</p>
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
                                	<?php if ($i == date('Y')) { ?>
                                	<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                	<?php } ?>    
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    
                    <div class="form-group col-md-6" align="left">
                    <label for="cancha" class="control-label" style="padding-left:60px;">Mes</label>
                        <div class="input-group col-md-4">
                            <select class="form-control" id="mes" name="mes">
                            	<?php for ($i=1;$i<=12;$i++) { ?>
                                	<?php if ($i == date('m')) { ?>
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
                                    <?php } else { ?>
                                    <option value="<?php echo $i; ?>"><?php
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
                                	<?php } ?> 
										
                                    
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
                            <input type="text" class="form-control" id="importesueldos" name="importesueldos" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="gastosVarios" class="control-label" style="text-align:left">Gastos Varios</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importegastosvarios" value="<?php echo $importes[3]; ?>" name="importegastosvarios" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="mercaderia" class="control-label" style="text-align:left">Mercaderia</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                        	<input type="text" class="form-control" id="importemercaderia" name="importemercaderia" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="gas" class="control-label" style="text-align:left">Gas</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importegas" name="importegas" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="luz" class="control-label" style="text-align:left">Luz</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeluz" name="importeluz" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="T.E" class="control-label" style="text-align:left">T.E</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importetelefono" name="importetelefono" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="agua" class="control-label" style="text-align:left">Agua</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeagua" name="importeagua" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="inmobiliario" class="control-label" style="text-align:left">Inmobiliario</label>
                        <div class="input-group col-md-12">
                        	<span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeinmobiliario" name="importeinmobiliario" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="impVarios" class="control-label" style="text-align:left">Impuestos Varios</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeimpuestos" name="importeimpuestos" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="autonomos" class="control-label" style="text-align:left">Autonomos</label>
                        <div class="input-group col-md-12">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeautonomos" name="importeautonomos" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="ingresosBrutos" class="control-label" style="text-align:left">Ingresos Brutos</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeingresosbrutos" name="importeingresosbrutos" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="aportes" class="control-label" style="text-align:left">Aportes</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importeaportes" name="importeaportes" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="municipal" class="control-label" style="text-align:left">Municipal</label>
                        <div class="input-group col-md-12">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="importesmunicipal" name="importesmunicipal" placeholder="Ingrese un monto..." >
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                
                
                
                    </div>
                    </div>
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante:</strong> Recuerde que los montos de Canchas, Fiestas, Bar y Gastos Varios se calculan solos.</p>
                	</div>
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Cargar</button>
                        </li>

   
                    </ul>
                    <div id="load">
                    
                    </div>
                    
                   <input type="hidden" id="accion" name="accion" value="insertarAdministrativo"/>
                </form>
                
                <br>
                
                
        </div>
    </div>

	<div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimos 10 Productos Cargados</p>
        </div>
    	<div class="cuerpoBox">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Canchas</th>
                        <th>Bar</th>
                        <th>Fiestas</th>
                        <th>Sueldo</th>
                        <th>Gas</th>
                        <th>Luz</th>
                        <th>Año</th>
                        <th>Mes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
<!--idproducto,nombre,precio_unit,precio_venta,stock,stock_min,reftipoproducto,refproveedor,codigo,codigobarra,caracteristicas -->
                	<?php
						if (mysql_num_rows($resAdministrativos)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resAdministrativos)) {
								$cant+=1;
								if ($cant == 11) {
									break;	
								}
					?>
                    	<tr>
                        	<td><?php echo $row['importecanchas']; ?></td>
                            <td><?php echo $row['importebar']; ?></td>
                            <td><?php echo $row['importefiestas']; ?></td>
                            <td><?php echo $row['importesueldos']; ?></td>
                            <td><?php echo $row['importegas']; ?></td>
                            <td><?php echo $row['importeluz']; ?></td>
                            <td><?php echo $row['anio']; ?></td>
                            <td><?php echo $row['mes']; ?></td>
                            <td>
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idadministrativo']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idadministrativo']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay datos cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>

            
        </div>
    </div>

</div>
<script>
$(document).ready(function(){


	$('#buscar').click(function() {
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
	});

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
	
	$('.ver').click(function(event){
			url = "ver.php";
			$(location).attr('href',url);
	});//fin del boton eliminar
	
//al enviar el formulario
    $('#cargar').click(function(){

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

					if (data == '') {
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
											//$(location).attr('href',url);
                                            
											
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
