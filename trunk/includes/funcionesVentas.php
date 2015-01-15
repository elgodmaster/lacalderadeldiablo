<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosVentas {

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

function insertarVenta($refproducto,$reftipoventa,$importe,$fechacreacion,$cancelado,$usuacrea,$fechamodificacion,$usuamodi,$concepto,$observaciones,$cantidad) {
	
	$refproducto = $refproducto == '' ? 'null' : $refproducto;
	$sql	=	"insert into lcdd_ventas(idventa,refproducto,reftipoventa,importe,fechacreacion,cancelado,usuacrea,fechamodificacion,usuamodi,concepto,observaciones,cantidad)
				 values
				 ('',
				 ".$refproducto.",
				 ".$reftipoventa.",
				 ".$importe.",
				 null,
				 ".$cancelado.",
				 '".utf8_decode($usuacrea)."',
				 null,
				 '',
				 '".utf8_decode($concepto)."',
				 '".utf8_decode($observaciones)."',
				 ".$cantidad.")";
	//return $sql;
	$res 	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function modificarVenta($id,$cancelado,$observaciones) {
	$sql	=	"update lcdd_ventas
				SET 
					cancelado = '".$cancelado."',
					observaciones = '".utf8_decode($observaciones)."'
				where 	idventa = ".$id;
	$res  	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}

function eliminarVenta($id) {
	$sql	=	"delete from lcdd_ventas where idVenta =".$id;
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}

function traerIdVenta($refid,$valor) {
	$sql = "select
			m.refventa,tv.idtipoventa,m.idmovimiento,m.monto
			from		lcdd_movimientos m
			inner
			join		lcdd_tipoventa tv
			on			m.reftipoventa = tv.idtipoventa
			inner
			join		lcdd_valores v
			on			v.descripcion = '".$valor."' and v.idvalor = tv.refvalores
			where		m.refid = ".$refid;	
	$res 	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerVenta() {
	$sql	=	"SELECT 
				    v.idventa,
				    v.refproducto,
				    v.reftipoventa,
				    v.importe,
				    v.fechacreacion,
				    v.cancelado,
				    v.usuacrea,
				    v.fechamodificacion,
				    v.usuamodi,
				    v.concepto,
				    v.observaciones,
				    p.nombre,
				    p.codigo,
				    p.precio_unit,
				    tv.detalle,
                    v.cantidad
				FROM
				    lcdd_ventas v
				        INNER JOIN
				    lcdd_tipoventa tv ON v.reftipoventa = tv.idtipoventa
				        LEFT JOIN
				    lcdd_productos p ON v.refproducto = p.idproducto
				inner join
					lcdd_valores vv on tv.refvalores = vv.idvalor
				where vv.descripcion in ('Canchas','Fiestas','Productos')
				ORDER BY v.fechacreacion DESC";
				
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