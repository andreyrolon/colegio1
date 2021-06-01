<?php

/**
 * 
 */
class actividades
{
	function actualizacion($id,$observaciones,$descripcion_actividad,$actividad,$color,$fecha,$sed,$jor){

    	include "conexion.php";

    	if ($jor!='todas' &&  $sed!='todas') {
	     	$sql = "SELECT jornada.NOMBRE,sede.NOMBRE FROM  sede,jornada,jornada_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA AND sede.NOMBRE='$sed' AND jornada.NOMBRE='$jor'";
			$req =$conexion->prepare($sql);
			$req->execute();
			$events = $req->fetchAll();
			$consultar_nivel12s=$req->rowCount();
			if($consultar_nivel12s>0){
				$sql = "UPDATE `cronograma_de_actividades` SET `jornada` = '$jor',`sede` = '$sed',`start` = '$fecha',`color` = '$color',`nombre_actividad` = '$actividad',`descripcion_actividad` = '$descripcion_actividad', `observaciones` = '$observaciones' WHERE `cronograma_de_actividades`.`id` = '$id' ";
				$req =$conexion->prepare($sql);
				$req->execute();

			}else{
				echo  " <script type='text/javascript'>mensaje2(1,'actualmente la sede no tiene la  jornada que  señalo ');    </script>";
			}
    	}
	    if ($jor=='todas' &&  $sed!='todas') {
	     	$sql = "SELECT jornada.NOMBRE,sede.NOMBRE FROM  sede,jornada,jornada_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA AND sede.NOMBRE='$sed' ";
			$req =$conexion->prepare($sql);
			$req->execute();
			$events = $req->fetchAll();
			$consultar_nivel12s=$req->rowCount();
			if($consultar_nivel12s>0){
				$sql = "UPDATE `cronograma_de_actividades` SET `jornada` = '$jor',`sede` = '$sed',`start` = '$fecha',`color` = '$color',`nombre_actividad` = '$actividad',`descripcion_actividad` = '$descripcion_actividad', `observaciones` = '$observaciones' WHERE `cronograma_de_actividades`.`id` = '$id' ";
				$req =$conexion->prepare($sql);
				$req->execute();

			}else{
				echo  " <script type='text/javascript'>mensaje2(1,'actualmente la sede no tiene la  jornada que  señalo');    </script>";
			}
    	}
	    if ($jor!='todas' &&  $sed=='todas') {
	     	$sql = "SELECT jornada.NOMBRE,sede.NOMBRE FROM  sede,jornada,jornada_sede WHERE jornada_sede.ID_SEDE=sede.ID_SEDE and jornada_sede.ID_JORNADA=jornada.ID_JORNADA AND jornada.NOMBRE='$jor' ";
			$req =$conexion->prepare($sql);
			$req->execute();
			$events = $req->fetchAll();
			$consultar_nivel12s=$req->rowCount();
			if($consultar_nivel12s>0){
				$sql = "UPDATE `cronograma_de_actividades` SET `jornada` = '$jor',`sede` = '$sed',`start` = '$fecha',`color` = '$color',`nombre_actividad` = '$actividad',`descripcion_actividad` = '$descripcion_actividad', `observaciones` = '$observaciones' WHERE `cronograma_de_actividades`.`id` = '$id' ";
				$req =$conexion->prepare($sql);
				$req->execute();

			}else{
				
				echo  " <script type='text/javascript'>mensaje2(1,'actualmente la sede no tiene la  jornada que  señalo');    </script>";
			}
    	}

    	 
    	 

		
     


	}
	function actualizar($id,$observaciones,$descripcion_actividad,$actividad,$color,$fecha,$sed,$jor,$eli){

        include "conexion.php";
        if ($eli=='') {
	      if ($fecha!='') {
				$fechaa="`start` = '".$fecha."',";
			}else{
				$fechaa='';
			}
			if ($sed!='') {
				$seda="`sede` = '".$sed."',";
			}else{
				$seda='';
			}
			if ($jor!='') {
			 	$jora="`jornada` = '".$jor."',";
			}else{
				$jora='';
			}
			
	 	    $sql = "UPDATE `cronograma_de_actividades` SET `color` = '$color',`nombre_actividad` = '$actividad',
			$fechaa $jora $seda `descripcion_actividad` = '$descripcion_actividad', `observaciones` = '$observaciones' WHERE `cronograma_de_actividades`.`id` = '$id' ";

			$req =$conexion->prepare($sql);
			$req->execute();
        }else{

		    $sql = "DELETE FROM `cronograma_de_actividades` WHERE `cronograma_de_actividades`.`id` = '$id'";

			$req =$conexion->prepare($sql);
			$req->execute();
        }
	}

	function actividad($s,$j)
	{ 
		 
		if ($s!='' &&  $j!='') {
			if ($s!='todas' &&  $j!='todas') {
			$AND= 'AND';}else{
			$AND= '';	
		}	
		}else{
			$AND= '';	
		}	

		if ($s!='' or  $j!='') { 
        	if ($s!='todas' or  $j!='todas') {  
        			$WHERE= 'WHERE';
        	 
        	}else{
			$WHERE= '';	
		}
		}else{
			$WHERE= '';	
		}
		 
		if ($j!='') {
			$jor='cronograma_de_actividades.jornada in ("'.$j.'","todas")';
		}else{
			$jor='';
		}
		if ($s!='') {
			$se='cronograma_de_actividades.sede in ("'.$s.'","todas")';
		}else{
			$se='';
		}

		if (  $j=='todas') {
			$jor='';
		} 
		if (  $s=='todas') {
			$se='';
		} 
		 

      include "conexion.php";
         $sql = "SELECT cronograma_de_actividades.*  FROM cronograma_de_actividades $WHERE $se $AND $jor ";

		$req =$conexion->prepare($sql);
		$req->execute();

		$events = $req->fetchAll();
		return $events;
	}

	function registrar($t,$c,$d,$o,$e,$s,$se,$jor){
		include "conexion.php";
		 
 	   	$sql = "INSERT INTO `cronograma_de_actividades` (`id`, `nombre_actividad`, `start`, `end`, `descripcion_actividad`, `observaciones`, `color`, `sede`, `jornada`) VALUES (NULL, '$t', '$s', '$e', '$d', '$o', '$c','$se','$jor') ";
		$req =$conexion->prepare($sql);
		$req->execute();

	}
	function mensaje(){
		echo  " <script type='text/javascript'>
      mensaje2(1,'actualmente la sede no tiene jornadas  ');
    </script>";
	}
	function eliminar_cronograma($r){
 		include "conexion.php";
		$sql = "DELETE FROM `cronograma_de_actividades` WHERE `cronograma_de_actividades`.`id` = '$r'";

		$req =$conexion->prepare($sql);
		$req->execute();		
	}
}

 
 
?>