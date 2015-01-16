<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosUsuarios {


function login($usuario,$pass) {
	
	$sqlusu = "select * from se_usuarios where email = '".$usuario."'";



if (trim($usuario) != '' and trim($pass) != '') {

$respusu = $this->query($sqlusu,0);

if (mysql_num_rows($respusu) > 0) {
	$error = '';
	
	$idUsua = mysql_result($respusu,0,0);
	$sqlpass = "select * from se_usuarios where password = '".$pass."' and IdUsuario = ".$idUsua;

	$resppass = $this->query($sqlpass,0);
	
	if (mysql_num_rows($resppass) > 0) {
		$error = '';
		} else {
			$error = 'Usuario o Password incorrecto';
		}
	
	}
	else
	
	{
		$error = 'Usuario o Password incorrecto';	
	}
	
	if ($error == '') {
		session_start();
		$_SESSION['usua_se'] = $usuario;
		$_SESSION['nombre_se'] = mysql_result($resppass,0,5);
		$_SESSION['rol_se'] = mysql_result($resppass,0,3);	
	}
	
}	else {
	$error = 'Usuario y Password son campos obligatorios';	
}
	
	
	return $error;
	
}





function camposTabla($accion) {
	$sql	=	"show columns from se_usuarios";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		
		$form	=	'';
		
		while ($row = mysql_fetch_array($res)) {
			if ($row[3] != 'PRI') {
				if (strpos($row[1],"decimal") !== false) {
					$form	=	$form.'
					
					<div class="form-group col-md-6">
                    	<label for="'.$row[0].'" class="control-label" style="text-align:left">'.ucwords($row[0]).'</label>
                        <div class="input-group col-md-12">
							<span class="input-group-addon">$</span>
                        	<input type="text" class="form-control" id="'.$row[0].'" name="'.$row[0].'" value="0" required>
							<span class="input-group-addon">.00</span>
                        </div>
                    </div>
					
					';
				} else {
					if ($row[0] == "refroll") {
						$label = "Rol";
						$campo = $row[0];
						
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
							<div class="input-group col-md-12">
								<select class="form-control" id="'.$campo.'" name="'.$campo.'">
									<option value="SuperAdmin">SuperAdministrador</option>
									<option value="Administrador">Administrador</option>
									<option value="Empleado">Empleado</option>
								</select>
							</div>
						</div>
						
						';
						
					} else {
						$label = ucwords($row[0]);
						$campo = $row[0];
						
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
							<div class="input-group col-md-12">
								<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
							</div>
						</div>
						
						';
					}
					
					
				}
			} else {
				$camposEscondido = '<input type="hidden" id="id" name="id" value="'.$row[0].'"/>';
				$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>';	
			}
		}
		
		$formulario = $form."<br><br>".$camposEscondido;
		
		return $formulario;
	}	
}



function camposTablaMod($accion,$id) {
	
	$resTipoVenta = $this->traerUsuariosPorId($id);
	
	$sql	=	"show columns from se_usuarios";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		
		$form	=	'';
		
		while ($row = mysql_fetch_array($res)) {
			if ($row[3] != 'PRI') {
				if (strpos($row[1],"decimal") !== false) {
					$form	=	$form.'
					
					<div class="form-group col-md-6">
                    	<label for="'.$row[0].'" class="control-label" style="text-align:left">'.ucwords($row[0]).'</label>
                        <div class="input-group col-md-12">
							<span class="input-group-addon">$</span>
                        	<input type="text" class="form-control" id="'.$row[0].'" name="'.$row[0].'" value="'.mysql_result($resTipoVenta,0,$row[0]).'" required>
							<span class="input-group-addon">.00</span>
                        </div>
                    </div>
					
					';
				} else {
					
					$formTabla = "";
					$formReferencia = "";
					switch ($row[0]) {
						case "refroll":
							$label = "Rol";
							$campo = $row[0];
							
							$formTabla = '
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12">
												
										<select class="form-control" id="'.$campo.'" name="'.$campo.'">
											';
											if (mysql_result($resTipoVenta,0,$campo) == 'SuperAdmin') {
												$formTabla = $formTabla.'
													<option value="SuperAdmin" selected>SuperAdmin</option>
													<option value="Administrador">Administrador</option>
													<option value="Empleado">Empleado</option>
												';
											}
											if (mysql_result($resTipoVenta,0,$campo) == 'Administrador') {
												$formTabla = $formTabla.'
													<option value="SuperAdmin">SuperAdmin</option>
													<option value="Administrador" selected>Administrador</option>
													<option value="Empleado">Empleado</option>
												';
											}
											if (mysql_result($resTipoVenta,0,$campo) == 'Empleado') {
												$formTabla = $formTabla.'
													<option value="SuperAdmin">SuperAdmin</option>
													<option value="Administrador">Administrador</option>
													<option value="Empleado" selected>Empleado</option>
												';
											}
											
							$formTabla = $formTabla.'</select>
									</div>
								</div>
								
								';
							
							break;
						case "refvalores":
							$label = "Aplica Sobre";
							$campo = $row[0];
							
							$sqlRef = "select idvalor,descripcion from lcdd_valores";
							$resRef = $this->query($sqlRef,0);
							
							$formRefDivUno = '<div class="form-group col-md-6">
										<label for="'.$row[0].'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-12">
											<select class="form-control" id="'.$campo.'" name="'.$campo.'" >';
							$formRefDivDos = "</select></div></div>";
							$formOption = "";
							
							while ($rowRef = mysql_fetch_array($resRef)) {
								if (mysql_result($resTipoVenta,0,$campo) == $rowRef[0]) {
									$formOption = $formOption."<option value='".$rowRef[0]."' selected>".$rowRef[1]."</option>";
								} else {
									$formOption = $formOption."<option value='".$rowRef[0]."'>".$rowRef[1]."</option>";
								}
							}
							
							$formReferencia = $formRefDivUno.$formOption.$formRefDivDos;
							
							break;
						default:
							$label = ucwords($row[0]);
							$campo = $row[0];
							
							$formTabla = '
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12">
										<input type="text" class="form-control" value="'.utf8_encode(mysql_result($resTipoVenta,0,$campo)).'" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
									</div>
								</div>
								
								';
								
							break;
						}
					
					
					
					$form	=	$form.$formReferencia.$formTabla;
				}
			} else {
				$camposEscondido = '<input type="hidden" id="id" name="id" value="'.$id.'"/>';
				$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>';	
			}
		}
		
		$formulario = $form."<br><br>".$camposEscondido;
		
		return $formulario;
	}	
}


function traerUsuarios() {
	$sql = "select idusuario,
			usuario,
			password,
			refroll,
			email,
			nombrecompleto 
			from se_usuarios";
	$res = $this->query($sql,0);
	return $res;
}

function traerUsuariosPorId($id) {
	$sql = "select idusuario,
			usuario,
			password,
			refroll,
			email,
			nombrecompleto 
			from se_usuarios 
			where idusuario = ".$id;
	$res = $this->query($sql,0);
	return $res;
}

function insertarUsuario($usuario,$password,$refroll,$email,$nombrecompleto) {
	$sql = "insert into se_usuarios(idusuario,
			usuario,
			password,
			refroll,
			email,
			nombrecompleto)
			values
				('',
				'".$usuario."',
				'".$password."',
				'".$refroll."',
				'".$email."',
				'".$nombrecompleto."')";
	$res = $this->query($sql,1);
	return $res;
}

function modificarUsuario($id,$usuario,$password,$refroll,$email,$nombrecompleto ) {
	$sql = "update se_usuarios
			SET
				usuario = '".$usuario."',
				password = '".$password."',
				refroll = '".$refroll."',
				email = '".$email."',
				nombrecompleto = '".$nombrecompleto."' 
			where idusuario =".$id;
			
	$res = $this->query($sql,0);
	return $res;
}

function eliminarUsuario($id) {
	$sql = "delete from se_usuarios where idusuario = ".$id;
	$res = $this->query($sql,0);
	return $res;
}


function query($sql,$accion) {
		
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
		$password = "caldera4415";*/
		
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