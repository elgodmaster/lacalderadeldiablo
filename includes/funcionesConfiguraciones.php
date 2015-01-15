<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosConfiguraciones {

/* logica de negocios para la configuraciones */

function camposTabla($accion) {
	$sql	=	"show columns from lcdd_tipoventa";
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
					$formTabla = "";
					$formReferencia = "";
					switch ($row[0]) {
						case "tipoventa":
							$label = "Tipo Venta";
							$campo = $row[0];
							
							$formTabla = '
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12">
										<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
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
								$formOption = $formOption."<option value='".$rowRef[0]."'>".$rowRef[1]."</option>";
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
										<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
									</div>
								</div>
								
								';
								
							break;
					}
					
					
					$form	=	$form.$formReferencia.$formTabla;
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
	
	$resTipoVenta = $this->traerTipoVentaId($id);
	
	$sql	=	"show columns from lcdd_tipoventa";
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
						case "tipoventa":
							$label = "Tipo Venta";
							$campo = $row[0];
							
							$formTabla = '
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12">
										<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" value="'.utf8_encode(mysql_result($resTipoVenta,0,$campo)).'" placeholder="Ingrese el '.$label.'..." required>
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
//el utf8_decode($cadena) este va en todos los campos que sean tipo string o cadena o varchar

//$idtipoventa,$tipoventa,$precio,$detalle

function insertarTipoVenta($tipoventa,$precio,$detalle,$refvalores) {
	$sql	=	"insert into lcdd_tipoventa(idtipoventa,tipoventa,precio,detalle,refvalores)
				 values
				 ('',
				 '".utf8_decode($tipoventa)."',
				 ".$precio.",
				 '".utf8_decode($detalle)."',
				 ".$refvalores.")";
	//return $sql;
	$res 	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return 'Se cargo exitosamente el Tipo de Venta';
	}
}

function modificarTipoVenta($id,$tipoventa,$precio,$detalle,$refvalores) {
	$sql	=	"update lcdd_tipoventa
				SET 
					tipoventa = '".utf8_decode($tipoventa)."',
					precio = ".$precio.",
					detalle = '".utf8_decode($detalle)."',
					refvalores = ".$refvalores."
				where 	idtipoventa = ".$id;
	$res  	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}

function eliminarTipoVenta($id) {
	$sql	=	"delete from lcdd_tipoventa where idtipoventa =".$id;
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}


function traerTipoVenta() {
	$sql	=	"select idtipoventa, tipoventa, precio, detalle, v.descripcion
				from lcdd_tipoventa tv 
				inner join lcdd_valores v
				on	tv.refvalores = v.idvalor
				order by tipoventa";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerTipoVentaValor($valor) {
	$sql	=	"select idtipoventa, tipoventa, precio, detalle, v.descripcion
				from lcdd_tipoventa tv 
				inner join lcdd_valores v
				on	tv.refvalores = v.idvalor
				where v.descripcion ='".$valor."'
				order by tipoventa";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerTipoVentaId($id) {
	$sql	=	"select idtipoventa, tipoventa, precio, detalle, refvalores from lcdd_tipoventa where idtipoventa =".$id;
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerTipoVentaNombre($nombre) {
	$sql	=	"select idtipoventa, tipoventa, precio, detalle from lcdd_tipoventa where tipoventa = '".$nombre."'";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}



/* fin */

function query($sql,$accion) {
		
		/*
		$hostname = "localhost";
		$database = "lacalderadeldiablo";
		$username = "root";
		$password = "";
		*/
		$hostname = "localhost";
		$database = "lacalder_diablo";
		$username = "lacalderadeldiab";
		$password = "caldera4415";
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		/*
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		*/
                $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>