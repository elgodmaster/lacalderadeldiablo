<?

session_start();

if (!isset($_SESSION['adclie_usuario']))
{
	header('Location: /AdministracionClientes/vistas/');
} else {
    
    
$usuarioOnLine = $_SESSION['adclie_usuario'];
//date_default_timezone_set('America/Argentina');
setlocale(LC_ALL,"es_ES");
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S�bado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

set_include_path("../../class");

require "db/Singleton.class.php";
require "Validator.class.php";
require "Persona.class.php";

require "cliente/Cliente.class.php";
require "cliente/Factory.class.php";



$errors    =   Array();

try{

        
/*        $parametrosConexion =   Array(
                                        "host"=>"localhost",
                                        "user"=>"root",
                                        "pass"=>"",
                                        "db"=>"dbadministracionclientes"
        );*/
        
       
        $parametrosConexion =   Array(
                                        "host"=>"db494455387.db.1and1.com",
                                        "user"=>"dbo494455387",
                                        "pass"=>"Admin1234",
                                        "db"=>"db494455387"
        );

        /**
         * El patron singleton sirve para mantener una unica instancia de un objeto
         * alrededor de toda la ejecucion de un script.
         */

        $conexion   =   \Db\Singleton::getInstance($parametrosConexion);

        $cliente    =   new Cliente();
       
        

        if(sizeof($_POST)){
            $requiredKeys   =   Array(
                                        "url",
                                        "nombrecompleto",
                                        "formapago",
                                        "acceso"
            );

            Validator::validateArrayKeys($requiredKeys,$_POST);

            try{

                $cliente->setUrl($_POST["url"]);

            }catch(Exception $e){

                $errors[]   =   $e->getMessage();

            }
/*
            try{

                $cliente->setNombreCompleto($_POST["nombrecompleto"]);

            }catch(Exception $e){

                $errors[]  =   $e->getMessage();

            }
       */     

            try{

                $cliente->setRefFormaPago($_POST["formapago"]);

            }catch(Exception $e){

                $errors[]  =   $e->getMessage();

            }



            if(!sizeof($errors)){

                try{

                    echo "Cliente cargado correctamente";

                }catch(Exception $e){

                    $errors[]   =   $e->getMessage();

                }

            }

        }









    }catch(Exception $e){

        //SI el codigo esta siendo ejecutado en el localhost
        echo "error";
        
        $e->getMessage();
        //require "404.php";
        die();
        
    }



?>
<!DOCTYPE HTML>

<html>

<head>

<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type> 

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Ver' />

<meta name='description' content='Sistema Administrador de Clientes' />

<meta name='keywords' content='Sistema Administrador de Clientes' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.administradordelientes.com.ar' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />



<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>



<title>Administrador de Clientes</title>



		<link rel="stylesheet" type="text/css" href="../../css/estilo.css"/>

		<script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="../../css/jquery-ui.css"/>

		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <script type="text/javascript" src="../../js/jquery.jparallax.min.js" ></script>

        <script type="text/javascript" src="../../js/jquery.event.frame.js" ></script>

        

        <link rel="stylesheet" href="../../js/source/jquery.fancybox.css" type="text/css" media="screen" />

        <script type="text/javascript" src="../../js/source/jquery.fancybox.pack.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>

        <script>
        	$(document).ready(function(){

        			$("#url").click(function(event) {
        			$("#url").removeClass("alert-danger");
        			$("#url").attr('value','http://');
        			});

        			$("#url").change(function(event) {
        			$("#url").removeClass("alert-danger");
        			$("#url").attr('placeholder','Ingrese la Url');
        			});
					
					
					
					
					$("#nombre").click(function(event) {
        			$("#nombre").removeClass("alert-danger");
        			$("#nombre").attr('value','');
        			});

        			$("#nombre").change(function(event) {
        			$("#nombre").removeClass("alert-danger");
        			$("#nombre").attr('placeholder','Ingrese el nombre');
        			});
					
					
					
					
					$("#direccion").click(function(event) {
        			$("#direccion").removeClass("alert-danger");
        			$("#direccion").attr('value','');
        			});

        			$("#direccion").change(function(event) {
        			$("#direccion").removeClass("alert-danger");
        			$("#direccion").attr('placeholder','Ingrese la direcci�n');
        			});
					
					
					
					
					
					$("#ciudad").click(function(event) {
        			$("#ciudad").removeClass("alert-danger");
        			$("#ciudad").attr('value','');
        			});

        			$("#ciudad").change(function(event) {
        			$("#ciudad").removeClass("alert-danger");
        			$("#ciudad").attr('placeholder','Ingrese la ciudad/provincia');
        			});
					
					
					
					
					
					
					$("#pais").click(function(event) {
        			$("#pais").removeClass("alert-danger");
        			$("#pais").attr('value','');
        			});

        			$("#pais").change(function(event) {
        			$("#pais").removeClass("alert-danger");
        			$("#pais").attr('placeholder','Ingrese el pa�s');
        			});




					
					$("#nif").click(function(event) {
        			$("#nif").removeClass("alert-danger");
        			$("#nif").attr('value','');
        			});

        			$("#nif").change(function(event) {
        			$("#nif").removeClass("alert-danger");
        			$("#nif").attr('placeholder','Ingrese el nif/cif');
        			});
					
					
					
					
					
					
					$("#telefonofijo").click(function(event) {
        			$("#telefonofijo").removeClass("alert-danger");
        			$("#telefonofijo").attr('value','');
        			});

        			$("#telefonofijo").change(function(event) {
        			$("#telefonofijo").removeClass("alert-danger");
        			$("#telefonofijo").attr('placeholder','Ingrese el tel�fono fijo');
        			});





					$("#telefonomovil").click(function(event) {
        			$("#telefonomovil").removeClass("alert-danger");
        			$("#telefonomovil").attr('value','');
        			});

        			$("#telefonomovil").change(function(event) {
        			$("#telefonomovil").removeClass("alert-danger");
        			$("#telefonomovil").attr('placeholder','Ingrese el tel�fono movil');
        			});


        		function validador(){

        				$error = "";

        				if ($("#url").val() == "") {
        					$error = "Es obligatorio el campo Url.";
        					$("#url").addClass("alert-danger");
        					$("#url").attr('placeholder',$error);
        				}
						
						if ($("#nombre").val() == "") {
        					$error = "Es obligatorio el campo Nombre.";
        					$("#nombre").addClass("alert-danger");
        					$("#nombre").attr('placeholder',$error);
        				}
						
						if ($("#direccion").val() == "") {
        					$error = "Es obligatorio el campo direccion.";
        					$("#direccion").addClass("alert-danger");
        					$("#direccion").attr('placeholder',$error);
        				}
						
						
						if ($("#ciudad").val() == "") {
        					$error = "Es obligatorio el campo ciudad/provincia.";
        					$("#ciudad").addClass("alert-danger");
        					$("#ciudad").attr('placeholder',$error);
        				}
						
						if ($("#pais").val() == "") {
        					$error = "Es obligatorio el campo pa�s.";
        					$("#pais").addClass("alert-danger");
        					$("#pais").attr('placeholder',$error);
        				}
						
						if ($("#nif").val() == "") {
        					$error = "Es obligatorio el campo nif/cif.";
        					$("#nif").addClass("alert-danger");
        					$("#nif").attr('placeholder',$error);
        				}
						
						if ($("#telefonofijo").val() == "") {
        					$error = "Es obligatorio el campo tel�fono fijo.";
        					$("#telefonofijo").addClass("alert-danger");
        					$("#telefonofijo").attr('placeholder',$error);
        				}
						
						
						if ($("#telefonomovil").val() == "") {
        					$error = "Es obligatorio el campo tel�fono movil.";
        					$("#telefonomovil").addClass("alert-danger");
        					$("#telefonomovil").attr('placeholder',$error);
        				}
						

        				if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test($("#url").val())) {
						  $error += "";
						} else {
						
						  $error = $error+"- La Url no es valida.";
						  $("#url").val('http://');
						  $("#url").focus();
						  $("#url").addClass("alert-danger");
        				  $("#url").attr('placeholder',$error);
						}

        				return $error;
        		}

        		$("#cargar").click(function(event) {
        				if (validador() == "")
        				{
        						$.ajax({
                                data:  {url: $("#url").val(),
										formapago:		$("#formapago").val(),
										acceso:			$("#acceso").is(':checked') ? 1 : 0, 
										nombre:			$("#nombre").val(),
										direccion:		$("#direccion").val(),
										ciudad:			$("#ciudad").val(),
										pais:			$("#pais").val(),
										nif:			$("#nif").val(),
										telefonofijo:	$("#telefonofijo").val(),
										telefonomovil:	$("#telefonomovil").val(),
										accion: 		'cargarCliente'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
                                    
                                        if (response == '') {
                                            $(".alert").removeClass("alert-info");
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-success");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Cliente</strong>. ');
                                            $("#load").html('');

                                        } else {
                                        	$(".alert").removeClass("alert-info");
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-success");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+response);
                                            $("#load").html('');
                                            $("#url").val('http://');
                                        }
                                        
                                }
                        });
        				}
        		});

        	});
        </script>
      
</head>



<body style="background-color: #edede4;">

<div id="header">
	<img src="../../imagenes/LogoSEO1.png" width="396" height="89"> 
    <div style=" margin-left:50%; margin-top:-65px; height:30px;">
        <h3 style=" background:url(../../imagenes/user-icon.png) no-repeat; background-position:left; padding-left:35px;height:30px;color: #dedede;">Hola <? echo $usuarioOnLine; ?> | <a href="../../vistas/logout.php">Logout</a></h3>
    </div>
</div>


<div id="menu">
<ul class="nav nav-tabs" style="background-image: -webkit-gradient(
	linear,
	left top,
	left bottom,
	color-stop(0, #686C6E),
	color-stop(1, #8D9293)
);
background-image: -o-linear-gradient(bottom, #686C6E 0%, #8D9293 100%);
background-image: -moz-linear-gradient(bottom, #686C6E 0%, #8D9293 100%);
background-image: -webkit-linear-gradient(bottom, #686C6E 0%, #8D9293 100%);
background-image: -ms-linear-gradient(bottom, #686C6E 0%, #8D9293 100%);
background-image: linear-gradient(to bottom, #686C6E 0%, #8D9293 100%);
background-color:#686C6E;
padding-left:100px;">
  <li><a href="../principal/">Principal</a></li>
  <li class="active"><a href="../clientes/">Web</a></li>
  <li><a href="../distribuidores/">Distribuidores</a></li>
  <li><a href="../crearcliente/">Crear Nuevo Cliente</a></li>
  <li><a href="../usuarios/">Usuarios</a></li>
  <li><a href="../datosfacturacion/">Datos de Facturaci�n</a></li>
</ul>
</div>

<div class="donde">
    <ul class="breadcrumb">
        <li><a href="../clientes/">Web</a></li>
        <li class="active">Crear Clientes</li>
    </ul>
</div>

<h3>Crear Cliente</h3>

<div class="content" align="center">
		<div class="panel panel-info" style="width:700px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Formulario de carga de Clientes.</h3>
		</div>
			<div class="panel-body">

			<div id="load"></div>

				<form role="form" method="POST" action="">
				
					<div class="form-group">
						<label for="Url">Url</label>
						<input id="url" name="url" class="form-control" type="url" placeholder="Ingrese la Url, comenzando con http://">
					</div>
					
					<div class="form-group">
						<label for="formapago">Seleccione la Forma de Pago</label>
						<select class="form-control" id="formapago" name="formapago">
						    <option value="1">Paypal</option>
						    <option value="2">Transferencia</option>
						</select>
					</div>
					
					<div class="form-group">
						<div class="radio">
						  <label>
						    <input type="checkbox" name="acceso" id="acceso">
						    Seleccione si se va a tener acceso a este cliente.
						  </label>
						</div>
					</div>
					<br>
                    <div style="font-family:Verdana, Geneva, sans-serif; color: #03F; font-size:16px; text-decoration:underline; font-weight:bold; letter-spacing:2px;" align="center">
						Datos de Facturaci�n
					</div>
                    <br>
                    
                    <div class="form-group">
						<label for="Nombre">Nombre</label>
						<input id="nombre" name="nombre" class="form-control" type="txt" placeholder="Ingrese el Nombre">
					</div>
                    
                    <div class="form-group">
						<label for="direccion">Direcci�n</label>
						<input id="direccion" name="direccion" class="form-control" type="txt" placeholder="Ingrese la direcci�n">
					</div>
                    
                    <div class="form-group">
						<label for="ciudad/provincia">Ciudad/Provincia</label>
						<input id="ciudad" name="ciudad" class="form-control" type="txt" placeholder="Ingrese la ciudad/provincia">
					</div>
                    
                    <div class="form-group">
						<label for="pais">Pa�s</label>
						<input id="pais" name="pais" class="form-control" type="txt" placeholder="Ingrese el Pa�s">
					</div>
                    
                    <div class="form-group">
						<label for="nif/cif">Nif/Cif</label>
						<input id="nif" name="nif" class="form-control" type="txt" placeholder="Ingrese el Nif/Cif">
					</div>
                    
                    <div class="form-group">
						<label for="telefonofijo"><span class="glyphicon glyphicon-earphone"> </span> Tel�fono Fijo</label>
						<input id="telefonofijo" name="telefonofijo" class="form-control" type="txt" placeholder="Ingrese el Tel�fono Fijo">
					</div>
                    
                    
                    <div class="form-group">
						<label for="telefonomovil"><span class="glyphicon glyphicon-phone"></span> Tel�fono Movil </label>
						<input id="telefonomovil" name="telefonomovil" class="form-control" type="txt" placeholder="Ingrese el Tel�fono Movil">
					</div>
                    
                    
					<button id="cargar" class="btn btn-default" type="button">Cargar</button>
					<div id="loading"></div>
					<br>
					<br>
					<div class="alert alert-info">
					<strong>Importante!</strong>
					Es necesario completar todos los campos para poder cargar el <strong>Cliente</strong>. Muchas Gracias.
					</div>
				</form>

			</div>
	</div>
</div>
</body>

</html>
<?

}
?>