<?php
set_include_path("class");

require 'includes/funcionesUsuarios.php';

$serviciosUsuarios = new ServiciosUsuarios();



?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Ver' />

<meta name='description' content='La Caldera del Diablo' />

<meta name='keywords' content='La Caldera del Diablo' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.lacalderadeldiablo.com.ar' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />



<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>La Caldera del Diablo</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="js/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
		
			$(document).ready(function(){
				
				
					$("#email").click(function(event) {
        			$("#email").removeClass("alert alert-danger");
					$("#email").attr('placeholder','Ingrese el email');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert alert-danger");
        			$("#email").attr('placeholder','Ingrese el email');
        			});
					
					
					$("#pass").click(function(event) {
        			$("#pass").removeClass("alert alert-danger");
					$("#pass").attr('placeholder','Ingrese el password');
        			});

        			$("#pass").change(function(event) {
        			$("#pass").removeClass("alert alert-danger");
        			$("#pass").attr('placeholder','Ingrese el password');
        			});
					
				
				function validador(){

        				$error = "";
		
        				if ($("#email").val() == "") {
        					$error = "Es obligatorio el campo E-Mail.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").attr('placeholder',$error);
        				}
						
						if ($("#pass").val() == "") {
        					$error = "Es obligatorio el campo Password.";

        					$("#pass").addClass("alert alert-danger");
        					$("#pass").attr('placeholder',$error);
        				}
						

						
						
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email").val() ) ) {
							$error = "El E-Mail ingresado es inválido.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
						  }

        				return $error;
        		}
				
				
				$("#login").click(function(event) {
        			
						if (validador() == "")
        				{
        						$.ajax({
                                data:  {email:		$("#email").val(),
										pass:		$("#pass").val(),
										accion:		'login'},
                                url:   'ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response != '') {
                                            
                                            $("#error").removeClass("alert alert-danger");

                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> '+response);
                                            $("#load").html('');

                                        } else {
											url = "dashboard/";
											$(location).attr('href',url);
										}
                                        
                                }
                        });
        				}
        		});
				
			});/* fin del document ready */
		
		</script>
        
        
</head>



<body>




<div class="logueo" align="center">
<br>
<br>
<br>
	<section style="width:700px; padding-top:10px; padding-top:60px; background-color:#333; border:1px solid #101010; padding:25px;box-shadow: 4px 4px 5px #464646;-webkit-box-shadow: 4px 4px 5px #464646;
  -moz-box-shadow: 4px 4px 5px #464646;">

			<div id="error" style="text-align:left;">
            
            </div>

            <div align="center">
				<div align="center"><p style="color:#E9E9E9; font-size:28px;">Acceso al panel de control de La Caldera del Diablo</p></div>
                <br>
            </div>
			<form role="form" class="form-horizontal">
              
             <!--
                <label for="usuario" class="col-md-2 control-label" style="color:#FFF">Usuario</label>
                <br>
                  <input type="text" name="usuario" maxlength="50" />
                <br>
              

              
                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF">Contraseña</label>
                <br>
                  
                  <input type="password" name="password" maxlength="50" />
                <br>
              
             
              
                
                  <input type="submit" value="enviar">
                -->
              <div class="form-group">
                <label for="usuario" class="col-md-2 control-label" style="color:#FFF;text-align:left;">E-Mail</label>
                <div class="col-lg-10">
                  <input type="email" class="form-control" id="email" name="email" 
                         placeholder="E-Mail" style="width:400px;">
                </div>
              </div>

              <div class="form-group">
                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF">Contraseña</label>
                <div class="col-lg-10">
                  <input type="password" class="form-control" id="pass" name="pass" 
                         placeholder="password" style="width:400px;">
                </div>
              </div>
              
              <div class="form-group">
              	<label for="olvido" class="control-label" style="color:#FFF">¿Has olvidado tu contraseña?. <a href="recuperarpassword.php">Recuperar.</a></label>
              </div>
             
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="button" class="btn btn-default" id="login">Login</button>
                </div>
              </div>
				
                <div id="load">
                
                </div>

            </form>

     </section>
</div>

</body>

</html>