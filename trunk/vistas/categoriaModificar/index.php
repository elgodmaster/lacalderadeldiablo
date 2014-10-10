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
        <script>
			$(document).ready(function(){
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
						
						
					$("#nombre").click(function(event) {
        			$("#nombre").removeClass("alert-danger");
					$("#nombre").attr('placeholder','Ingrese el Nombre...');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#nombre").change(function(event) {
        			$("#nombre").removeClass("alert-danger");
        			$("#nombre").attr('placeholder','Ingrese el Nombre...');
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
		      $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
		   }
		}); 
		</style>
</head>



<body>

<div align="center">

    	
        <?
		
			if (!isset($_GET['id'])) {
		
		?>
			<h3>Debe seleccionar una categoria para modificarla</h3>
            <button type="button" class="btn btn-info" style="margin-left:0px;" onClick="location.href = '../principal/'">Volver</button>  
        <?
		
			} else {
			
		?>
        <script type="text/javascript">
			$(document).ready(function(){
				
				function validador(){
						
        				$error = "";
		
        				if ($("#nombre").val() == "") {
        					$error = "Es obligatorio el campo Nombre.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
        				}
						

        				return $error;
        			}
					
				$("#modificar").click(function(event) {
        				
						if (validador() == "")
        				{
								
        						$.ajax({
                                data:  {nombre:		$("#nombre").val(),
										id:			<? echo $_GET['id']; ?>,
										accion:		'modificarCategoria'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      										
											$("#error").removeClass("alert alert-success");
											$("#error").addClass("alert alert-success");
											$("#error").html('<strong>Ok!</strong> Se modifico la categoria correctamente');
											
                                        
                                }
                        });
        				}
        		});
			});
		</script>
        
        
        <div class="table-responsive">
        
        <div class="panel panel-primary" style="width:60%; margin-top:20px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Modificar Categoria</h3>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form">
                	
                    <div class="form-group">
                    	<label for="nombre" class="col-lg-3 control-label" style="text-align:left;">Nombre</label>
                        <div class="col-lg-6">
                        	<input type="text" class="form-control" id="nombre" name="nombre" value="<? echo $serviciosProductos->TraerCategoriasPorId($_GET['id']); ?>" placeholder="Ingrese el Nombre..." required>
                        </div>
                    </div>
                
                    
                    <ul class="list-inline">
                    	<li>
                    		<button type="button" class="btn btn-warning" id="modificar" style="margin-left:0px;">Modificar</button>
                        </li>
                        <li>
                    		<button type="button" class="btn btn-info" style="margin-left:0px;" onClick="location.href = '../principal/'">Volver</button>    
                        </li>
                     </ul>
                </form>
                
                <br>
                <div id="error">
                
                </div>
               </div>
           </div>
           </div>
    	</div>





</body>

</html>

<? }} ?>