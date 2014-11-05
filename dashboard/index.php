<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BOR Sistema de Gestión Inmobiliario</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
        
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		#navigation {
			height:100%;
			background-color: #F30;
			padding-top:15px;
			overflow-y: auto;
			position: fixed;
			top: 0;
			width: 235px;
			z-index: 9999;
			border-left:1px solid #C40000;
			border-right:1px solid #C40000;
			margin-left:-185px;
			overflow: hidden;
			
		}
		
		#navigation #mobile-header {
			text-align:center;
			color: #7A0000;
			font-size:2.0em;
			font-family:Bebas;	
		}
		
		#navigation #mobile-header p {
			color: #fff;
			font-size:16px;
			font-family:  "Courier New", Courier, monospace;
		}
		
		.todoMenu {
			display:none;
		}
		
		.nav {
			margin-top:10px;
			border-top:1px solid #C40000;
			/*border-bottom:1px solid #FFD2D2;*/
		}
		.nav ul {
			list-style:none;
		}
		.nav ul li {
			padding-top:15px;
			border-bottom:1px solid #C40000;
			border-top:1px solid #FFD2D2;
			padding:8px;
			width:100%;
		}
		
		.nav ul li a {
			color:#FFF;
			font-family:Bebas;
			font-size:18px;
			text-decoration:none;
			width:100%;
		}
		
		.nav ul li:hover {
			border-top:1px solid #C40000;
		background: #e03800; /* Old browsers */
background: -moz-linear-gradient(top, #e03800 0%, #f23800 29%, #f23c00 82%, #e03800 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e03800), color-stop(29%,#f23800), color-stop(82%,#f23c00), color-stop(100%,#e03800)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #e03800 0%,#f23800 29%,#f23c00 82%,#e03800 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #e03800 0%,#f23800 29%,#f23c00 82%,#e03800 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #e03800 0%,#f23800 29%,#f23c00 82%,#e03800 100%); /* IE10+ */
background: linear-gradient(to bottom, #e03800 0%,#f23800 29%,#f23c00 82%,#e03800 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e03800', endColorstr='#e03800',GradientType=0 ); /* IE6-9 */
		}
		.nav .arriba {
			border-top:1px solid #FFD2D2;
		}
		.abajo {
			border-top:1px solid #FFD2D2;
			padding-top:-8px;
		}
		
		#infoMenu {
			margin-top:15px;
			padding:8px 2px 1px 10px;
			/*background-color:#7A0000;*/
			background: #d60000; /* Old browsers */
background: -moz-linear-gradient(top, #d60000 0%, #b20000 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d60000), color-stop(100%,#b20000)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #d60000 0%,#b20000 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #d60000 0%,#b20000 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #d60000 0%,#b20000 100%); /* IE10+ */
background: linear-gradient(to bottom, #d60000 0%,#b20000 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d60000', endColorstr='#b20000',GradientType=0 ); /* IE6-9 */
		border-bottom:1px solid #d60000;
		border-top:1px solid #b20000;
		}
		
		#infoMenu p {	
			color: #000;
			font-family: "Coolvetica Rg";
			font-size:16px;
		}
		
		#infoDescrMenu {
			padding:8px;
		}
		
		#infoDescrMenu p {
			color:#FFF;
		}
		
		.icodashboard {
			background:url(../imagenes/iconmenu/dashboard.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:9px;
		}
		
		.icousuarios {
			background:url(../imagenes/iconmenu/usuarios.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoalquileres {
			background:url(../imagenes/iconmenu/alquiler.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoinmubles {
			background:url(../imagenes/iconmenu/inmueble.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoturnos {
			background:url(../imagenes/iconmenu/turnos.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoventas {
			background:url(../imagenes/iconmenu/compras.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoproductos {
			background:url(../imagenes/iconmenu/barras.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoreportes {
			background:url(../imagenes/iconmenu/reportes.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icocontratos {
			background:url(../imagenes/iconmenu/contratos.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icosalir {
			background:url(../imagenes/iconmenu/salir.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			float:left;
			margin-right:10px;
		}
		
		.icoproductos2 {
			background:url(../imagenes/iconmenu/barras.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:9px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icoventas2 {
			background:url(../imagenes/iconmenu/compras.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:9px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icoturnos2 {
			background:url(../imagenes/iconmenu/turnos.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:9px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icodashboard2 {
			background:url(../imagenes/iconmenu/dashboard.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:9px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icousuarios2 {
			background:url(../imagenes/iconmenu/usuarios.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:10px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icoalquileres2 {
			background:url(../imagenes/iconmenu/alquiler.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:10px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icoinmubles2 {
			background:url(../imagenes/iconmenu/inmueble.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:10px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		
		.icoreportes2 {
			background:url(../imagenes/iconmenu/reportes.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:10px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icocontratos2 {
			background:url(../imagenes/iconmenu/contratos.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:10px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		.icosalir2 {
			background:url(../imagenes/iconmenu/salir.png) no-repeat;
			background-position: center center;
			width:40px;
			height:25px;
			margin-right:10px;
			margin-bottom:25px;
			cursor:pointer;
		}
		
		
		.ulHober {
			list-style:none;
			width:40px;
			right:6px;
			position:absolute;
		}
		
		.ulHober li {
			right:0;
		}
		
		.tooltip-dash, .tooltip-inmu, .tooltip-alqui, .tooltip-usua, .tooltip-con, .tooltip-rep, .tooltip-sal{
		   position: fixed;
		   background: #c0df71;
		   color: #fff;
		   border-radius:10px;
		   font-family: "Lucida Grande", Lucida, Verdana, sans-serif;
		   padding: 10px;
		   margin-top: -10px;
		   margin-left: 20px;
		   z-index: 9999999999;
		   display: none;
		   background-color: #333;
		}
		
		
		
  .boxInfo{ 
				width: 84%; 
				height: 160px; 
				margin:10px;
				float:left; 
				background:#fff; 

				overflow: hidden; 
				position: relative; 
				opacity: 0.8;
  				filter:  alpha(opacity=80);
				box-shadow: 2px 2px 5px #999;
				-webkit-box-shadow: 2px 2px 5px #999;
  				-moz-box-shadow: 2px 2px 5px #999;
  				filter: shadow(color=#999999, direction=135, strength=2);
				/*border-top-left-radius: 16px;
 				border-top-right-radius: 16px;
				-moz-border-radius-topright: 16px;
				-moz-border-radius-topleft: 16px;*/


			}

  			#headBoxInfo {
				background: rgb(255,195,188); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(255,195,188,1) 0%, rgba(255,119,104,1) 18%, rgba(255,44,25,1) 43%, rgba(255,26,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,195,188,1)), color-stop(18%,rgba(255,119,104,1)), color-stop(43%,rgba(255,44,25,1)), color-stop(100%,rgba(255,26,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(255,195,188,1) 0%,rgba(255,119,104,1) 18%,rgba(255,44,25,1) 43%,rgba(255,26,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(255,195,188,1) 0%,rgba(255,119,104,1) 18%,rgba(255,44,25,1) 43%,rgba(255,26,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(255,195,188,1) 0%,rgba(255,119,104,1) 18%,rgba(255,44,25,1) 43%,rgba(255,26,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(255,195,188,1) 0%,rgba(255,119,104,1) 18%,rgba(255,44,25,1) 43%,rgba(255,26,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc3bc', endColorstr='#ff1a00',GradientType=0 ); /* IE6-9 */

 padding:6px; height:36px; border-bottom:1px solid #C40000;
			}
  
		
	</style>
    
    <script type="text/javascript">
		$( document ).ready(function() {
			$('.icodashboard2, .icoalquileres2, .icousuarios2, .icoinmubles2, .icoreportes2, .icocontratos2, .icosalir2').click(function() {
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
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
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
            <p>Usuario: <span style="color: #333; font-weight:900;">AdminMarcos</span></p>
            <p class="ocultar" style="color: #900; font-weight:bold; cursor:pointer; font-family:'Courier New', Courier, monospace; height:20px;">(Ocultar)</p>
        </div>
    
        <nav class="nav">
            <ul>
                <li class="arriba"><div class="icodashboard"></div><a href="index.php">Dashboard</a></li>
                <li><div class="icoturnos"></div><a href="turnos/">Turnos</a></li>
                <li><div class="icoventas"></div><a href="ventas/">Ventas</a></li>
                <li><div class="icousuarios"></div><a href="clientes/">Clientes</a></li>
                <li><div class="icoproductos"></div><a href="productos/">Productos</a></li>
                <li><div class="icocontratos"></div><a href="proveedores/">Proveedores</a></li>
                <li><div class="icoreportes"></div><a href="reportes/">Reportes</a></li>
                <li><div class="icosalir"></div><a href="salir/">Salir</a></li>
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

<div align="center" style="margin-left:-240px;">
	<table border="0" cellpadding="0" cellspacing="0" width="600">
    	<tr>
        	<td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/clock4.png" width="50" height="50" style="float:left;">
                <p style="color:#F00; font-size:18px; height:16px;">25</p>
                <p style="height:16px;">Turnos</p>
            </td>
            <td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/shopping145.png" width="50" height="50" style="float:left;">
                <p style="color:#0CF; font-size:18px; height:16px;">12</p>
                <p style="height:16px;">Ventas</p>
            </td>
            <td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/icon_19476.png" width="50" height="50" style="float:left;">
                <p style="color: #30F; font-size:18px; height:16px;">8</p>
                <p style="height:16px;">Clientes</p>
            </td>
        	<td style="border:1px dashed #666; padding:10px;" width="150" align="center">
            	<img src="../imagenes/iconmenu/five.png" width="50" height="50" style="float:left;">
                <p style="color: #090; font-size:18px; height:16px;">3</p>
                <p style="height:16px;">Fiestas</p>
            </td>
        </tr>
    
    </table>
</div>

    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Proximos Turnos</p>
        </div>
    
    </div>
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimas Ventas</p>
        </div>
    
    </div>
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Ultimos Productos Cargados</p>
        </div>
    
    </div>
    
    <div class="boxInfo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Fiestas Proximas</p>
        </div>
    
    </div>

</div>


</body>
</html>