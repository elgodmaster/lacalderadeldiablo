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
					if ($row[0] == "tipoventa") {
						$label = "Tipo Venta";
						$campo = $row[0];
					} else {
						$label = ucwords($row[0]);
						$campo = $row[0];
					}
					
					$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
							<div class="input-group col-md-12">
								<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
							</div>
						</div>
						
						';
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
					if ($row[0] == "tipoventa") {
						$label = "Tipo Venta";
						$campo = $row[0];
					} else {
						$label = ucwords($row[0]);
						$campo = $row[0];
					}
					
					$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
							<div class="input-group col-md-12">
								<input type="text" class="form-control" id="'.$campo.'" value="'.utf8_encode(mysql_result($resTipoVenta,0,$campo)).'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
							</div>
						</div>
						
						';
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

function insertarTipoVenta($tipoventa,$precio,$detalle) {
	$sql	=	"insert into lcdd_tipoventa(idtipoventa,tipoventa,precio,detalle)
				 values
				 ('',
				 '".utf8_decode($tipoventa)."',
				 ".$precio.",
				 '".utf8_decode($detalle)."')";
	//return $sql;
	$res 	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return 'Se cargo exitosamente el Tipo de Venta';
	}
}

function modificarTipoVenta($id,$tipoventa,$precio,$detalle) {
	$sql	=	"update lcdd_tipoventa
				SET 
					tipoventa = '".utf8_decode($tipoventa)."',
					precio = ".$precio.",
					detalle = '".utf8_decode($detalle)."'
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
	$sql	=	"select idtipoventa, tipoventa, precio, detalle from lcdd_tipoventa order by tipoventa";
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerTipoVentaId($id) {
	$sql	=	"select idtipoventa, tipoventa, precio, detalle from lcdd_tipoventa where idtipoventa =".$id;
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
		
		
		
		$hostname = "localhost";
		$database = "lacalderadeldiablo";
		$username = "root";
		$password = "";
		
/*		$hostname = "db494455387.db.1and1.com";
		$database = "db494455387";
		$username = "dbo494455387";
		$password = "Admin1234";*/
		
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