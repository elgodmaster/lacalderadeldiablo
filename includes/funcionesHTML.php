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

function menu($usuario,$titulo) {
	$sql = "select idmenu,url,icono, nombre from lcdd_menu order by orden";
	$res = $this->query($sql,0);
	
	$cadmenu = "";
	$cadhover= "";
	
	$cant = 1;
	while ($row = mysql_fetch_array($res)) {
		if ($titulo == $row['nombre']) {
			$nombre = $row['nombre'];
			$row['url'] = "index.php";	
		}
		
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

Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "lacalderadeldiablo";
		$username = "root";
		$password = "";
		/*
		$hostname = "localhost";
		$database = "inflable_reycanguro";
		$username = "inflable_marcos";
		$password = "reycanguro7575";
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