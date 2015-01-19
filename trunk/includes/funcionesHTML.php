<?php

date_default_timezone_set('America/Buenos_Aires');


class ServiciosHTML {


function enviarMail($nombre,$mensaje,$email)
{
	$error = "";

	if (trim($nombre) == "")
	{
		$error = "Falta el nombre. ";
	}

	if (trim($mensaje) == "")
	{
		$error = $error." Falta el mensaje. ";
	}

	if (trim($email) == "")
	{
		$error = $error." Falta el email.";
	}

	if (strlen($error) < 1)
	{
		$sql = "insert into dbcontactos(idcontacto,nombre,mensaje,email,fecha) values ('','".$nombre."','".$mensaje."','".$email."','".date('Y-m-d H:i:s')."')";
		$this->query($sql,1);	
		return $error;
	} else {
		return $error;
	}
	

}

function menu($usuario,$titulo,$rol) {
	
	$sql = "select idmenu,url,icono, nombre, permiso from lcdd_menu where permiso like '%".$rol."%' order by orden";
	$res = $this->query($sql,0);
	
	$cadmenu = "";
	$cadhover= "";
	
	$cant = 1;
	while ($row = mysql_fetch_array($res)) {
		if ($titulo == $row['nombre']) {
			$nombre = $row['nombre'];
			$row['url'] = "index.php";	
		}
		
		if (strpos($row['permiso'],$rol) !== false) {
			if ($row['idmenu'] == 1) {
				$cadmenu = $cadmenu.'<li class="arriba"><div class="'.$row['icono'].'"></div><a href="'.$row['url'].'">'.$row['nombre'].'</a></li>';
				$cadhover = $cadhover.' <li class="arriba">
											<div class="'.$row['icono'].'2" id="tooltip'.$cant.'"></div>
											<div class="tooltip-dash">'.$row['nombre'].'</div>
										</li>';	
			} else {
				$cadmenu = $cadmenu.'<li><div class="'.$row['icono'].'"></div><a href="'.$row['url'].'">'.$row['nombre'].'</a></li>';
				$cadhover = $cadhover.'  <li>
											<div class="'.$row['icono'].'2" id="tooltip'.$cant.'"></div>
											<div class="tooltip-con">'.$row['nombre'].'</div>
										</li>';
			}
		}
		$cant+=1;
	}
	
	
	$menu = '<div id="navigation" >
			<div class="todoMenu">
				<div id="mobile-header">
					Menu
					<p>Usuario: <span style="color: #333; font-weight:900;">'.$usuario.'</span></p>
					<p class="ocultar" style="color: #900; font-weight:bold; cursor:pointer; font-family:"Courier New", Courier, monospace; height:20px;">(Ocultar)</p>
				</div>
			
				<nav class="nav">
					<ul>
						'.$cadmenu.'
					</ul>
				</nav>
				
				
			 </div>
			 <div class="menuHober">
				<ul class="ulHober">
						'.$cadhover.'
					</ul>
			 </div>
		</div>';
	
	return $menu;
	
}



function validacion($tabla) {
	$sql	=	"show columns from ".$tabla;
	$res 	=	$this->query($sql,0);
	
	$formJquery = '';
	$formValidador = '';
	
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		
		$jquery	=	'';
		$cuerpoValidacion = '';
		
		while ($row = mysql_fetch_array($res)) {
			if (($row[3] != 'PRI') && ($row[2] == 'NO')) {
				if (strpos($row[1],"decimal") !== false) {
					//debo validar que sea un numero
					
					$jquery	=	$jquery.'
					
					$("#'.$row[0].'").click(function(event) {
						$("#'.$row[0].'").removeClass("alert-danger");
						if ($(this).val() == "") {
							$("#'.$row[0].'").attr("value","");
							$("#'.$row[0].'").attr("placeholder","Ingrese el '.ucwords($row[0]).'...");
						}
					});
				
					$("#'.$row[0].'").change(function(event) {
						$("#'.$row[0].'").removeClass("alert-danger");
						$("#'.$row[0].'").attr("placeholder","Ingrese el '.ucwords($row[0]).'");
					});
					
					';
					
					$cuerpoValidacion = $cuerpoValidacion.'
					
						if ($("#'.$row[0].'").val() == "") {
							$error = "Es obligatorio el campo '.ucwords($row[0]).'.";
							$("#'.$row[0].'").addClass("alert-danger");
							$("#'.$row[0].'").attr("placeholder",$error);
						}
					
					';
					
					
				} else {
					if ($row[0] == "refroll") {
						$label = "Rol";
						$campo = $row[0];
						
						$jquery	=	$jquery.'
					
						$("#'.$campo.'").click(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							if ($(this).val() == "") {
								$("#'.$campo.'").attr("value","");
								$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'...");
							}
						});
					
						$("#'.$campo.'").change(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'");
						});
						
						';
						
						
						$cuerpoValidacion = $cuerpoValidacion.'
					
							if ($("#'.$campo.'").val() == "") {
								$error = "Es obligatorio el campo '.$label.'.";
								$("#'.$campo.'").addClass("alert-danger");
								$("#'.$campo.'").attr("placeholder",$error);
							}
						
						';
						
					} else {
						$label = ucwords($row[0]);
						$campo = $row[0];
						
						$jquery	=	$jquery.'
					
						$("#'.$campo.'").click(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							if ($(this).val() == "") {
								$("#'.$campo.'").attr("value","");
								$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'...");
							}
						});
					
						$("#'.$campo.'").change(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'");
						});
						
						';
						
						
						$cuerpoValidacion = $cuerpoValidacion.'
					
							if ($("#'.$campo.'").val() == "") {
								$error = "Es obligatorio el campo '.$label.'.";
								$("#'.$campo.'").addClass("alert-danger");
								$("#'.$campo.'").attr("placeholder",$error);
							}
						
						';
					}
					
					
				}
			}
		}
		
		$formJquery = $formJquery.$jquery;
		
		$formValidador = $formValidador.'
			function validador(){

					$error = "";
					'.$cuerpoValidacion.'
					return $error;
			}
		';
		
		return $formJquery.$formValidador;
	}	
}

Function query($sql,$accion) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
/*		$hostname = "localhost";
		$database = "lacalder_diablo";
		$username = "lacalderadeldiab";
		$password = "caldera4415";
		*/
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}

}




?>