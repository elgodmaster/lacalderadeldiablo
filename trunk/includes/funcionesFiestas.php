<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosFiestas {

/* logica de negocios para la configuraciones */

function camposTabla($accion) {
	$sql	=	"show columns from lcdd_ventas";
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
					if ($row[0] == "Venta") {
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

//el utf8_decode($cadena) este va en todos los campos que sean tipo string o cadena o varchar

//$idVenta,$Venta,$precio,$detalle

function insertarFiesta($nombre,$horadesde,$horahasta,$dia,$concatering) {
	
	$sql	=	"insert into lcdd_fiestas(idfiesta,nombre,horadesde,horahasta,dia,concatering)
				 values
				 ('',
				 '".utf8_decode($nombre)."',
				 '".$horadesde."',
				 '".$horahasta."',
				 '".$dia."',
				 ".$concatering.")";
	//return $sql;
	$res 	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function modificarFiesta($id,$nombre,$horadesde,$horahasta,$dia,$concatering) {
	$sql	=	"update lcdd_fiestas
				SET 
					nombre = '".utf8_decode($nombre)."',
					horadesde = '".$horadesde."',
					horahasta = '".$horahasta."',
					dia = '".$dia."',
					concatering = '".$concatering."'
				where 	idfiesta = ".$id;
	$res  	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}

function eliminarFiesta($id) {
	$sql	=	"delete from lcdd_fiestas where idfiesta =".$id;
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}

function existeTurno($dia,$horadesde,$horahasta) {

	return '';
}


function traerFiestas() {
	$sql	=	"SELECT 
				    f.idfiesta,
				    f.nombre,
				    f.dia,
				    f.horadesde,
				    f.horahasta,
				    f.concatering
				FROM
				    lcdd_fiestas f

				ORDER BY f.dia, f.horadesde ";
				
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerFiestasId($id) {
	$sql	=	"SELECT 
				    f.idfiesta,
				    f.nombre,
				    f.dia,
				    f.horadesde,
				    f.horahasta,
				    f.concatering
				FROM
				    lcdd_fiestas f
				where f.idfiesta = ".$id;
				
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerFiestasDia($dia) {
	$sql	=	"SELECT 
				    f.idfiesta,
				    f.nombre,
				    f.dia,
				    f.horadesde,
				    f.horahasta,
				    f.concatering
				FROM
				    lcdd_fiestas f
				where f.dia = '".$dia."'";
				
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerFiestasPost($dia) {
	$sql	=	"SELECT 
				    f.idfiesta,
				    f.nombre,
				    f.dia,
				    f.horadesde,
				    f.horahasta,
				    f.concatering
				FROM
				    lcdd_fiestas f
				where f.dia >= '".$dia."'";
				
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