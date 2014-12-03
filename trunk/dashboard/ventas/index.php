<?php

session_start();

if (!isset($_SESSION['usua_se']))
{
	header('Location: /lacalderadeldiablo/vistas/');
} else {

require '../../includes/funcionesHTML.php';
require '../../includes/funcionesProductos.php';
require '../../includes/funcionesVentas.php';
require '../../includes/funcionesClientes.php';

$serviciosHTML = new ServiciosHTML();
$serviciosProductos = new ServiciosProductos();
$resProveedores = $serviciosProductos->traerProveedores();

$resProductos = $serviciosProductos->traerProductos();
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
		label {
			margin-left:20px;
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
    
    <link rel="stylesheet" href="../../css/chosen.css">
</head>

<body>



 
<?php echo $serviciosHTML->menu($_SESSION['usua_se'],"Ventas"); ?>

<div id="ingoGral" style=" margin-left:240px; padding-top:20px;">



    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Cargar Venta</p>
        </div>
    	<div class="cuerpoBox">
        <form class="form-horizontal formulario" role="form">
                	
                <!--proveedor,direccion, telefono, cuit, nombre, email -->
                <div class="row" style="padding-left:20px; padding-right:20px;">
                	<button type="button" class="btn btn-primary" id="limpiar" style="margin-left:0px;">Limpiar</button>
                </div>
                <div class="row" style="padding-left:20px; padding-right:20px;">
                	<div class="form-group col-md-3">
                    	<label for="codbarra" class="control-label" style="text-align:left">Codigo Barra</label>
                        <div class=" col-md-12">
                        	<input type="text" class="form-control" id="codbarra" maxlength="15" name="codbarra" placeholder="Ingrese el Codigo Barra..." required>
                        </div>
                    </div>
                    <input type="hidden" id="idprod" name="idprod" value=""/>
                    <div class="form-group col-md-5">
                    	<label for="cod" class="control-label" style="text-align:left">Codigo</label>
                        <div class=" col-md-12">
                        	<select data-placeholder="selecione el producto..." id="idproducto" name="idproducto" class="chosen-select" style=" padding:5px;" tabindex="2">
            					<option value=""></option>
                                <?php while ($rowC = mysql_fetch_array($resProductos)) { ?>
                                	<option value="<?php echo $rowC[0]; ?>"><?php echo 'Codigo: '.$rowC[8].' - Nombre: '.$rowC[1]; ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                    	<label for="cantidad" class="control-label" style="text-align:left">Cantidad</label>
                        <div class=" col-md-12">
                        	<input type="number" class="form-control" id="cantidad" name="cantidad" value="1" placeholder="Cantidad..." required>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                    	<label for="precio" class="control-label" style="text-align:left">Precio</label>
                        <div class="col-md-12">
                        	<input type="number" class="form-control" id="precio" name="precio" placeholder="Precio..." required>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row" style="background-color: #CCC;margin-left:20px; margin-right:20px; padding:10px; border:1px solid #333; margin-bottom:10px;">
                	<h4>Datos del Producto</h4>
                    <div class="col-md-4">
                    	<label for="productos" class="control-label" style="text-align:left">Producto</label>
                        <div class="col-md-12">
                        	<p id="producto"></p>
                        </div>
                    </div>
                	
                    <div class="col-md-4">
                    	<label for="caracteristica" class="control-label" style="text-align:left">Caracteristicas</label>
                        <div class="col-md-12">
                        	<p id="carateristicas"></p>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                    	<label for="stocks" class="control-label" style="text-align:left">Stock</label>
                        <div class="col-md-12">
                        	<p id="stock"></p>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                    	<label for="precios" class="control-label" style="text-align:left">Precio</label>
                        <div class="col-md-12">
                        	<p id="precioprod"></p>
                        </div>
                    </div>
                </div>
                    
                    
                    <ul class="list-inline">
                    	<li>
                    		<button type="button" class="btn btn-success" id="agregar" style="margin-left:0px;">Agregar</button>
                        </li>
                        
   
                    </ul>
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> El campo precio y cantidad son obligatorio</p>
                	</div>
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            	<th>Id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="detalle">
                        
                        </tbody>
                        <tfoot>
                        	<tr style="background-color:#CCC; font-weight:bold; font-size:18px;">
                            	<td colspan="4" align="right">
                                	Total $
                                </td>
                                <td>
                                	<input type="text" readonly name="total" id="total" value="0" style="border:none; background-color:#CCC;"/>
                                </td>
                            </tr>
                        </tfoot>
                	</table>
                    
                    <ul class="list-inline">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Cargar Venta</button>
                        </li>
                        
   
                    </ul>
                </form>
                
                <br>
                
        </div>
    </div>

    
   

</div>

<div id="dialog2" title="Eliminar Proveedor">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar al Proveedor?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>También se borrara la relación con los productos asociados</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#idproducto').live('change', function () {
        //alert($(this).val());
		$.ajax({
					data:  {idproducto: $(this).val(),
							accion: 'traerProductoVenta'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							
					},
					success:  function (response) {
						if (response == '') {
							$('#precio').val('');
							$('#precioprod').html('');
							$('#producto').html('');
							$('#stock').html('');
							$('#carateristicas').html('');
							$('#idprod').val();
						} else {
							prod = response.split('##');
							$('#precio').val(prod[1]);
							$('#precioprod').html(prod[1]);
							$('#producto').html(prod[0]);
							$('#stock').html(prod[2]);
							$('#carateristicas').html(prod[5]);
							$('#idprod').val(prod[6]);
						}
					}
			});
    });
	
	
	function SumarTabla() {
		var suma = 0;
		$('.detalle tr').each(function(){
			suma += parseFloat($(this).find('td').eq(3).text()||0,10); //numero de la celda 3
		})
		return suma;

	  }
	  
	//elimina una fila
	  $(document).on("click",".eliminarfila",function(){
		var padre = $(this).parents().get(1);

		$(padre).remove();
		
		$('#total').val(SumarTabla());
	  });
	  
		  
	function insertarDetalle(id, producto, cantidad, monto) {
		$.ajax({
			data:  {id: id,
					producto: producto,
					cantidad: cantidad,
					monto: monto,
					tipoventa: 1,
					usuacrea: '<?php echo $_SESSION['usua_se']; ?>',
					accion: 'insertarDetalle'},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
					
			},
			success:  function (response) {
				//ver que pasa
			}
		});
	}
	
	$('#cargar').click(function(e) {
        $('.detalle tr').each(function(){

			insertarDetalle(parseInt($(this).find('td').eq(0).text()||0,10),$(this).find('td').eq(1).text(),parseInt($(this).find('td').eq(2).text()||0,10),parseFloat($(this).find('td').eq(3).text()||0,10));
						
		})
		
		$(".alert").removeClass("alert-danger");
		$(".alert").removeClass("alert-info");
		$(".alert").addClass("alert-success");
		$(".alert").html('<strong>Ok!</strong> Se cargo exitosamente la <strong>Venta</strong>. ');
		$(".alert").delay(3000).queue(function(){
			/*aca lo que quiero hacer 
			  después de los 2 segundos de retraso*/
			$(this).dequeue(); //continúo con el siguiente ítem en la cola
			
		});
		$("#load").html('');
		url = "index.php";
		//$(location).attr('href',url);
											
    });
	
	
	$('#agregar').click(function(e) {
		monto = parseFloat($('#precio').val()) * parseInt($('#cantidad').val());
        $('.detalle').prepend('<tr><td>'+$('#idprod').val()+'</td><td>'+$('#producto').html()+' '+$('#carateristicas').html()+'</td><td>'+$('#cantidad').val()+'</td><td>'+monto+'</td><td><button type="button" class="btn btn-danger eliminarfila" id="eliminar" style="margin-left:0px;">Eliminar</button></td></tr>');
		
		$('#total').val(SumarTabla());
    });
	
	
	$('.ver').click(function(event){
			url = "ver.php";
			$(location).attr('href',url);
	});//fin del boton eliminar
	
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
									data:  {id: $('#idEliminar').val(), accion: 'eliminarProveedores'},
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

	$("#proveedor").click(function(event) {
		$("#proveedor").removeClass("alert-danger");
		$("#proveedor").attr('value','');
		$("#proveedor").attr('placeholder','Ingrese el Proveedor...');
    });

	$("#proveedor").change(function(event) {
		$("#proveedor").removeClass("alert-danger");
		$("#proveedor").attr('placeholder','Ingrese el Proveedor');
	});
	
	function validador(){

			$error = "";

			
			if ($("#proveedor").val() == "") {
				$error = "Es obligatorio el campo proveedor.";
				$("#proveedor").addClass("alert-danger");
				$("#proveedor").attr('placeholder',$error);
			}


			return $error;
    }
	
	function limpiar() {
		$('#precio').val('');
		$('#precioprod').html('');
		$('#producto').html('');
		$('#stock').html('');
		$('#carateristicas').html('');
		$('#codbarra').val('');
		$('#cantidad').val('1');
		$('#idprod').val();
	}
	
	$('#limpiar').click(function(){
		limpiar();
	});
	
	
	$('#codbarra').keypress(function() {
		//alert($(this).val().length);
		
        if ($(this).val().length >12) {

			
			$.ajax({
					data:  {idproducto: $("#codbarra").val(),
							accion: 'traerProductoVentaBarra'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							
					},
					success:  function (response) {
						if (response == '') {
							$('#precio').val('');
							$('#precioprod').html('');
							$('#producto').html('');
							$('#stock').html('');
							$('#carateristicas').html('');
							$('#idprod').val();
						} else {
							prod = response.split('##');
							$('#precio').val(prod[1]);
							$('#precioprod').html(prod[1]);
							$('#producto').html(prod[0]);
							$('#stock').html(prod[2]);
							$('#carateristicas').html(prod[5]);
							$('#idprod').val(prod[6]);
						}
					}
			});
		}
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
